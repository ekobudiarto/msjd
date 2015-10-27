<?php	
	namespace App\Library;
	use DB;
	use Auth;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\Redirect;
	use App\Models\table_users_detail;
	use App\Models\table_users_group;

	class Authentication{
		
		public static function SuperAdminOrAdministrator()
		{
			if(session()->get('is_public') == 'yes'){
				return true;
			}
			else{

				Redirect::to('auth/login')->send();
			}
		}




		





		
	}
?>