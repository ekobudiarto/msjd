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
use App\Models\table_content;
use App\Models\table_hashtag;
use DB;

class Get_follower extends Controller
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
            $users_checker = GlobalLibrary::CheckUsersToken($compare);
            
            if($users_checker[0])
            {
                $uname = $users_checker[1];
                $uid = $users_checker[2];
                $email = $users_checker[3];

                $follower = table_users_detail::where('users_json_following','LIKE','%'.$uid.'%')->get();

                //this code for convert
                $dataConverted = array();
                $app = app();
                $i = 0;
                foreach($result as $row){
                    $dataConverted[$i] = $app->make('stdClass');
                    $dataConverted[$i]->id = $row->users_id;
                    $dataConverted[$i]->unm = $row->users_name;
                    $dataConverted[$i]->ufn = $row->users_fullname;   
                    $i++;
                }
                return (new Response(array('status' => true,'msg' => 'success','data' => $dataConverted),200))->header('Content-Type', "json");
            }
            else
            {
                return (new Response(array('status' => false,'msg' => 'Authentication Failed2'),200))->header('Content-Type', "json");
            }
        }
        else
        {
            return (new Response(array('status' => false,'msg' => 'Authentication Failed1'),200))->header('Content-Type', "json");  
        }
        

    } 


}
