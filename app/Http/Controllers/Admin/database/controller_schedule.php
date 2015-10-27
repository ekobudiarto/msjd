<?php

namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\table_schedule;
use App\Models\table_schedule_type;
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
         $data=array(
            'schedule' => table_schedule::latest('schedule_id')->paginate(10),
            'schedule' => DB::table('table_schedule as sch')
                                    ->select('sch.*',DB::raw('(select users_name from table_users_detail where users_id = sch.schedule_users_creator) as users_name_creator'),
                                             DB::raw('(select users_name from table_users_detail where users_id = sch.schedule_users_source) as users_name_source'),
                                             DB::raw('(select schedule_type_name from table_schedule_type where schedule_type_id = sch.schedule_type_id) as schedule_type_name'),
                                             DB::raw('(select media_manager_title from table_media_manager where media_manager_id = sch.schedule_media_id) as media_manager_title')
                                            )
                                    ->paginate(10),
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
            //'schedule_type' => table_schedule_type::select('schedule_type_id','schedule_type_name')->get(), 
            'schedule_type' => table_schedule_type::select('schedule_type_id','schedule_type_name')->get(),
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
        return redirect('admin/schedule')->with('success', 'Data berhasil ditambahkan!');
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
         );     
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
        return redirect('admin/schedule')->with('message', 'Data berhasil dirubah!');
    
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
        return redirect('admin/schedule')->with('warning', 'Data berhasil dihapus!');
    
    }
}
