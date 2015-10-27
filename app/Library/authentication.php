<?php	
	namespace App\Library;
	use DB;
	use Auth;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\Redirect;
	use App\Models\table_users_detail;
	use App\Models\table_users_group;

	class Authentication{

		public static function redirecthome($id){
			//return Redirect::to('admin/dashboard')->send();
		}

		
		public static function SuperAdminOrAdministrator()
		{
			//$this->middleware('auth');
			$user_id = Auth::id();
			if(isset($user_id))
			{
				$user = table_users_detail::where('users_id','=',$user_id)->first();
				$group = table_users_group::where('users_group_id','=',$user->users_group_id)->first();
				$is_public = $group->users_group_is_public;
				if($is_public == "1"){
					return redirect('admin/dashboard');
				}
				else
				{
					return redirect('auth/login');
				}
			}
			else
			{
				return redirect('auth/login');
			}
		}




		





		
	}
?>