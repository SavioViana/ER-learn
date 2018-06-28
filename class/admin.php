<?php 

if(!class_exists('Db')){
	require "config/db.class.php";
}



class Admin extends Db{


	function __construct()
	{
		parent::__construct();

		$this->conn = new Db();
	}

	//efetuar um login
	function login($username, $password){
		$sql = "SELECT * FROM admin WHERE admin_username = :USERNAME and admin_password = :PASSWORD";
		$param = array(':USERNAME' => $username,
					':PASSWORD' => $password);



		$stmt = $this->conn->query($sql, $param);

		$u = $stmt->fetchAll(PDO::FETCH_OBJ);


		if(count($u) > 0){
			$_SESSION['admin'] = $username;
			return true;
		}else{
			return false;
		}
	}



	static function isLogin(){

		return isset($_SESSION['admin']);
	}


	static function autentication(){
		if(!self::isLogin()){
			header("location: dashboardLogin.php?error=acesso restrito");
		}
	}


	static function desLogin(){
		unset($_SESSION['admin']);
		//session_destroy();
		header("location: dashboardLogin.php");

	}

}	


?>