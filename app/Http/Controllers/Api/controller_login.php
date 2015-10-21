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

class controller_login extends Controller
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
    			$this->middleware('guest', ['except' => 'getLogout']);

                $email = Input::get('u','');
                $password = Input::get('pwd','');

                if (Auth::attempt(array('email' => $email, 'password' => $password)))
                {
                    return (new Response(array('status' => true,'msg' => 'You are Logged in'),200))->header('Content-Type', "json");
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
    	else
    	{
	    	return (new Response(array('status' => false,'msg' => 'Authentication Failed'),200))->header('Content-Type', "json");	
    	}
    	

    }

}
