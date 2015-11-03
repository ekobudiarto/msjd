<?php

namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\table_users_detail;
use App\User;
use App\Library\authentication;
use Auth;
use DB;
use Illuminate\Support\Facades\Input;

class controller_users_detail extends Controller
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
           
            'users-detail' =>  DB::table('users as us')
                                    ->select('us.*',DB::raw('(select users_name from table_users_detail where users_id = us.id) as users_name'),
                                                    DB::raw('(select users_group_id from table_users_detail where users_id = us.id) as users_groups_id'),
                                                    DB::raw('(select media_manager_id from table_users_detail where users_id = us.id) as media_managers_id'),
                                                    DB::raw('(select users_group_name from table_users_group where users_group_id = users_groups_id) as users_group_name'),
                                                    DB::raw('(select media_manager_title from table_media_manager where media_manager_id = media_managers_id) as media_manager_title')
                                        )
                                    ->paginate(10),
         );


        return view('admin.database.users-detail.users-detail-index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.database.users-detail.users-detail-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $name = input::get('users_name');
        $fullname = input::get('users_fullname');
        $groupid = input::get('users_group_id');
        $email = input::get('users_email');
        $telp = input::get('users_telp');
        $jsonfollow = input::get('users_json_following');
        $description = input::get('users_description');
        $media = input::get('media_manager_id');
        $avatar = input::get('users_avatar');
        $status = input::get('users_status_id');
        $device = input::get('deviceID');
        $provider = input::get('providerID');
        $deviceversion = input::get('deviceVersion');
        $brand = input::get('deviceBrand');
        $long = input::get('long');
        $lat = input::get('lat');
        $password = input::get('password');


        $cekmail = User::where('email', '=', $email)->first();
        if(isset($cekmail->id)){
            return redirect('admin/users-detail')->with('failed', 'Failed to save, because The email have ever used !');
        }

        $field_users = array(
                    'name' => $name,
                    'email' => $email,
                    'password' => bcrypt($password)
                );
        $user = User::create($field_users);
        
        $user_login = User::where('email', '=', $email)->first();

        foreach ($user_login as $key => $value) {
            $id = $user_login->id;
        }

        $datausersdetail= array(
            'users_name' => $name,
            'users_id' => $id,
            'users_fullname' => $fullname,
            'users_group_id' => $groupid,
            'users_email' => $email,
            'users_telp' => $telp,
            'users_json_following' => $jsonfollow,
            'users_description' => $description,
            'media_manager_id' => $media,
            'users_avatar' => $avatar,
            'users_status_id' => $status,
            'deviceID' => $device,
            'providerID' =>$provider,
            'deviceVersion' => $deviceversion,
            'deviceBrand' => $brand,
            'long' => $long,
            'lat' => $lat          
        );

        table_users_detail::create($datausersdetail);
        return redirect('admin/users-detail')->with('success', 'Data saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = table_users_detail::where('users_id', '=', $id)->first();
        $idusersdetail = $detail->users_detail_id;
        $data = array(
                'users-detail' => table_users_detail::where('users_detail_id', '=', $idusersdetail)->first(),
         );   
        return view('admin.database.users-detail.users-detail-show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = table_users_detail::where('users_id', '=', $id)->first();
        $idusersdetail = $detail->users_detail_id;
        $data = array(
                'users-detail' => table_users_detail::where('users_detail_id', '=', $idusersdetail)->get(),
         );


        return view('admin.database.users-detail.users-detail-edit', compact('data'));
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

        $name = input::get('users_name');
        $fullname = input::get('users_fullname');
        $groupid = input::get('users_group_id');
        $email = input::get('users_email');
        $telp = input::get('users_telp');
        $jsonfollow = input::get('users_json_following');
        $description = input::get('users_description');
        $media = input::get('media_manager_id');
        $avatar = input::get('users_avatar');
        $status = input::get('users_status_id');
        $device = input::get('deviceID');
        $provider = input::get('providerID');
        $deviceversion = input::get('deviceVersion');
        $brand = input::get('deviceBrand');
        $long = input::get('long');
        $lat = input::get('lat');


        $cekmail = User::where('email', '=', $email)->first();
        if(isset($cekmail->id)){
            if($cekmail->id != $id )
            return redirect('admin/users-detail')->with('failed', 'Failed to save, because The email have ever used !');
        }

        $field_users = array(
                    'name' => $name,
                    'email' => $email
                );

        $data = user::find($id);
        $data->update($field_users);


        $user_login = table_users_detail::where('users_id', '=', $id)->first();
        $usersiddetail = $user_login->users_detail_id;


        $datausersdetail= array(
            'users_name' => $name,
            'users_fullname' => $fullname,
            'users_group_id' => $groupid,
            'users_email' => $email,
            'users_telp' => $telp,
            'users_json_following' => $jsonfollow,
            'users_description' => $description,
            'media_manager_id' => $media,
            'users_avatar' => $avatar,
            'users_status_id' => $status,
            'deviceID' => $device,
            'providerID' =>$provider,
            'deviceVersion' => $deviceversion,
            'deviceBrand' => $brand,
            'long' => $long,
            'lat' => $lat          
        );

        $data = table_users_detail::find($usersiddetail);
        $data->update($datausersdetail);

        return redirect('admin/users-detail')->with('message', 'Data successfully changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail = table_users_detail::where('users_id', '=', $id)->first();
        if(isset($detail->users_detail_id)){
            $idusersdetail = $detail->users_detail_id;
            table_users_detail::find($idusersdetail)->delete();
        }
        
        user::find($id)->delete();
        return redirect('admin/users-detail')->with('warning', 'Data have been removed!');
    }
}
