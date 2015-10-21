<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use App\Library\GlobalLibrary;
use App\Models\table_schedule;

class set_schedule extends Controller
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
    			$ttl = Input::get('ttl','');
    			$typ = Input::get('typ','');
    			$cre = Input::get('cre','');
    			$sou = Input::get('sou','');
    			$sta = Input::get('sta','');
    			$end = Input::get('end','');
    			$des = Input::get('des','');
                $hea = Input::get('hea','');
                $med = Input::get('med','');
                $pub = Input::get('pub','');


                $field_user_detail = array(
                    'schedule_title'  => $ttl,
                    'schedule_type_id' => $typ,
                    'schedule_users_creator' => $cre,
                    'schedule_users_source' => $sou,
                    'schedule_date_start' => $sta,
                    'schedule_date_end' => $end,
                    'schedule_description' => $des,
                    'schedule_headline' => $hea,
                    'schedule_media_id' => $med,
                    'schedule_publish' => $pub
                );
				
                $user = table_schedule::create($field_user_detail);

	    		
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
