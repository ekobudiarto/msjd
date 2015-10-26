<?php

namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use App\Library\GlobalLibrary;
use DB;


class autocomplete extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        echo "haha";
        die();
    }

    public function getUsername()
    {
        
        $term = strtolower(input::get('term'));
        $data = DB::table('table_users_detail')->select('users_id','users_name')->where('users_name', 'LIKE', $term.'%')->take(10)->get();
        foreach($data as $v){
            $return_array[] = array('value' => '['.$v->users_id.'] '.$v->users_name);
        }
        return (new Response($return_array,200))->header('Content-Type', "json");

    }

    public function getContentTitle()
    {
        
        $term = strtolower(input::get('term'));
        $data = DB::table('table_content')->select('content_id','content_title')->where('content_title', 'LIKE', $term.'%')->take(10)->get();
        foreach($data as $v){
            $return_array[] = array('value' => '['.$v->content_id.'] '.$v->content_title);
        }
        return (new Response($return_array,200))->header('Content-Type', "json");

    }

    
}
