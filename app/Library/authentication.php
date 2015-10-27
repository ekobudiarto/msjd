<?php	
	namespace App\Library;
	use DB;
	use Auth;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\Redirect;

	class Authentication{

		public static function redirecthome($id){
			if($id == 1 ){
	        	return Redirect::to('admin/dashboard')->send();
	        }
	        else if($id == 2 ){
	        	return redirect('admin/dashboard')->send(); 
	        }
	        else if($id == 3 ){
	        	echo "You are logged in as Content Writer. Your page is under construction";
	        	die();
	        }
	        else if($id == 4 ){
	        	echo "You are logged in as Jamaah. Your page is under construction";
	        	die();
	        }
	        else if($id == 5 ){
	        	echo "You are logged in as Ustadz. Your page is under construction";
	        	die();
	        }
	        else if($id == 6 ){
	        	echo "You are logged in as Masjid. Your page is under construction";
	        	die();
	        }
		}

		
		public static function SuperAdminOrAdministrator()
		{
			
			$user_id = Auth::id();
	        //$email = Auth::user()->email;
	        $cek = DB::table('table_users_detail')->where('users_id', '=', $user_id)->first();
	        if($cek->users_group_id == 1 || $cek->users_group_id == 2 ){
	        	return true;    
	        }
	        else{
	        	return self::redirecthome($cek->users_group_id);
	        }
		}




		





		
	}
?>