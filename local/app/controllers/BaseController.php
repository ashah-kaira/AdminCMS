<?php

use ViewModels\ServiceResponse;
use ViewModels\ServiceRequest;


class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		//if (!is_null($this->layout))
		//{
		//	$this->layout = View::make($this->layout, array('BaseUrl'=>URL::to('/')));
		//}
	}

    public function ValidateToken($token,$isValidating,$user){
    
	 $serviceResponse=new ServiceResponse();
	 Cache::forget($token);

        if($isValidating)
		{
			if(Cache::has($token))
			{ 
              
//			  Constants->CacheExpirationTime
			 	//Cache::add($token, $this.GetSessionUser($token), 6000);
			  Cache::add($token, $user, 525600);
			  Cache::add($user->id, $token, 525600);
			  $serviceResponse->IsSuccess=true;
			}
			$serviceResponse->Message = trans('messages.TokenIsNotValid');
			$serviceResponse->ErrorCode = "101";
			
		}
		else
		{
            //Cache::add($token, $user, Constants->CacheExpirationTime);
            Cache::add($token, $user,525600);
			$serviceResponse->Data = Cache::get($token);
			$serviceResponse->IsSuccess=true;
			
		}
		return $serviceResponse;
	}

	public function GetSessionUser($token){
			$serviceResponse=new ServiceResponse();
           //if(!is_null($token) && $token!='' && Cache::has($token))

			if(!is_null($token) && $token!='' && Cache::has($token))
			{ 
	       	 $serviceResponse->IsSuccess=true;
			 $serviceResponse->Data=Cache::get($token);
			}
			else
			{
			 $serviceResponse->Message="Session Expire";
			 $serviceResponse->ErrorCode = 401;
			}

			return 	 $serviceResponse;
   }


   public function RemoveToken($token){
       Cache::forget($token);
	   return true;
   }

    public function GetJsonResponse($serviceResponse){
	   //$serviceResponse->Data = json_decode($serviceResponse->Data);
       $jsonResponse = Response::make(json_encode($serviceResponse), 200);
	   $jsonResponse->header('Content-Type', 'application/json');
	   return $jsonResponse;
	}

	 public function GetObjectFromJsonRequest($jsonRequest){
		$serviceRequest= new ServiceRequest();
		$request= (object)$jsonRequest;
        $serviceRequest->Token= (!property_exists($request, 'Token') ? null : $request->Token);
		$isIOSRequest= property_exists($request, 'IOS') && $request->IOS;
		$serviceRequest->Data=$isIOSRequest?(object)$request->Data:(!property_exists($request, 'Data') ? null : is_array($request->Data)? (object)$request->Data : json_decode($request->Data));
		return $serviceRequest;
	 }

    public function GenerateToken($userUniqueEmail){
		return md5($userUniqueEmail);
	}

}
