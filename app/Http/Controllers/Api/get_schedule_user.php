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
use DB;

class schedule_each_user extends Controller
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

                //get query
                $result = DB::table('table_schedule as sch')
                                    ->select('sch.*',DB::raw('(select users_name from table_users_detail where users_id = sch.schedule_users_creator) as users_name_creator'),
                                             DB::raw('(select users_name from table_users_detail where users_id = sch.schedule_users_source) as users_name_source'),
                                             DB::raw('(select schedule_type_name from table_schedule_type where schedule_type_id = sch.schedule_type_id) as schedule_type_name')
                                            )
                                    ->where('sch.users_creator',$uid)
                                    ->orderBy('schedule_id', 'desc');
                
                //this foreach for get media manager name
                foreach( $result as $res=>$value ){
                     $idsplit = explode(',', $value->schedule_media_id);
                     
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
                    $dataConverted[$i]->usc = $row->schedule_users_source;
                    $dataConverted[$i]->dst = $row->schedule_date_start;
                    $dataConverted[$i]->dnd = $row->schedule_date_end;
                    $dataConverted[$i]->des = $row->schedule_description;
                    $dataConverted[$i]->hed = $row->schedule_headline;
                    $dataConverted[$i]->med = $row->schedule_media_id;
                    $dataConverted[$i]->pub = $row->schedule_publish;
                    $dataConverted[$i]->rpt = $row->schedule_repeat;
                    
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
