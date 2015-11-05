<?php	
	namespace App\Library;
	
	class GlobalLibrary{
		
		public static function tokenGenerator($user)
		{
			$u_id = $user->id;
			$u_name = $user->users_name;
			$u_email = $user->users_email;
			$u_group = $user->users_group_id;
			$u_full = $user->users_fullname;
			
			$part_username = base64_encode($u_name);
			$split_email = explode("@", $u_email);
			$email_name = $split_email[0];
			$email_provider = $split_email[1];
			$split_domain = explode(".", $email_provider);
			$domain_name = $split_domain[0];
			$domain_ext = $split_domain[1];
			$u_group = base64_encode($u_group);
			$u_full = base64_encode($u_full);
			$time = base64_encode(date("Y-m-d H:i:s"));
			
			//format 
			$part_1 = $domain_ext."---".$u_group.'---'.$domain_name.'---';
			$part_2 = base64_encode($email_name).'---'.$part_username.'---'.$u_full.'---'.$time;
			return base64_encode($part_1.$part_2);
		}
		
		public static function tokenExtractor($token)
		{
			$data = array();
			$data_string = base64_decode($token);
			$split_all = explode("---", $data_string);
			$data[0] = $split_all[0]; //ext domain .com
			$data[1] = base64_decode($split_all[1]); //group id
			$data[2] = $split_all[2]; //domain name like cupslice if email @cupslice.com
			$data[3] = base64_decode($split_all[3]);  //email name eko if email eko@cupslice.com
			$data[4] = base64_decode($split_all[4]);  //username
			$data[5] = base64_decode($split_all[5]);  //Fullname;
			return $data;
		}
		public static function compareToken($token)
		{
			return true;
		}
		
		public static function hashPassword($value)
		{
			return md5('m45J!D+'.$value);
		}
	}
?>