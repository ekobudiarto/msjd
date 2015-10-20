<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\table_users_status;
use Illuminate\Http\Response;

class controller_signup extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$data = array(
            'users_status' => table_users_status::latest('users_status_id')->get(),
         );
		 return (new Response(array('error' => false,'urls' => $data),200))->header('Content-Type', "json");

    }

}
