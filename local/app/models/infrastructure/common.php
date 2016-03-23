<?php

namespace Infrastructure;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use \ViewModels\SessionHelper;
use \EmailEntity;
use \SettingEntity;
use \Mail;
use \stdClass;
use \URL;
use \Config;
use \ViewModels\SearchValueModel;
use \DataProviders\BaseDataProvider;
use PHPMailer;
use \Infrastructure\Constants;
use \ViewModels\SortModel;
use \Carbon\Carbon;

class Common
{
    /* RB Region Start */
    public static function encryptor($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        //pls set your unique hashing key
        $secret_key = 'test';
        $secret_iv = 'test123';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        //do the encyption given text/string/number
        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            //decrypt the given text/string/number
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

    public static function getEncryptDecryptID($action,$propertyName){
        //    $decodedID = urldecode($propertyName);
        return urlencode(Common::encryptor($action, $propertyName));
    }

    public static function getEncryptDecryptValue($action,$propertyName){
        return urldecode(Common::encryptor($action, $propertyName));
    }

    public static function getExplodeValue($multiQueryString,$queryStringKey){
        if(str_contains($multiQueryString,'&'.$queryStringKey.'=') < 0){
            $first = explode('=',$multiQueryString);
            return $first[1];
        }

        if( starts_with($multiQueryString,$queryStringKey.'=') == 1 || str_contains($multiQueryString,'&'.$queryStringKey.'=') > 0) {
            $MultiQueryStringArray = explode('&', $multiQueryString);
            $first = current(array_filter($MultiQueryStringArray, function ($keyValue) use ($multiQueryString, $queryStringKey) {
                return starts_with($keyValue, $queryStringKey . '=')== 1 ;
            }));
            if(!empty($first))
                return explode('=',$first)[1];
        }
        return '0';
    }

    public static function getEloquentModel($entity,$objectData){
        $class =get_class($entity);
        $user = array($objectData);
        $userDetails =  $class::hydrate($user);
        return $userDetails[0];
    }
    public static function MailsToSend($maxFailedMailAttempt,$ImmediateSendEmailData=null){
        $searchParams = Array();
        $emailEntity = new EmailEntity();
        $baseDataProvider = new BaseDataProvider();
        $searchValueData = new SearchValueModel();
        $searchValueData->Name = "IsSent";
        $searchValueData->Value = 0;
        array_push($searchParams, $searchValueData);
        if(empty($ImmediateSendEmailData)) {
            $users = $baseDataProvider->GetEntityList($emailEntity, $searchParams);
        }else{
            $users = array();
            array_push($users,$ImmediateSendEmailData);
        }

        foreach ($users as $userObj) {

            $mail = new PHPMailer();
            $mail->IsSMTP();                                     // telling the class to use SMTP
            $mail->SMTPDebug = 0;
            $mail->IsHTML(true);
            $mail->SMTPAuth = true;
            $mail->Host = Config::get('mail.host');//Mailer//Constants::$smtpserver ; 	 // SMTP server
            $mail->SMTPSecure = Config::get('mail.encryption');//Constants::$driver ;
            $mail->Username = Config::get('mail.username');//Constants::$smtpuser ;        // SMTP username
            $mail->Password = Config::get('mail.password');//Constants::$smtppass ;        // SMTP password
            $mail->Port = Config::get('mail.port');//Constants::$smtpport ;
            $mail->From = Config::get('mail.from.address');//Constants::$smtpfrom ;
            $mail->FromName = Config::get('mail.from.name');//'DCC Live';

            if ($userObj->IsSent == 0 && $userObj->MailAttempt != $maxFailedMailAttempt) {
                $userObj->ToEmail = is_array($userObj->ToEmail) ? $userObj->ToEmail : explode(',', $userObj->ToEmail);

                $mail->Subject = $userObj->Subject;
                $mail->Body = $userObj->Body;

                if (!empty($userObj->ToEmail)) {
                    foreach ($userObj->ToEmail as $email => $name) {
                        $mail->AddAddress($name);
                    }
                }

                if (!empty($userObj->ToCC)) {
                    $mail->AddCC($userObj->ToCC);
                }
                if (!empty($userObj->Attachment)) {
                    $mail->AddAttachment($userObj->Attachment, Constants::$DefaultEventCalendarFileName);
                }

                if (empty($userObj->ToCC) && empty($userObj->ToEmail[0])) {
                    $isSent = true;
                } else {
                    if (!$mail->Send()) {
                        $isSent = false;
                        $userObj->MailAttempt = $userObj->MailAttempt++;
                    } else {
                        $isSent = true;
                    }
                }
                $emailEntity = $baseDataProvider->GetEntityForUpdateByPrimaryKey(new EmailEntity(), $userObj->EmailID);//EmailEntity::find($userObj->EmailID);
                $emailEntity->IsSent = $isSent;

                if ($isSent){
                    $emailEntity->SentDateTime = date(Constants::$DefaultDateTimeFormat);
                    if(!empty($userObj->Attachment) && file_exists($userObj->Attachment)){
                        $checkEmail = $userObj->ToEmail[0];
                        $customWhereAttachment = "Attachment = '$userObj->Attachment' AND EmailID != '$checkEmail' AND `IsSent` = 0";
                        $attachmentCount =  $baseDataProvider->GetEntityCount($emailEntity,"","","",$customWhereAttachment);
                        if($attachmentCount == 0 ) {
                            unlink($userObj->Attachment);
                        }
                    }
                }
                $emailEntity->MailAttempt = $userObj->MailAttempt;
                $baseDataProvider->SaveEntity($emailEntity);
            }
        }
    }

    public static function SendEmail($bodyTemplate, $bodyData,$subject, $toEmail,$toEmailName="",$toCCEmail="",$addAttachmentURL=""){
        $baseDataProvider=new BaseDataProvider();
        $emailEntity = new EmailEntity();
        $emailEntity->Subject=$subject;
        $emailEntity->ToEmail=$toEmail;
        if(!empty($toCCEmail)){
            $emailEntity->ToCC=$toCCEmail;
        }
        if(!empty($addAttachmentURL)){
            $emailEntity->Attachment = $addAttachmentURL;
        }
        $emailEntity->CreatedDate=date(Constants::$DefaultDateTimeFormat);
        $emailEntity->IsSent = 0;
        $emailEntity->MailAttempt = 1;

        $bodyData['logopath']=asset('assets/layouts/layout/img/logo.png');
        $bodyData['bgimagepath']=asset('assets/images/bg.jpg');
        $bodyData['helpsupportlink'] = Config::get('app.helpsupportlink');
        $bodyData['websitelink'] = Config::get('app.websitelink');
        $bodyData['websitename'] = Config::get('app.websitename');
        $bodyData['emaillogolink'] = Config::get('app.emaillogolink');
        if(!empty($toEmailName)){
            $bodyData['FirstName'] = $toEmailName;
        }

        if(isset($bodyData['UserID'])){
            $emailEntity->CreatedBy=$bodyData['UserID'];
        }
        else{
            $emailEntity->CreatedBy=1;  //Auth::user()->UserID;
        }

        $mailTemplate = self::GenerateEmailBody($bodyTemplate, $bodyData);
        $emailEntity->Body=$mailTemplate;

        return $baseDataProvider->SaveEntity($emailEntity);
    }

    public static function GenerateEmailBody($bodyTemplate, $bodyData){
        $templateName = substr($bodyTemplate, strpos($bodyTemplate, ".") + 1);
        $mailTemplate = file_get_contents(URL::to('/') . '/local/app/views/emails/' . $templateName . '.blade.php', false);
        $pattern = '/\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)/';
        preg_match_all($pattern, $mailTemplate, $matches);

        if (isset($matches[1])) {
            foreach ($matches[1] as $key => $value) {
                $mailTemplate = str_replace("$" . $value, $bodyData[$value], $mailTemplate);
            }
            return $mailTemplate;
        }
        return $mailTemplate;
    }

    /* RB Region End */


    /* VA Region Start */
    public static function getValidationMessagesFormat($validationMessage){
        $validationMessagesArray = "";
        foreach($validationMessage->toArray() as $key=>$value){
            $validationMessagesArray.= '<li>'.$value[0].'</li>';
        }
        return $validationMessagesArray;
    }
    public static function GetDataWithTrim($string)
    {
        return trim($string);
    }

    /* VA Region End */





}