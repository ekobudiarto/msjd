<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use App\Library\GlobalLibrary;
use App\Models\users;
use App\Models\table_users_detail;

class settings_profile extends Controller
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
    			$uid = Input::get('uid','');
                $unm = Input::get('unm','');
    			$ufn = Input::get('ufn','');
    			$pwd = Input::get('pwd','');
    			$ugi = Input::get('ugi','');
    			$mel = Input::get('mel','');
    			$tlp = Input::get('tlp','');
    			$des = Input::get('des','');
                $mmi = Input::get('mmi','');
                $ava = Input::get('ava','');
                $sta = Input::get('sta','');

                //still construction, because i don't know how the mobile process to change password. 
                // maybe use re-type password and make a compare with old password or something 
                //update table users (default laravel)
                $pwd = bcrypt($pwd);
                $updateuser = users::where('id', '=', $uid)->update(array('password' => $pwd, 'email' => $mel));
                
                
                //update table table_users_detail
                $update = table_users_detail::where('users_id', '=', $uid)->first();
                foreach ($user as $key => $value) {
                    $users_detail_id = $user->users_detail_id;
                }

                $fud = array(
                    'users_name'  => $unm,
                    'users_fullname' => $ufn,
                    'users_group_id' => $ugi,
                    'users_email' => $mel,
                    'users_telp' => $tlp,
                    'users_description' => $des,
                    'media_manager_id' => $mmi,
                    'users_avatar' => $ava,
                    'users_status_id' => $sta,
                );
                $updateusersdetail = users::where('users_detail_id', '=', $users_detail_id)->update($fud);
                

	    		
			 return (new Response(array('status' => true,'msg' => 'Update successfully'),200))->header('users-Type', "json");
    		}
    		else
    		{
	    		return (new Response(array('status' => false,'msg' => 'Update Failed'),200))->header('users-Type', "json");
    		}
    	}
    	else
    	{
	    	return (new Response(array('status' => false,'msg' => 'Update Failed'),200))->header('users-Type', "json");	
    	}
    	

    }

}
