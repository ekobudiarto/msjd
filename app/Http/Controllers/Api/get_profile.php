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

class get_profile extends Controller
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
    		$users_checker = $this->check_users($compare);
    		//echo '<pre>'.print_r($compare).'</pre>';
    		if($users_checker[0])
    		{
    			$uname = $users_checker[1];
			    $uid = $users_checker[2];
			    $email = $users_checker[3];
    			$users = table_users_detail::where('users_email','=',$email)
							    ->where('users_name','=',$uname)
							    ->where('users_detail_id','=',$uid)
							    ->first();
				$data = $app->make('stdClass');
				$data->i = $users->users_detail_id;
				$data->ids = $users->users_id;
				$data->u = $users->users_name;
				$data->fu = $users->users_fullname;
				$data->ugid = $users->users_group_id;
				$data->e = $users->users_email;
				$data->ph = $users->users_telp;
				$data->d = $users->users_description;
				$data->ava = $users->users_avatar;
				$data->long = $users->long;
				$data->lat = $users->lat;
				$data->cover = $users->users_cover;
    			return (new Response(array('status' => true,'msg' => 'success','data' => $data),200))->header('Content-Type', "json");
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
    
    public function save_profile()
    {
	    $app = app();
    	if(Request::has('token'))
    	{
    		
    	}
    	else
    	{
	    	return (new Response(array('status' => false,'msg' => 'Authentication Failed'),200))->header('Content-Type', "json");	
    	}
    }
    
    public function upload()
    {
	    if (Request::hasFile('file'))
        {

            $rules = array('file' => 'mimes:png,jpeg,jpg,bmp');
            $validator = Validator::make(Request::all(), $rules);
            if ($validator->fails()) {
                return (new Response(array('status' => false,'msg' => 'Please choose a picture'),200))->header('Content-Type', "json");
            }
            else{
            	$str = "";
            	try{
            		$param_picture = Request::input('param_picture');
            		$id = Request::input('param');
					$token = Request::input('token');
            		$file     = Request::file('file');
            		$filename = "";
            		if($param_picture == "ava")
            		{
	            		$filename = md5('Avatar -'.date("Y-m-d H:i:s").'-').'.'.$file->getClientOriginalExtension();	
            		}
            		else
            		{
	            		$filename = md5('Cover -'.date("Y-m-d H:i:s").'-').'.'.$file->getClientOriginalExtension();	
            		}
	                //$filename = date("Y-m-d").'-'.str_random(8).'-'.$file->getClientOriginalName();
	                $destinationPath = 'UPLOADED';
	                $file->move($destinationPath, $filename);
	                $str = "success ";
	                return (new Response(array('status' => true,'msg' => $str,'f' => $filename),200))->header('Content-Type', "json");
            	}catch(Exception $e){
					$str = $e->getMessage(); 	
					return (new Response(array('status' => false,'msg' => $str),200))->header('Content-Type', "json");
            	}
                //$users = table_users_detail::find();
            }
        }
        else
        {
	        return (new Response(array('status' => false,'msg' => 'Authentication Failed'),200))->header('Content-Type', "json");
        }
    }
    
    private function check_users($data)
    {
	    $uname = $data[4];
	    $uid = $data[6];
	    $email = $data[3].'@'.$data[2].'.'.$data[0];
	    $users_detail = table_users_detail::where('users_email','=',$email)
	    ->where('users_name','=',$uname)
	    ->where('users_detail_id','=',$uid)
	    ->first();
        $values = array();
	    if(count($users_detail) > 0)
	    {
            $values[0] = true;
            $values[1] = $uname;
            $values[2] = $uid;
            $values[3] = $email;
	    	return $values;
	    }
	    else
	    {
            $values[0] = false;
		    return $values;
	    }
	    
    }

}
