<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\table_users_group;
use Illuminate\Http\Response;
use App\Library\GlobalLibrary;

class roles extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findAll()
    {
    	$token = Input::get('token','');
    	if($token != '')
    	{
    		$compare = GlobalLibrary::compareToken($token);
    		if($compare)
    		{
    			$dataAll = table_users_group::where('users_group_is_public', '=', 1)->get();
    			$dataConverted = array();
    			$app = app();
    			$i = 0;
    			foreach($dataAll as $row){
	    			$dataConverted[$i] = $app->make('stdClass');
	    			$dataConverted[$i]->i = $row->users_group_id;
	    			$dataConverted[$i]->t = $row->users_group_name;
	    			$dataConverted[$i]->d = $row->users_group_description;
	    			$i++;
    			}
	    		
			 return (new Response(array('status' => true,'data' => $dataConverted),200))->header('Content-Type', "json");
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
