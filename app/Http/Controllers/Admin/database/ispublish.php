<?php

namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use App\Library\GlobalLibrary;
use DB;
use Illuminate\Support\Facades\Redirect;


class ispublish extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = input::get('id');
        $id_name = input::get('id_name');
        $table_name = input::get('table_name');
        $field_name = input::get('field_name');
        $values = input::get('values');
        $url = input::get('url');
        
        $dataUpdate[$field_name] = $values;
        $data = DB::table($table_name)->where($id_name,$id)->update($dataUpdate);
        return Redirect::to('http://'.$url)->with('message', 'Data successfully changed!');
        
        die();
    
    }
        
}
