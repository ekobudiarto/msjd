<?php

namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Models\table_notification;
use App\Library\authentication;
use Auth;
use app\user;

class controller_notification extends Controller
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
            'notification' => DB::table('table_notification as no')
                                    ->select('no.*',DB::raw('(select users_name from table_users_detail where users_id = no.users_id) as users_name'))
                                    ->orderBy('notification_id', 'desc')
                                    ->paginate(10),
         );


        return view('admin.database.notification.notification-index', compact('data'));
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
       return view('admin.database.notification.notification-create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        table_notification::create(Request::all());
        return redirect('admin/notification')->with('success', 'Data saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show($id)
    {
        $notification = table_notification::where('notification_id', '=', $id)->first();
        $user = user::where('id', '=', $notification->users_id)->first();
        if($user != null)
            $username = $user->name;
        else
            $username ='';

        $data = array(
                'user_name'  => $username,
                'notification' => table_notification::where('notification_id', '=', $id)->get(),
         );     
        return view('admin.database.notification.notification-show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           
         $notification = table_notification::where('notification_id', '=', $id)->first();
         $user = user::where('id', '=', $notification->users_id)->first();
         if($user != null)
            $username = $user->name;
         else
            $username ='';

        $data = array(
                'user_name'  => $username,
                'notification' => table_notification::where('notification_id', '=', $id)->get(),
                'users_detail' => json_encode(DB::select('select users_id as id, users_name as value, users_name as label from table_users_detail')),

         );     

        return view('admin.database.notification.notification-edit', compact('data'));
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
        $data = table_notification::find($id);
        $data->update($dataUpdate);
        return redirect('admin/notification')->with('message', 'Data successfully changed!');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        table_notification::find($id)->delete();
        return redirect('admin/notification')->with('warning', 'Data have been removed!');
    
    }
}
