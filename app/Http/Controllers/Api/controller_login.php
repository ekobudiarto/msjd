<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use App\Library\GlobalLibrary;
use Illuminate\Support\Facades\Auth;

use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\table_users_detail;

class controller_login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	if(Request::has('token'))
    	{
    		$token = Request::input('token','');
    		$compare = GlobalLibrary::compareToken($token);
    		if($compare)
    		{
    			$this->middleware('guest', ['except' => 'getLogout']);

                $email = Request::input('u','');
                $password = Request::input('pwd','');

                if (Auth::attempt(array('email' => $email, 'password' => $password)))
                {
                	$users_detail = table_users_detail::where('users_email','=',$email)->first();
                	$users_default = User::where('email','=',$email)->first();
                	$status = $users_detail->users_status_id;
                	if($status == "1")
                	{
	                	//return (new Response(array('status' => true,'msg' => 'You are Logged in'),200))->header('Content-Type', "json");
	                	$field_users = array();
	                	$field_users['id'] = $users_default->id;
	                	$field_users['ids'] = $users_detail->users_id;
	                	$field_users['users_name'] = $users_detail->users_name;
	                	$field_users['users_email'] = $email;
	                	$field_users['users_group_id'] = $users_detail->users_group_id;
	                	$field_users['users_fullname'] = $users_detail->users_fullname;
	                	$field_users = (object) $field_users;
	                	$token = GlobalLibrary::tokenGenerator($field_users);
	                	//echo $token.'<br><br><br>';
	                	return (new Response(array('status' => true,'msg' => 'You are Logged in','token' => $token),200))->header('Content-Type', "json");
                	}
                	else
                	{
	                	return (new Response(array('status' => true,'msg' => 'You are still pending verification'),200))->header('Content-Type', "json");	
                	}
                    
                }
	    		else
                {
                    return (new Response(array('status' => false,'msg' => 'Authentication Failed '),200))->header('Content-Type', "json");
                }
    		}
    		else
    		{
	    		return (new Response(array('status' => false,'msg' => 'Authentication Failed2'),200))->header('Content-Type', "json");
    		}
    	}
    	else
    	{
	    	return (new Response(array('status' => false,'msg' => 'Authentication Failed1'),200))->header('Content-Type', "json");	
    	}
    	

    }

}
