<?php

namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\table_schedule;
use App\Models\table_schedule_type;
use App\Models\table_media_manager;
use DB;
use App\Library\authentication;
use Auth;

class controller_schedule extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        authentication::SuperAdminOrAdministrator();      

    }

    public function index()
    {

        $result = DB::table('table_schedule as sch')
                                    ->select('sch.*',DB::raw('(select users_name from table_users_detail where users_id = sch.schedule_users_creator) as users_name_creator'),
                                             DB::raw('(select users_name from table_users_detail where users_id = sch.schedule_users_source) as users_name_source'),
                                             DB::raw('(select schedule_type_name from table_schedule_type where schedule_type_id = sch.schedule_type_id) as schedule_type_name')
                                            )
                                    ->orderBy('schedule_id', 'desc')
                                    ->paginate(10);
        
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
       

         $data=array(
            // 'schedule' => table_schedule::latest('schedule_id')->paginate(10),
            'schedule' => $result,
         );


        return view('admin.database.schedule.schedule-index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=array(
            'schedule_type' => table_schedule_type::select('schedule_type_id','schedule_type_name')->get(), 
            'schedule_typeAuto' => json_encode(DB::select('select schedule_type_id as id, schedule_type_name as label from table_schedule_type')),
            'users_detail' => json_encode(DB::select('select users_id as id, users_name as value, users_name as label from table_users_detail')),
            'media_manager' => json_encode(DB::select('select media_manager_id as id, media_manager_title as name from table_media_manager')),
        );
        
       return view('admin.database.schedule.schedule-create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        table_schedule::create(Request::all());
        return redirect('admin/schedule')->with('success', 'Data saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show($id)
    {
        $data = array(
                'dataschedule' => table_schedule::where('schedule_id', '=', $id)->get(),
                'schedule_type' => table_schedule_type::select('schedule_type_id','schedule_type_name')->get(),
         );
        return view('admin.database.schedule.schedule-show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           
         $data = array(
                'dataschedule' => table_schedule::where('schedule_id', '=', $id)->get(),
                'schedule_type' => table_schedule_type::select('schedule_type_id','schedule_type_name')->get(),
                'schedule_typeAuto' => json_encode(DB::select('select schedule_type_id as id, schedule_type_name as label from table_schedule_type')),
                'users_detail' => json_encode(DB::select('select users_id as id, users_name as value, users_name as label from table_users_detail')),
                'media_manager' => json_encode(DB::select('select media_manager_id as id, media_manager_title as name from table_media_manager')),
         );
         
        //Ambil data schedule
        foreach($data['dataschedule'] as $key => $value){
            $scheduleType = $value->schedule_type_id;
            $usrCreator = $value->schedule_users_creator;
            $usrSource = $value->schedule_users_source;
            $exp = $value->schedule_media_id;
        }
        $tempExp = explode(",", $exp);
        $i = 0;
        for($i;$i<count($tempExp);$i++){
            //$newArray = DB::select('select media_manager_id as id, media_manager_title as name from table_media_manager where media_manager_id='.$tempExp[$i]);
            $newArray = DB::table('table_media_manager')->select('media_manager_id as id', 'media_manager_title as name')->where('media_manager_id', '=', $tempExp[$i])->first();
            $dataMediaManager[$newArray->id] = $newArray->name;
        }
        $data['dataMediaManager'] = $dataMediaManager;
        $data['dataIdMediaManager'] = $exp;
        //END Ambil data schedule
        
        //Ambil data Schedule Type
        $row = DB::table('table_schedule_type')->select('schedule_type_id as id', 'schedule_type_name as value')->where('schedule_type_id', '=', $scheduleType)->first();
        $data['dataScheduleType'] = $row;
        //END Ambil data Schedule Type
        
        //Ambil data users_name
        $users_name = DB::table('table_users_detail')->select('users_id as id', 'users_name as value')->where('users_id', '=', $usrCreator)->first();
        $users_name2 = DB::table('table_users_detail')->select('users_id as id', 'users_name as value')->where('users_id', '=', $usrSource)->first();
        
        $data['dataUsers'] = $users_name;
        $data['dataUsers2'] = $users_name2;
        //END Ambil data users_name
         
        return view('admin.database.schedule.schedule-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $dataUpdate = Request::all();
        $data = table_schedule::find($id);
        $data->update($dataUpdate);
        return redirect('admin/schedule')->with('message', 'Data successfully changed!');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        table_schedule::find($id)->delete();
        return redirect('admin/schedule')->with('warning', 'Data have been removed!');
    
    }
}
