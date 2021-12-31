<?php
class Session
{

	public static function init(){
		if (version_compare(phpversion(), '5.4.0', '<')) {
			if (session_id() == '') {
				session_start();
			}
		} else {
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
		}
	}

	public static function set($key, $val) 
	{
		$_SESSION[$key] = $val ;
	}

	public static function get($key) 
	{
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		} else {
			return false;
		}
	}

	public static function checkSession() 
	{
		if (self::get("login") == false) {
			self::destroy();
			header("Location: ".WEB."/");
		}
	}

	public static function checkRole($role) 
	{
		if (self::get("role") != $role) {
			echo '<script>	window.history.back(); </script>';
		}
	}
	

	public static function checkLogin() { 
		if (self::get("login") == true) {
			if(self::get("role")=="1"){
				header("Location: ".WEB."dashboard/index" );
			}if(self::get("role")=="2"){
				header("Location: ".WEB."dashboard/index" );
			}
		}
	}

	public static function destroy() {
		session_destroy();
		session_unset();
		header("Location: ".WEB."index/?logout=success");
	}
}

?>
