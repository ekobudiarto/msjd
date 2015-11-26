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
use App\Models\table_media_manager;
use App\Models\table_notification;
use DB;

class get_content extends Controller
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

                $follow = explode(',',$users->users_json_following);

                //get query
                $result = DB::select('Select tc.*, tud.users_name, tcc.content_category_title
                                from table_content_category tcc, table_content tc, table_users_detail tud
                                WHERE tc.content_category_id = tcc.content_category_id
                                AND tud.users_id = tc.content_users_uploader
                                AND tc.content_users_uploader IN '.$follow.'
                                ORDER BY tc.content_id DESC
                            ');


                foreach( $result as $res=>$value ){
                     //get media manager
                     $idsplit = explode(',', $value->content_media_id);
                     $length = count($idsplit);
                     $name = '';
                     for($i = 0; $i<$length;$i++){
                        $cek = table_media_manager::where('media_manager_id', '=', $idsplit[$i])->first();
                        if($cek!= null){
                            $name=$name.$cek->media_manager_title.', ';
                        }
                     }

                     //get repost
                     $cekrepost = table_content::where('content_id', '=', $value->content_repost_from )->first();
                        if($cekrepost!= null){
                            $value->content_repost_from = $cekrepost->content_title;
                     }


                     //get hashtag
                     $idsplittag = explode(',', $value->hashtag_id);
                     $lengthtag = count($idsplittag);
                     $hashtag='';
                     for($j = 0; $j<$lengthtag;$j++){
                        $cektag = table_hashtag::where('hashtag_id', '=', $idsplittag[$j])->first();
                        if($cek!= null){
                            $nametag=$nametag.$cektag->media_manager_title.', ';
                        }
                     }
                     $value->hashtag_id = $nametag;
                }

                //this code for convert
                $dataConverted = array();
                $app = app();
                $i = 0;
                foreach($result as $row){
                    $dataConverted[$i] = $app->make('stdClass');
                    $dataConverted[$i]->id = $row->content_id;
                    $dataConverted[$i]->ttl = $row->ccontent_title;
                    $dataConverted[$i]->hed = $row->content_headline;
                    $dataConverted[$i]->det = $row->content_detail;
                    $dataConverted[$i]->med = $row->content_media_id;
                    $dataConverted[$i]->upl = $row->content_users_uploader;
                    $dataConverted[$i]->uun = $row->content_users_uploader_name;
                    $dataConverted[$i]->cle = $row->content_last_editor;
                    $dataConverted[$i]->cdi = $row->content_date_insert;
                    $dataConverted[$i]->cdu = $row->content_date_update;
                    $dataConverted[$i]->cde = $row->content_date_expired;
                    $dataConverted[$i]->pub = $row->content_publish;
                    $dataConverted[$i]->cat = $row->content_category_id;
                    $dataConverted[$i]->ccn = $row->content_category_name;     
                    $dataConverted[$i]->chi = $row->content_hashtag_id;
                    $dataConverted[$i]->crf = $row->content_repost_from;
                    $dataConverted[$i]->crn = $row->content_repost;
                    
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

    public function detail(){
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

                $id_content = Request::input('id');

                $result = DB::select('Select tc.*, tud.users_name, tcc.content_category_title
                                from table_content_category tcc, table_content tc, table_users_detail tud
                                WHERE tc.content_category_id = tcc.content_category_id
                                AND tud.users_id = tc.content_users_uploader
                                AND ct.content_id = '.$id_content.'
                                ORDER BY tc.content_id DESC
                            ');
                

                foreach( $result as $res=>$value ){
                     //get media manager
                     $idsplit = explode(',', $value->content_media_id);
                     $length = count($idsplit);
                     $name = '';
                     for($i = 0; $i<$length;$i++){
                        $cek = table_media_manager::where('media_manager_id', '=', $idsplit[$i])->first();
                        if($cek!= null){
                            $name=$name.$cek->media_manager_title.', ';
                        }
                     }

                     //get repost
                     $cekrepost = table_content::where('content_id', '=', $value->content_repost_from )->first();
                        if($cekrepost!= null){
                            $value->content_repost_from = $cekrepost->content_title;
                     }
                     
                     //get hashtag
                     $idsplittag = explode(',', $value->hashtag_id);
                     $lengthtag = count($idsplittag);
                     $hashtag='';
                     for($j = 0; $j<$lengthtag;$j++){
                        $cektag = table_hashtag::where('hashtag_id', '=', $idsplittag[$j])->first();
                        if($cek!= null){
                            $nametag=$nametag.$cektag->media_manager_title.', ';
                        }
                     }
                     $value->hashtag_id = $nametag;
                }

                //this code for convert
                $dataConverted = array();
                $app = app();
                $i = 0;
                foreach($result as $row){
                    $dataConverted[$i] = $app->make('stdClass');
                    $dataConverted[$i]->id = $row->content_id;
                    $dataConverted[$i]->ttl = $row->ccontent_title;
                    $dataConverted[$i]->hed = $row->content_headline;
                    $dataConverted[$i]->det = $row->content_detail;
                    $dataConverted[$i]->med = $row->content_media_id;
                    $dataConverted[$i]->upl = $row->content_users_uploader;
                    $dataConverted[$i]->uun = $row->content_users_uploader_name;
                    $dataConverted[$i]->cle = $row->content_last_editor;
                    $dataConverted[$i]->cdi = $row->content_date_insert;
                    $dataConverted[$i]->cdu = $row->content_date_update;
                    $dataConverted[$i]->cde = $row->content_date_expired;
                    $dataConverted[$i]->pub = $row->content_publish;
                    $dataConverted[$i]->cat = $row->content_category_id;
                    $dataConverted[$i]->ccn = $row->content_category_name;     
                    $dataConverted[$i]->chi = $row->content_hashtag_id;
                    $dataConverted[$i]->crf = $row->content_repost_from;
                    $dataConverted[$i]->crn = $row->content_repost;
                    
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



    public function input(){
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

                if(Request::input('ttl') == null)
                    return (new Response(array('status' => true,'msg' => 'Title must have value'),200))->header('content-Type', "json");
                else if (Request::input('hed') == null)
                    return (new Response(array('status' => true,'msg' => 'Headline must have value'),200))->header('content-Type', "json");
                else if (Request::input('det') == null)
                    return (new Response(array('status' => true,'msg' => 'Detail must have value'),200))->header('content-Type', "json");
                else if (Request::input('cle') == null)
                    return (new Response(array('status' => true,'msg' => 'Media failed to upload'),200))->header('content-Type', "json");
                else if (Request::input('cde') == null)
                    return (new Response(array('status' => true,'msg' => 'Please set the date expired'),200))->header('content-Type', "json");
                else if (Request::input('cat') == null)
                    return (new Response(array('status' => true,'msg' => 'Please Select Category'),200))->header('content-Type', "json");
                else{

                        $field_content = array(
                            'content_title'  => Request::input('ttl'),
                            'content_headline'  => Request::input('hed'),
                            'content_detail'  => Request::input('det'),
                            'content_media_id'  => Request::input('med'),
                            'content_users_uploader'  => $uid,
                            'content_last_editor'  => Request::input('cle'),
                            'content_date_insert'  => date('Y-m-d H:i:s'),
                            'content_date_expired'  => Request::input('cde'),
                            'content_publish'  => Request::input('pub'),
                            'content_category_id'  => Request::input('cat'),
                            'content_hashtag_id'  => Request::input('chi'),
                            'content_repost_from'  => Request::input('crf'),
                        );
                        $content = table_content::create($field_content);

                        return (new Response(array('status' => true,'msg' => 'success'),200))->header('content-Type', "json");
                }
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

    public function delete(){
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

                $id_content = Request::input('id');

                table_content::find($id_content)->delete();

                return (new Response(array('status' => true,'msg' => 'success delete content'),200))->header('content-Type', "json");
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




    public function upload_media(){
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
                    $type = 'url';
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

                $file[0] = $media->media_manager_id;
                $file[1] = $title;
                $file[2] = $type;
                $file[3] = $link;
                
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


    public function search_content()
    {                             

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

                $users = table_users_detail::where('users_email','=',$email)
                                ->where('users_name','=',$uname)
                                ->where('users_detail_id','=',$uid)
                                ->first();

                $follow = $users->users_json_following;

                //get query
                $keyword = Request::input('qwr');

                $result = DB::select('Select tc.*, tud.users_name, tcc.content_category_title
                                from table_content_category tcc, table_content tc, table_users_detail tud
                                WHERE tc.content_category_id = tcc.content_category_id
                                AND tud.users_id = tc.content_users_uploader
                                AND tc.content_title like '.$keyword.'
                            ');

                foreach( $result as $res=>$value ){
                     //get media manager
                     $idsplit = explode(',', $value->content_media_id);
                     $length = count($idsplit);
                     $name = '';
                     for($i = 0; $i<$length;$i++){
                        $cek = table_media_manager::where('media_manager_id', '=', $idsplit[$i])->first();
                        if($cek!= null){
                            $name=$name.$cek->media_manager_title.', ';
                        }
                     }

                     //get content repost
                     $cekrepost = table_content::where('content_id', '=', $value->content_repost_from )->first();
                        if($cekrepost!= null){
                            $value->content_repost_from = $cekrepost->content_title;
                     }

                     //get hashtag
                     $idsplittag = explode(',', $value->hashtag_id);
                     $lengthtag = count($idsplittag);
                     $hashtag='';
                     for($j = 0; $j<$lengthtag;$j++){
                        $cektag = table_hashtag::where('hashtag_id', '=', $idsplittag[$j])->first();
                        if($cektag!= null){
                            $hashtag=$hashtag.$cektag->media_manager_title.', ';
                        }
                     }
                     $value->hashtag_id = $hashtag;    
                }

                //this code for convert
                $dataConverted = array();
                $app = app();
                $i = 0;
                foreach($result as $row){
                    $dataConverted[$i] = $app->make('stdClass');
                    $dataConverted[$i]->id = $row->content_id;
                    $dataConverted[$i]->ttl = $row->ccontent_title;
                    $dataConverted[$i]->hed = $row->content_headline;
                    $dataConverted[$i]->det = $row->content_detail;
                    $dataConverted[$i]->med = $row->content_media_id;
                    $dataConverted[$i]->upl = $row->content_users_uploader;
                    $dataConverted[$i]->uun = $row->content_users_uploader_name;
                    $dataConverted[$i]->cle = $row->content_last_editor;
                    $dataConverted[$i]->cdi = $row->content_date_insert;
                    $dataConverted[$i]->cdu = $row->content_date_update;
                    $dataConverted[$i]->cde = $row->content_date_expired;
                    $dataConverted[$i]->pub = $row->content_publish;
                    $dataConverted[$i]->cat = $row->content_category_id;
                    $dataConverted[$i]->ccn = $row->content_category_name;     
                    $dataConverted[$i]->chi = $row->content_hashtag_id;
                    $dataConverted[$i]->crf = $row->content_repost_from;
                    $dataConverted[$i]->crn = $row->content_repost;
                    
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

    public function repost()
    {                             

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

                if(Request::input('cid') == null)
                    return (new Response(array('status' => true,'msg' => 'Please select a content that you want to repost '),200))->header('content-Type', "json");
                else{

                        //get content resource
                        $target = table_content::where('content_id', '=',Request::input('cid'))->first();

                        //input content
                        $field_content = array(
                            'content_title'  => $target->content_title,
                            'content_headline'  => $target->headline,
                            'content_detail'  => $target->content_detail,
                            'content_media_id'  => $target->content_media_id,
                            'content_users_uploader'  => $uid,
                            'content_last_editor'  => $target->content_last_editor,
                            'content_date_insert'  => date('Y-m-d H:i:s'),
                            'content_date_expired'  => $target->content_date_expired,
                            'content_publish'  => $target->content_publish,
                            'content_category_id'  => $target->content_category_id,
                            'content_hashtag_id'  => $target->content_hashtag_id,
                            'content_repost_from'  => $target->content_id,
                        );
                        $content = table_content::create($field_content);

                        //notification repost
                        //input content
                        $field_notiication = array(
                            'users_id'  => $target->content_users_uploader,
                            'datetime'  => date('Y-m-d H:i:s'),
                            'status'  => 'send',
                        );
                        $content = table_notification::create($field_notiication);


                        /*
                        //it always return 1 iterate. i made it but i don't know where a message of notiication store?
                         $dataConverted = array();
                         $app = app();
                         $i=0;
                        $whorepost = table_users_detail::where('users_id', '=',$uid)->first();
                        foreach($whorepost as $row){
                            $dataConverted[$i]->uid = $row->users_id; //send user ID who repost his/her content
                            $dataConverted[$i]->unm = $row->users_name; //send user Name who repost his/her content
                            $dataConverted[$i]->ttl = $target->content_title; //send the Title that reposted
                            $dataConverted[$i]->nci = $whorepost; //send the new content ID to him/her 
                            $dataConverted[$i]->cdi = date('Y-m-d H:i:s'); //send the date repost (insert)

                        }
                        */

                        return (new Response(array('status' => true,'msg' => 'success'),200))->header('content-Type', "json");
                }
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
