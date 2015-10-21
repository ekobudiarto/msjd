<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use App\Library\GlobalLibrary;
use App\Models\table_users_detail;

class controller_signup extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$token = Input::get('token','');
    	if($token != '')
    	{
    		$compare = GlobalLibrary::compareToken($token);
    		if($compare)
    		{
    			$fullname = Input::get('f','');
    			$username = Input::get('u','');
    			$phone = Input::get('pn','');
    			$email = Input::get('e','');
    			$password = Input::get('pwd','');
    			$roles = Input::get('r','');
    			
    			$field_users = array(
    				'name' => $username,'email' => $email,'password' => bcrypt($password)
    			);
    			
 
    			    			
    			$user = User::create($field_users);
    			$user_login = User::where('email', '=', $email)->first();
                foreach ($user_login as $key => $value) {
                    $id = $user_login->id;
                }


                $field_user_detail = array(
                    'users_id'  => $id,
                    'users_name' => $username,
                    'users_fullname' => $fullname,
                    'users_group_id' => $roles,
                    'users_email' => $email,
                    'users_status_id' => '1'
                );
                $user = table_users_detail::create($field_user_detail);

	    		
			 return (new Response(array('status' => true,'msg' => 'Register successfully'),200))->header('Content-Type', "json");
    		}
    		else
    		{
	    		return (new Response(array('status' => false,'msg' => 'Authentication Failed'),200))->header('Content-Type', "json");
    		}
    	}
    	else
    	{
	    	return (new Response(array('status' => false,'msg' => 'Authentication Failed'),200))->header('Content-Type', "json");	
    	}
    	

    }

}
