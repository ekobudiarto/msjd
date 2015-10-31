<?php

namespace App\Http\Controllers\Admin\dashboard;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\users;
use DB;
use App\Library\authentication;
use Illuminate\Http\Response;

class controller_admin_dashboard extends Controller
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
        if(input::get("tahunUser") == null)
        {
            $tahunUser = date('Y');
        }
        else{
            $tahunUser = input::get("tahunUser");
        }
        
        $month =  DB::select("select MONTH(created_at) MONTH, COUNT(id) COUNT
                            from `users` 
                            where YEAR(created_at) = ".$tahunUser."
                            GROUP BY MONTH(created_at) ");
        
        $users =  DB::select("select name, created_at
                            from `users`
                            ORDER BY id desc ");
        
        $repost =  DB::select("select content_title, (select count(content_id) from `table_content` where content_repost_from = tc.content_id) as count_repost
                            from `table_content` as tc
                            ORDER BY count_repost desc
                            LIMIT 5");
        
        $provider =  DB::select("select providerID, (select count(providerID) from `table_users_detail` where providerID = tud.providerID) as count_provider
                            from `table_users_detail` as tud
                            ORDER BY count_provider desc
                            LIMIT 1");
        
        $deviceVersion =  DB::select("select deviceVersion, (select count(deviceVersion) from `table_users_detail` where deviceVersion = tud.deviceVersion) as count_deviceVersion
                            from `table_users_detail` as tud
                            ORDER BY count_deviceVersion desc
                            LIMIT 1");
        
        $deviceBrand =  DB::select("select deviceBrand, (select count(deviceBrand) from `table_users_detail` where deviceBrand = tud.deviceBrand) as count_deviceBrand
                            from `table_users_detail` as tud
                            ORDER BY count_deviceBrand desc
                            LIMIT 1");
        
        $data = array(
            'month'     => $month,
            'latest'    => $users,
            'repost'    => $repost,
            'provider'  => $provider,
            'deviceVersion' => $deviceVersion,
            'deviceBrand' => $deviceBrand,
            'tahunUser' => $tahunUser
        );

        return view('admin/dashboard/dashboard', compact('data'));
        //return view('admin/dashboard/dashboard');
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
