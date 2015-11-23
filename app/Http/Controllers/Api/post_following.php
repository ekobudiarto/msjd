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

class post_following extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$token = Request::input('token','');
    	if($token != '')
    	{
    		$compare = GlobalLibrary::compareToken($token);
    		if($compare)
    		{
    			$ujs = Request::input('ujf','');
    			$users_id = Request::input('ui','');

                $user = table_users_detail::where('users_id', '=', $users_id)->first();
                
                foreach ($user as $key => $value) {
                    $ujs_default = $user->users_json_following;
                    $users_detail_id = $user->users_detail_id;
                }

                $follow = array(
                    'users_json_following'  => $ujs_default.$ujs.',',
                );

                $following = table_users_detail::where('users_detail_id', '=', $users_detail_id)->update($follow);

	    		
			 return (new Response(array('status' => true,'msg' => 'Following successfully'),200))->header('Content-Type', "json");
    		}
    		else
    		{
	    		return (new Response(array('status' => false,'msg' => 'Following Failed'),200))->header('Content-Type', "json");
    		}
    	}
    	else
    	{
	    	return (new Response(array('status' => false,'msg' => 'Following Failed'),200))->header('Content-Type', "json");	
    	}
    	

    }

}
