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

class content_each_user extends Controller
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

                $follow = $users->users_json_following;

                //get query

                $result = DB::table('table_content as ct')
                                    ->select('ct.*',DB::raw('(select content_category_title from table_content_category where content_category_id = ct.content_category_id) as content_category_title'),
                                             DB::raw('(select content_title from table_content where content_id = ct.content_repost_from) as content_repost'),
                                             DB::raw('(select users_name from table_users_detail where users_id = ct.content_users_uploader) as content_uploader_name')
                                            )
                                    ->where('ct.content_users_uploader','IN','('.$follow.')'),
                                    ->orderBy('content_id', 'desc');

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
                    $dataConverted[$i]->med = $row->content_last_editor;
                    $dataConverted[$i]->cdi = $row->content_date_insert;
                    $dataConverted[$i]->cdu = $row->content_date_update;
                    $dataConverted[$i]->upl = $row->content_date_expired;
                    $dataConverted[$i]->pub = $row->content_publish;
                    $dataConverted[$i]->cat = $row->content_category_id;
                    $dataConverted[$i]->cat = $row->content_category_name;     
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

                $field_user_detail = array(
                    'content_title'  => Request::input('ttl'),
                    'content_type_id' => Request::input('typ'),
                    'content_users_creator' => $uid,
                    'content_users_source' => Request::input('usc'),
                    'content_date_start' => Request::input('dst'),
                    'content_date_end' => Request::input('dnd'),
                    'content_description' => Request::input('des'),
                    'content_headline' => Request::input('hed'),
                    'content_media_id' => Request::input('med'),
                    'content_publish' => Request::input('pub'),
                    'content_repeat' => Request::input('rpt'),
                );
                $user = table_content::create($field_user_detail);

                return (new Response(array('status' => true,'msg' => 'success'),200))->header('content-Type', "json");
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
