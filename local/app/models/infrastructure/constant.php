<?php
namespace Infrastructure;
use Illuminate\Mail\Mailer;

class Constants
{
    /* RB */
    public static $DefaultDateTimeFormat = 'Y-m-d H:i:s';
    public static $DateFormatServerSide = "m/d/Y";
    public static $YMDDateFormatServerSide = "Y-m-d";
    public static $QueryStringUserID ='UserID';
    public static $QueryStringSiteID = 'SiteID';
    public static $CheckStartWith = 1;
    public static $passwordRegex = '/^(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{12,}/';
    public static $emailRegex = '[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$';

    public static $LoginNotFound = '4';
    public static $UserStatusPending = '1';
    public static $UserStatusDisable = '3';
    public static $UserHaveNoRole = '2';
    public static $LoginError ='-1';
    public static $UserStatusActive = '6';
    public static $UserStatusActiveWithOneSiteAccess = '5';
    public static $Email_VerificationEmail = 'emails.verificationemail';
    public static $Email_VerificationEmailSubject = 'Verification Email';

    public static $Value_True = 1;
    public static $Value_False = 0;

    public static $projectNameTitle = "Admin CMS";
    public static $footerText = "2014 ? Metronic. Admin Dashboard Template.";
    /* RB Region End*/


    /*Start Dev_VishalA*/

    public static $SortIndex = 'LastName';
    public static $SortIndexASC = 'ASC';
    public static $UserPagerSize = 10;
    public static $AllRecords = -1;
    public static $TotalItemsCountColumn = "TotalItemsCount";
    public static $QueryStatusID = "StatusID";
    public static $AllStatusText = "All";
    public static $AllStatusValue = "";
    public static $AllRolesText = "Select Role";
    public static $AllRolesValue = "";
        /*End Dev_VishalA*/


    /* Ayushi Region Start */

    /* Ayushi Region End */


    public static $DefaultErrorHeader = "Default Error";

    public static $ServerErrorHeader="Server Error";
    public static $ServerErrorMessage="<p>Sorry, it looks as though something broke in our system.<br/>If you continue to experience technical difficulties with the page you're trying to reach, please let us know!</p>";
    public static $NotFoundHeader="Page Not Found";
    public static $NotFoundCodeMsg="404 Not Found";
    public static $NotFoundErrorMessage="Sorry, the page you're looking for isn't here.";
    public static $ForbiddenHeader="Forbidden";
    public static $ForbiddenErrorMessage="<p>You do not have permission to retrieve the URL or link you requested.<br/>Please inform the administrator of how you got here, if you think this was a mistake.</p>";
    public static $ForbiddenCodeMsg="403 Access Denied";
    public static $CommonErrorCodeMsg="Something's wrong";

}
