<?php	
	namespace App\Library;
	
	class GlobalLibrary{
		
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