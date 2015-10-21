<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\table_content;
use Illuminate\Http\Response;
use App\Library\GlobalLibrary;

class get_timeline extends Controller
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
    			$dataAll = table_content::get();
    			$dataConverted = array();
    			$app = app();
    			$i = 0;
    			foreach($dataAll as $row){
	    			$dataConverted[$i] = $app->make('stdClass');
	    			$dataConverted[$i]->id = $row->content_id;
	    			$dataConverted[$i]->ttl = $row->content_title;
	    			$dataConverted[$i]->det = $row->content_detail;
					$dataConverted[$i]->med = $row->content_media_id;
					$dataConverted[$i]->upl = $row->content_users_uploader;
					$dataConverted[$i]->las = $row->content_last_editor;
					$dataConverted[$i]->ins = $row->content_date_insert;
					$dataConverted[$i]->upd = $row->content_date_update;
					$dataConverted[$i]->exp = $row->content_date_expired;
					$dataConverted[$i]->pub = $row->content_publish;
					$dataConverted[$i]->cat = $row->content_category_id;
					$dataConverted[$i]->rep = $row->content_repost_from;
					
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
