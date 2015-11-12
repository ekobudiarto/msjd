<?php

namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\table_banned_report;
use DB;
use App\Library\authentication;
use Auth;
use app\user;

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
       $data = array(
                    'users_detail' => json_encode(DB::select('select users_id as id, users_name as value, users_name as label from table_users_detail')),
                    'content' => json_encode(DB::select('select content_id as id, content_title as value, content_title as label from table_content')),
                );
       
       return view('admin.database.banned-report.banned-report-create', compact('data'));
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
                'users_detail' => json_encode(DB::select('select users_id as id, users_name as value, users_name as label from table_users_detail')),
                'content' => json_encode(DB::select('select content_id as id, content_title as value, content_title as label from table_content')),
         );
        
        foreach($data['databanned'] as $key => $value){
            $userBy = $value->users_by;
            $userDest = $value->users_dest;
            $contentId = $value->content_id;
        }
        
        //Ambil data
        $users_name = DB::table('table_users_detail')->select('users_id as id', 'users_name as value', 'users_name as label')->where('users_id', '=', $userBy)->first();
        $users_name2 = DB::table('table_users_detail')->select('users_id as id', 'users_name as value', 'users_name as label')->where('users_id', '=', $userDest)->first();
        $content_id = DB::table('table_content')->select('content_id as id', 'content_title as value', 'content_title as label')->where('content_id', '=', $contentId)->first();
        
         if($users_name != null)
            $data['dataUsers'] = $users_name;
        else 
            $data['dataUsers'] = '';
        
        if($users_name2 != null)
            $data['dataUsers2'] = $users_name2;
        else
            $data['dataUsers2'] = '';

        if ($content_id !=null)
            $data['contentId'] = $content_id;
        else
            $data['contentId'] = '';

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
                'users_detail' => json_encode(DB::select('select users_id as id, users_name as value, users_name as label from table_users_detail')),
                'content' => json_encode(DB::select('select content_id as id, content_title as value, content_title as label from table_content')),
         );
        
        foreach($data['databanned'] as $key => $value){
            $userBy = $value->users_by;
            $userDest = $value->users_dest;
            $contentId = $value->content_id;
        }
        
        //Ambil data
        $users_name = DB::table('table_users_detail')->select('users_id as id', 'users_name as value', 'users_name as label')->where('users_id', '=', $userBy)->first();
        $users_name2 = DB::table('table_users_detail')->select('users_id as id', 'users_name as value', 'users_name as label')->where('users_id', '=', $userDest)->first();
        $content_id = DB::table('table_content')->select('content_id as id', 'content_title as value', 'content_title as label')->where('content_id', '=', $contentId)->first();
        
        if($users_name != null)
            $data['dataUsers'] = $users_name;
        else 
            $data['dataUsers'] = '';
        
        if($users_name2 != null)
            $data['dataUsers2'] = $users_name2;
        else
            $data['dataUsers2'] = '';

        if ($content_id !=null)
            $data['contentId'] = $content_id;
        else
            $data['contentId'] = '';
        //END Ambil data
         
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
