<?php

namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use App\Models\table_last_login;
use App\Library\authentication;
use Auth;

class controller_last_login extends Controller
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
            'last_login' => DB::table('table_last_login as no')
                                    ->select('no.*',DB::raw('(select users_name from table_users_detail where users_id = no.users_id) as users_name'))
                                    ->orderBy('last_login_id', 'desc')
                                    ->paginate(10),
         );


        return view('admin.database.last-login.last-login-index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=array(
            'users_detail' => json_encode(DB::select('select users_id as id, users_name as value, users_name as label from table_users_detail')),
        );
       return view('admin.database.last-login.last-login-create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        table_last_login::create(Request::all());
        return redirect('admin/last-login')->with('success', 'Data saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show($id)
    {
         $lastlogin = table_last_login::where('last_login_id', '=', $id)->first();
         $user = user::where('id', '=', $lastlogin->users_id)->first();
         if($user !=null)
            $username = $user->name;
         else
            $username ='';
        
        $data = array(
                'user_name'  => $username,
                'last_login' => table_last_login::where('last_login_id', '=', $id)->get(),
         );     
        return view('admin.database.last-login.last-login-show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $lastlogin = table_last_login::where('last_login_id', '=', $id)->first();
         $user = user::where('id', '=', $lastlogin->users_id)->first();
         if($user !=null)
            $username = $user->name;
         else
            $username ='';
        
         $data = array(
                'user_name'  => $username,
                'last_login' => table_last_login::where('last_login_id', '=', $id)->get(),
                'users_detail' => json_encode(DB::select('select users_id as id, users_name as value, users_name as label from table_users_detail')),

         );     
        return view('admin.database.last-login.last-login-edit', compact('data'));
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
        $data = table_last_login::find($id);
        $data->update($dataUpdate);
        return redirect('admin/last-login')->with('message', 'Data successfully changed!');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        table_last_login::find($id)->delete();
        return redirect('admin/last-login')->with('warning', 'Data have been removed!');
    
    }
}
