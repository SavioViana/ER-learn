<?php

require "config/db.class.php";

class User extends Db{

	public $type = 0;

	function __construct()
	{
		parent::__construct();

		$this->conn = new Db();
	}


	//adicionar um novo usuario
	public function userAdd($name, $cpf, $rg, $type, $state, $city, $publicSpace, $number, $email, $password, $phone){

		$sql = "INSERT INTO user (user_name, user_cpf, user_rg, user_type, user_state, user_city, user_public_space, user_number, user_email, user_password, user_phone) 
		VALUES (:NAME, :CPF, :RG, :TYPE, :STATE, :CYTE, :PUBLICSPACE, :NUM, :EMAIL, :PASS, :PHONE)";

		$param = array(':NAME' => $name, 
						':CPF' => $cpf, 
						':RG' => $rg, 
						':TYPE' => $type, 
						':STATE' => $state,
						':CYTE' => $city,
						':PUBLICSPACE' => $publicSpace,
						':NUM' => $number,
						':EMAIL' => $email,
						':PASS' => $password,
						':PHONE' => $phone );


	
			$stmt = $this->conn->query($sql, $param);

			return $stmt;


	}


	//efetuar um login
	function login($email, $password){
		$sql = "SELECT * FROM user WHERE user_email = :EMAIL and user_password = :PASSWORD";
		$param = array(':EMAIL' => $email,
					':PASSWORD' => $password);



		$stmt = $this->conn->query($sql, $param);

		$u = $stmt->fetchAll(PDO::FETCH_OBJ);


		if(count($u) > 0){
			$this->type = $u[0]->user_type;
			
			$_SESSION['usuario'] = $email;
			return true;
		}else{
			return false;
		}
	}



	static function isLogin(){

		return isset($_SESSION['usuario']);
	}


	static function autentication(){
		if(!self::isLogin()){
			header("location: login.php?error=acesso restrito");
		}
	}


	static function desLogin(){
		unset($_SESSION['usuario']);
		//session_destroy();
		header("location: login.php");

	}



	//edit users
	public function nameEdit($id, $name){
		$sql = "UPDATE user set user_name = :NAME WHERE user_id = :ID";

		$param = array(':NAME' => $name, 
				  ':ID' => $id); 

		$stmt = $this->conn->query($sql, $param);

		return $stmt;
	}


	//edit email
	public function emailEdit($id, $email){
		$sql = "UPDATE user set user_email = :EMAIL WHERE user_id = :ID";

		$param = array(':EMAIL' => $email, 
				  ':ID' => $id); 

		$stmt = $this->conn->query($sql, $param);

		return $stmt;
	}


	public function passwordEdit($id, $passwordNew){

		$sql = "UPDATE user set user_password = :PASSNEW WHERE user_id = :ID";

		$param = array(':PASSNEW' => $passwordNew, 
				  ':ID' => $id); 

		$stmt = $this->conn->query($sql, $param);

		return $stmt;
	}


	public function addressEdit($id, $state, $city, $publicSpace, $number, $phone){

		$sql = "UPDATE user set user_state=:STATE, 
								user_city=:CITY, 
								user_public_space=:PUBLICSPACE, 
								user_number=:NUM, 
								user_phone = :PHONE 
								WHERE user_id = :ID";

		$param = array(':STATE' => $state, 
				  		':CITY' => $city,
						':PUBLICSPACE' => $publicSpace,
						':NUM' => $number,
						':PHONE' => $phone,
						':ID' => $id); 

		$stmt = $this->conn->query($sql, $param);

		return $stmt;
	}


	public function selectAll(){
		$sql = "SELECT * FROM user ORDER BY user_name";

		$stmt = $this->conn->query($sql);

		$value = $stmt->fetchAll(PDO::FETCH_OBJ);
		
		return $value;
	}


	public function selectOne($id){
		$sql = "SELECT * FROM user WHERE user_id = :ID";
		$param = array(':ID' => $id);

		$stmt = $this->conn->query($sql,$param);

		$value = $stmt->fetchAll(PDO::FETCH_OBJ);

		return $value;
	}

	public function searchStudent($name){
		$sql = "SELECT * FROM user WHERE user_type = 2 and 
				(user_email LIKE :VALUE OR user_name LIKE :VALUE)";
				$param = array(':VALUE' => '%'.$name.'%');

		$stmt = $this->conn->query($sql,$param);

		$value = $stmt->fetchAll(PDO::FETCH_OBJ);

		return $value;
	}

	//metodo retorda o usuario que esta logado no momento
	public function getCurrentUser($email){

		$sql = "SELECT * from user WHERE user.user_email = :EMAIL";
		$param = array(':EMAIL' => $email);

		$stmt = $this->conn->query($sql, $param);
	
		$currentUser = $stmt->fetchAll(PDO::FETCH_OBJ);

		return $currentUser[0];

	}

	//metodo retorda um usuario qualquer
	public function getUser($id){

		$sql = "SELECT * from user WHERE user.user_id = :ID";
		$param = array(':ID' => $id);

		$stmt = $this->conn->query($sql, $param);
		
		print_r($stmt);
		$user = $stmt->fetchAll(PDO::FETCH_OBJ);

		return $user[0];

	}

}



?>