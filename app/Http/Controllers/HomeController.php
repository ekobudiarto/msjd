<?php 
namespace App\Http\Controllers;
use DB;
use Auth;

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
			$user_id = Auth::id();
			$cek = DB::table('table_users_detail')->where('users_id', '=', $user_id)->first();
	        if($cek->users_group_id == 1 ){
	        	return redirect('admin/dashboard');    
	        }
	        else if($cek->users_group_id == 2 ){
	        	return redirect('admin/dashboard'); 
	        }
	        else if($cek->users_group_id == 3 ){
	        	echo "You are logged in as Content Writer. Your page is under construction";
	        	die();
	        }
	        else if($cek->users_group_id == 4 ){
	        	echo "You are logged in as Jamaah. Your page is under construction";
	        	die();
	        }
	        else if($cek->users_group_id == 5 ){
	        	echo "You are logged in as Ustadz. Your page is under construction";
	        	die();
	        }
	        else if($cek->users_group_id == 6 ){
	        	echo "You are logged in as Masjid. Your page is under construction";
	        	die();
	        }

				
	}

}
