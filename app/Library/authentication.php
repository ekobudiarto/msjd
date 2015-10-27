<?php	
	namespace App\Library;
	use DB;
	use Auth;

	class Authentication{
		
		public static function cekAdmin()
		{
			
			$user_id = Auth::id();
	        //$email = Auth::user()->email;
	        $cek = DB::table('table_users_detail')->where('users_id', '=', $user_id)->first();
	        if($cek->users_group_id != 1 || $cek->users_group_id != 2 ){
	        	return false;    
	        }
	        else{
	        	return true;
	        }
		}
		
	}
?>