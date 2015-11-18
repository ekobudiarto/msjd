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
use App\Models\table_media_manager;
use DB;

class post_media_manager extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function upload(){
        $app = app();
        if(Request::has('token'))
        {
            $token = Request::input('token','');
            $compare = GlobalLibrary::tokenExtractor($token);
			$users_checker = GlobalLibrary::CheckUsersToken($compare);
            //echo '<pre>'.print_r($compare).'</pre>';
            if($users_checker[0])
            {
                $uname = $users_checker[1];
                $uid = $users_checker[2];
                $email = $users_checker[3];

                $title = Request::input('ttl');
                $publish = Request::input('pub');
                $link = Request::input('lnk');
                
                if (Request::input('file'))
                {

                    $rules = array('file' => 'mimes:pdf,png,jpeg,jpg,bmp,doc,docx,xls,xlsx,csv,mp4,mp3,flv,');
                    $validator = Validator::make(input::all(), $rules);
                    if ($validator->fails()) {
                        return redirect('admin/media-manager')->with('failed', 'file that allowed to upload are pdf, png, jpeg, jpg, bmp, doc, docx, xls, xlsx, csv, mp4, mp3, or flv ');
                    }
                    else{
                        $file     = Input::file('file');
                        $filename = date("Y-m-d").'-'.str_random(8).'-'.$file->getClientOriginalName();
                        $destinationPath = 'UPLOADED';
                        $file->move($destinationPath, $filename);
                        $type = $file->getClientOriginalExtension();
                        
                        $field_media_manager = array(
                            'media_manager_title' => $title,
                            'media_manager_type' => $type,
                            'media_manager_filename' => $filename,
                            'media_manager_publish' => $publish,
                        );
                        $media = table_media_manager::create($field_media_manager);
                    }
           
                }
                else if($link != ''){
                    $type = 'url'
                    $field_media_manager = array(
                            'media_manager_title' => $title,
                            'media_manager_type' => $type,
                            'media_manager_filename' => $link,
                            'media_manager_publish' => $publish,
                    );
                    $media = table_media_manager::create($field_media_manager);
                }
                else{
                    return (new Response(array('status' => true,'msg' => 'Failed, you did not select file to upload'),200))->header('content-Type', "json");
                }

                $file[0] = $title;
                $file[1] = $type;
                
                return (new Response(array('status' => true,'data' => $dataConverted),200))->header('Content-Type', "json");
            }
            else
            {
                return (new Response(array('status' => false,'msg' => 'Authentication Failed2'),200))->header('content-Type', "json");
            }
        }
        else
        {
            return (new Response(array('status' => false,'msg' => 'Authentication Failed1'),200))->header('content-Type', "json");  
        }
    }   

}
