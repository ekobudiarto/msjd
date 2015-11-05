<?php

namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\table_banned_report;
use DB;
use App\Library\authentication;
use Auth;

class controller_banned_report extends Controller
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
          
            'banned_report' => DB::table('table_banned_report as br')
                                    ->select('br.*',DB::raw('(select users_name from table_users_detail where users_id = br.users_by) as users_name_by'), 
                                                   DB::raw('(select users_name from table_users_detail where users_id = br.users_dest) as users_name_dest'),
                                                   DB::raw('(select content_title from table_content where content_id = br.content_id) as content_title') 
                                            )
                                    ->orderBy('banned_report_id', 'desc')
                                    ->paginate(10),
         );


        return view('admin.database.banned-report.banned-report-index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.database.banned-report.banned-report-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        table_banned_report::create(Request::all());
        return redirect('admin/banned-report')->with('success', 'Data saved successfully!');
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
                'databanned' => table_banned_report::where('banned_report_id', '=', $id)->get(),
         );     
        return view('admin.database.banned-report.banned-report-show', compact('data'));
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
                'databanned' => table_banned_report::where('banned_report_id', '=', $id)->get(),
         );     
        return view('admin.database.banned-report.banned-report-edit', compact('data'));
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
        $data = table_banned_report::find($id);
        $data->update($dataUpdate);
        return redirect('admin/banned-report')->with('message', 'Data successfully changed!');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        table_banned_report::find($id)->delete();
        return redirect('admin/banned-report')->with('warning', 'Data have been removed!');
    
    }
}
