<?php

namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\table_schedule;
use App\Models\table_schedule_type;
use DB;

class controller_schedule extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         $data=array(
            'schedule' => table_schedule::latest('schedule_id')->paginate(10),
            'schedule_type' => table_schedule_type::select('schedule_type_id','schedule_type_name')->get(),
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
