<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use App\Library\GlobalLibrary;
use App\Models\table_banned_report;

class post_ban_report extends Controller
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
    			$users_by = Input::get('ub','');
    			$content_id = Input::get('ci','');
    			$users_dest = Input::get('ud','');
    			$banned_report_message = Input::get('brm','');
    			
                $banned_report = array(
                    'users_by'  => $users_by,
                    'content_id' => $content_id,
                    'users_dest' => $users_dest,
                    'banned_report_message' => $banned_report_message,
                );
                $bannedreport = table_banned_report::create($banned_report);

	    		
			 return (new Response(array('status' => true,'msg' => 'Report successfully'),200))->header('Content-Type', "json");
    		}
    		else
    		{
	    		return (new Response(array('status' => false,'msg' => 'Report Failed'),200))->header('Content-Type', "json");
    		}
    	}
    	else
    	{
	    	return (new Response(array('status' => false,'msg' => 'Report Failed'),200))->header('Content-Type', "json");	
    	}
    	

    }

}
