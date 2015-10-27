<?php 
namespace App\Http\Controllers;

use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\table_users_detail;
use App\Models\table_users_group;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
			
			if(!isset($is_public)){
				$user_id = Auth::id();
				$cek = DB::table('table_users_detail')->where('users_id', '=', $user_id)->first();
				$user = table_users_detail::where('users_id','=',$user_id)->first();
				$group = table_users_group::where('users_group_id','=',$user->users_group_id)->first();
				$is_public = $group->users_group_is_public;
			}
			if($is_public == "0"){
				session(['is_public' => 'yes' ]);
				return redirect('admin/dashboard');
			}
			else
			{
				echo "<center><h1>HOME</h1>You are not an ADMIN, <br/>
				You redirected to HOME page that corresponds to your authentication.<br/> This page is under construction</center>";
				die();
				
			}
	        
	        // if($cek->users_group_id == 1 ){
	        // 	return redirect('admin/dashboard');    
	        // }
	        // else if($cek->users_group_id == 2 ){
	        // 	return redirect('admin/dashboard'); 
	        // }
	        // else if($cek->users_group_id == 3 ){
	        // 	echo "You are logged in as Content Writer. Your page is under construction";
	        // 	die();
	        // }
	        // else if($cek->users_group_id == 4 ){
	        // 	echo "You are logged in as Jamaah. Your page is under construction";
	        // 	die();
	        // }
	        // else if($cek->users_group_id == 5 ){
	        // 	echo "You are logged in as Ustadz. Your page is under construction";
	        // 	die();
	        // }
	        // else if($cek->users_group_id == 6 ){
	        // 	echo "You are logged in as Masjid. Your page is under construction";
	        // 	die();
	        // }

				
	}

}
