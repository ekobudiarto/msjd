<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use App\Library\GlobalLibrary;
use App\Models\table_content;

class post_timeline extends Controller
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
    			$hea = Input::get('hea','');
    			$det = Input::get('det','');
    			$med = Input::get('med','');
    			$upl = Input::get('upl','');
    			$las = Input::get('las','');
    			$ins = Input::get('ins','');
                $upd = Input::get('upd','');
                $exp = Input::get('exp','');
                $pub = Input::get('pub','');
                $cat = Input::get('cat','');
                $rep = Input::get('rep','');


                $field_user_detail = array(
                    'content_title'  => $ttl,
                    'content_headline' => $hea,
                    'content_detail' => $det,
                    'content_media_id' => $med,
                    'content_users_uploader' => $upl,
                    'content_last_editor' => $las,
                    'content_date_insert' => $ins,
                    'content_date_update' => $upd,
                    'content_date_expired' => $exp,
                    'content_publish' => $pub,
                    'content_category_id' => $cat,
                    'content_repost_from' => $rep
                );
                $user = table_content::create($field_user_detail);

	    		
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
