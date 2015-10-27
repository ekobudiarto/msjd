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
        echo "not a function";
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

    public function getMediaId()
    {
        
        $term = strtolower(input::get('term'));
        $data = DB::table('table_media_manager')->select('media_manager_id','media_manager_title')->where('media_manager_title', 'LIKE', $term.'%')->take(10)->get();
        foreach($data as $v){
            $return_array[] = array('value' => '['.$v->media_manager_id.'] '.$v->media_manager_title);
        }
        return (new Response($return_array,200))->header('Content-Type', "json");

    }
    
    public function getCategoryId()
    {
        
        $term = strtolower(input::get('term'));
        $data = DB::table('table_content_category')->select('content_category_id','content_category_title')->where('content_category_title', 'LIKE', $term.'%')->take(10)->get();
        foreach($data as $v){
            $return_array[] = array('value' => '['.$v->content_category_id.'] '.$v->content_category_title);
        }
        return (new Response($return_array,200))->header('Content-Type', "json");

    }
    
    public function getScheduleType()
    {
        
        $term = strtolower(input::get('term'));
        $data = DB::table('table_schedule_type')->select('schedule_type_id','schedule_type_name')->where('schedule_type_name', 'LIKE', $term.'%')->take(10)->get();
        foreach($data as $v){
            $return_array[] = array('value' => '['.$v->schedule_type_id.'] '.$v->schedule_type_name);
        }
        return (new Response($return_array,200))->header('Content-Type', "json");

    }
}
