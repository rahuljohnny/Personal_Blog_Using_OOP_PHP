<?php 

	/**
	* Session Class
	*/
	class session
	{
		
		public static function init(){
			session_start();
		}

		public static function set($key, $velue){
			$_SESSION[$key]=$velue;
		}
		public static function get($key){
			if (isset($_SESSION[$key])) {
				return $_SESSION[$key];
			}
			else{
				return false;
			}
		}

		public static function check_session(){
			self:: init();
			if (self:: get("login") == false) {
				self:: destroy();
				header("location: login.php");
			}
		}
		public static function check_login(){
			self:: init();
			if (self:: get("login") == true) {
				header("location: index.php");
			}
		}
		public static function destroy(){
			session_destroy();
			header("location: login.php");
		}
	}


 ?>