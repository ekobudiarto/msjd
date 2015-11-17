<?php

namespace App\Http\Controllers\Api;

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
use DB;

class post_schedule_user extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$app = app();
    	if(Request::has('token'))
    	{
    		$token = Request::input('token','');
    		$compare = GlobalLibrary::tokenExtractor($token);
    		$users_checker = $this->check_users($compare);
    		//echo '<pre>'.print_r($compare).'</pre>';
    		if($users_checker[0])
    		{
    			$uname = $users_checker[1];
			    $uid = $users_checker[2];
			    $email = $users_checker[3];

                $field_user_detail = array(
                    'schedule_title'  => Input::get('ttl',''),
                    'schedule_type_id' => Input::get('typ',''),
                    'schedule_users_creator' => $uid,
                    'schedule_users_source' => Input::get('usc',''),
                    'schedule_date_start' => Input::get('dst','',
                    'schedule_date_end' => Input::get('dnd',''),
                    'schedule_description' => Input::get('des',''),
                    'schedule_headline' => Input::get('hed',''),
                    'schedule_media_id' => Input::get('med',''),
                    'schedule_publish' => Input::get('pub',''),
                    'schedule_repeat' => Input::get('rpt',''),
                );
                $user = table_schedule::create($field_user_detail);

    			return (new Response(array('status' => true,'msg' => 'success'),200))->header('content-Type', "json");
    		}
    		else
    		{
	    		return (new Response(array('status' => false,'msg' => 'Authentication Failed2'),200))->header('content-Type', "json");
    		}
    	}
    	else
    	{
	    	return (new Response(array('status' => false,'msg' => 'Authentication Failed1'),200))->header('content-Type', "json");	
    	}
    	

    }    
    
    private function check_users($data)
    {
	    $uname = $data[4];
	    $uid = $data[6];
	    $email = $data[3].'@'.$data[2].'.'.$data[0];
	    $users_detail = table_users_detail::where('users_email','=',$email)
	    ->where('users_name','=',$uname)
	    ->where('users_detail_id','=',$uid)
	    ->first();
        $values = array();
	    if(count($users_detail) > 0)
	    {
            $values[0] = true;
            $values[1] = $uname;
            $values[2] = $uid;
            $values[3] = $email;
	    	return $values;
	    }
	    else
	    {
            $values[0] = false;
		    return $values;
	    }
	    
    }

}
