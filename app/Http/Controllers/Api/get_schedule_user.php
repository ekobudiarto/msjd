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
use App\Models\table_schedule;
use App\Models\table_media_manager;
use DB;

class get_schedule_user extends Controller
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

                //get query

                 $result = DB::select('Select ts.*, tud.users_name as users_name_creator, st.schedule_type_name, tud.users_name as users_name_source
                                from table_schedule ts, table_schedule_type st, table_users_detail tud
                                WHERE ts.schedule_type_id = st.content_category_id
                                AND tud.users_id = ts.schedule_users_creator
                                AND ts.schedule_users_creator = '.$uid.'
                                ORDER BY schedule_id DESC
                            ');
                
                //this foreach for get media manager name and source
                foreach( $result as $res=>$value ){
                     $idsplit = explode(',', $value->schedule_media_id);
                     
                     //get user source
                     $cekuser = table_users_detail::where('users_id', '=', $value->schedule_users_source )->first();
                        if($cekuser!= null){
                            $value->users_name_source = $cekuser->users_name;
                     }

                     $length = count($idsplit);
                     $name = '';
                     for($i = 0; $i<$length;$i++){
                        $cek = table_media_manager::where('media_manager_id', '=', $idsplit[$i])->first();
                        if($cek!= null){
                            $name=$name.$cek->media_manager_title.', ';
                        }
                     }
                     $value->schedule_media_id = $name;
                }

                //this code for convert
				$dataConverted = array();
                $app = app();
                $i = 0;
                foreach($result as $row){
                    $dataConverted[$i] = $app->make('stdClass');
                    $dataConverted[$i]->id = $row->schedule_id;
                    $dataConverted[$i]->ttl = $row->cschedule_title;
                    $dataConverted[$i]->typ = $row->schedule_type_id;
                    $dataConverted[$i]->suc = $row->schedule_users_creator;
                    $dataConverted[$i]->usc = $row->schedule_users_source;
                    $dataConverted[$i]->dst = $row->schedule_date_start;
                    $dataConverted[$i]->dnd = $row->schedule_date_end;
                    $dataConverted[$i]->des = $row->schedule_description;
                    $dataConverted[$i]->hed = $row->schedule_headline;
                    $dataConverted[$i]->med = $row->schedule_media_id;
                    $dataConverted[$i]->pub = $row->schedule_publish;
                    $dataConverted[$i]->rpt = $row->schedule_repeat;
                    $dataConverted[$i]->uns = $row->users_name_source;
                    $dataConverted[$i]->utn = $row->schedule_type_name;
                    $dataConverted[$i]->unc = $row->users_name_creator;
                    
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
                    'schedule_title'  => Request::input('ttl'),
                    'schedule_type_id' => Request::input('typ'),
                    'schedule_users_creator' => $uid,
                    'schedule_users_source' => Request::input('usc'),
                    'schedule_date_start' => Request::input('dst'),
                    'schedule_date_end' => Request::input('dnd'),
                    'schedule_description' => Request::input('des'),
                    'schedule_headline' => Request::input('hed'),
                    'schedule_media_id' => Request::input('med'),
                    'schedule_publish' => Request::input('pub'),
                    'schedule_repeat' => Request::input('rpt'),
                );
                $schedule = table_schedule::create($field_user_detail);

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
