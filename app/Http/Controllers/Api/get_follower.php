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
use App\Models\table_request_follow;
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
                foreach($follower as $row){
                    $dataConverted[$i] = $app->make('stdClass');
                    $dataConverted[$i]->id = $row->users_id;
                    $dataConverted[$i]->unm = $row->users_name;
                    $dataConverted[$i]->ufn = $row->users_fullname;
                    $dataConverted[$i]->des = $row->users_description;
                    $dataConverted[$i]->ava = $row->users_avatar;         
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

    public function get_follower_request()
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

                $follower = table_users_detail::where('request_json_following','LIKE','%'.$uid.'%')->get();

                //this code for convert
                $dataConverted = array();
                $app = app();
                $i = 0;
                foreach($follower as $row){
                    $dataConverted[$i] = $app->make('stdClass');
                    $dataConverted[$i]->id = $row->users_id;
                    $dataConverted[$i]->unm = $row->users_name;
                    $dataConverted[$i]->ufn = $row->users_fullname; 
                    $dataConverted[$i]->des = $row->users_description;
                    $dataConverted[$i]->ava = $row->users_avatar;        
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

    public function accept_request_follower()
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

                $followingid = Request::input('fol','');

                $users = table_users_detail::where('users_id','=',$followingid)->first();
                $jsonfollow = $users->users_json_following;

                //insert my id to his/her detail 
                $datausersdetail= array(
                    'users_json_following' => $jsonfollow.','.$uid,
                );
                $data = table_users_detail::find($followingid);
                $data->update($datausersdetail);

                //delete his/her request because it has accepted
                $follow_requesting = table_request_follow::where('users_id','=',$followingid)->first();
                $request_following = $follow_requesting->json_request_follow;
                $arrayfollow = explode(',', $request_following);

                if(($key = array_search($uid, $arrayfollow)) !== false) {
                    unset($arrayfollow[$key]);
                }
                $new_json_request_follow = implode(',', $arrayfollow);

                //update his/her request
                $new_json= array(
                    'json_request_follow' => $new_json_request_follow,
                );
                $data2 = table_request_follow::find($followingid);
                $data2->update($new_json);                   

                return (new Response(array('status' => true,'msg' => 'success'),200))->header('Content-Type', "json");
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


    public function reject_request_follower()
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

                $followingid = Request::input('fol','');


                //delete his/her request because it has accepted
                $follow_requesting = table_request_follow::where('users_id','=',$followingid)->first();
                $request_following = $follow_requesting->json_request_follow;
                $arrayfollow = explode(',', $request_following);

                if(($key = array_search($uid, $arrayfollow)) !== false) {
                    unset($arrayfollow[$key]);
                }
                $new_json_request_follow = implode(',', $arrayfollow);

                //update his/her request
                $new_json= array(
                    'json_request_follow' => $new_json_request_follow,
                );
                $data2 = table_request_follow::find($followingid);
                $data2->update($new_json);                   

                return (new Response(array('status' => true,'msg' => 'success reject'),200))->header('Content-Type', "json");
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
