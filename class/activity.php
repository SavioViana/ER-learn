<?php

if(!class_exists('Db')){
	require "config/db.class.php";
}

class Activity extends Db{

	function __construct()
	{
		parent::__construct();

		$this->conn = new Db();
	}


	public function addActivity($fkStudentGroup, $title, $description){
		$sql = "INSERT INTO activity (activity_title, activity_description, fk_student_group) VALUES (:TITLE, :DESCRIPTION, :FK)";

		$param = array(':TITLE' => $title,
					':DESCRIPTION' => $description,
					':FK' => $fkStudentGroup );

		$stmt = $this->conn->query($sql, $param);
		//print_r($stmt);
		return $stmt;
	}


	public function editActivity($idActivity, $title, $description){
		$sql = "UPDATE activity SET activity_title = :TITLE, 
									activity_description = :DESCRIPTION
									WHERE activity_id = :ID";

		$param = array(':TITLE' => $title,
					':DESCRIPTION' => $description,
					':ID' => $idActivity );

		$stmt = $this->conn->query($sql, $param);
		//print_r($stmt);
		return $stmt;
	}

	public function deleteActivity($idActivity){
		$sql = "DELETE FROM activity WHERE activity_id = :ID";

		$param = array(':ID' => $idActivity );

		$stmt = $this->conn->query($sql, $param);
		//print_r($stmt);
		return $stmt;
	}

	
	public function selectActivityGroup($fkStudentGroup){
		$sql = "SELECT * FROM activity WHERE activity.fk_student_group = :FK";

		$param = array(':FK' => $fkStudentGroup);

		$stmt = $this->conn->query($sql, $param);

		$activities = $stmt->fetchAll(PDO::FETCH_OBJ);

		return $activities;
	}

	public function upadeStatusActivity($activity_id, $status){
		
		$sql = "UPDATE activity SET activity.activity_status = :STATUS WHERE activity.activity_id = :ID";

		$param = array(':STATUS' => $status,
						':ID' => $activity_id);

		$stmt = $this->conn->query($sql, $param);
		
		return $stmt;
	}


	public function selectActivityGroupStudent($email){
		$sql = "SELECT * FROM activity
				inner JOIN student_group on activity.fk_student_group = student_group.student_group_id
				INNER JOIN user as aluno on student_group.fk_user_student = aluno.user_id
				WHERE aluno.user_email = :EMAIL ";

		$param = array(':EMAIL' => $email);

		$stmt = $this->conn->query($sql, $param);

		$activities = $stmt->fetchAll(PDO::FETCH_OBJ);

		return $activities;
	}


	public function selectActivityAll(){
		$sql = "SELECT * FROM activity";

		$stmt = $this->conn->query($sql);

		$activities = $stmt->fetchAll(PDO::FETCH_OBJ);

		return $activities;
	}


	//metodo retorna todas as atividades cadastrada por um professor
	public function selectActivityTeacher($idTeacher){
		$sql = "SELECT activity.*, student_group.*, user.user_name as name_student FROM activity 
				inner JOIN student_group on activity.fk_student_group = student_group.student_group_id 
				INNER JOIN user on student_group.fk_user_student = user.user_id
				WHERE student_group.fk_user_teacher = $idTeacher";

		$stmt = $this->conn->query($sql);

		$activitiesTeacher = $stmt->fetchAll(PDO::FETCH_OBJ);

		return $activitiesTeacher;

	}


	//metodo seleciona uma atividade
	public function selectActivity($activityId){
		$sql = "SELECT * FROM activity WHERE activity_id = :ID";
		$param = array(':ID' => $activityId);

		$stmt = $this->conn->query($sql, $param);

		$activity = $stmt->fetchAll(PDO::FETCH_OBJ);

		$activity = $activity[0];

		return $activity;
	}

	//metodo que retorna a quantidade de atividades abertas de um estudante
	public function getCountActivityOpenGroup($idGroup){
		$sql = "SELECT COUNT(*) as count_activity_open  from activity 
				WHERE activity.fk_student_group = :ID AND activity.activity_status = 0";
		$param = array(':ID' => $idGroup);

		$stmt = $this->conn->query($sql, $param);

		$count = $stmt->fetchAll(PDO::FETCH_OBJ);

		$count = $count[0];

		return $count->count_activity_open;

	}

	//metodo que retorna a quantidade de atividades fechada de um estudante
	public function getCountActivityCloseGroup($idGroup){
		$sql = "SELECT COUNT(*) as count_activity_close  from activity 
				WHERE activity.fk_student_group = :ID AND activity.activity_status = 1";
		$param = array(':ID' => $idGroup);

		$stmt = $this->conn->query($sql, $param);

		$count = $stmt->fetchAll(PDO::FETCH_OBJ);

		$count = $count[0];

		return $count->count_activity_close;

	}

	//metodo que retorna a quantidade total de atividades de um estudante
	public function getCountActivityAllGroup($idGroup){
		$sql = "SELECT COUNT(*) as count_activity  from activity WHERE activity.fk_student_group = :ID";
		$param = array(':ID' => $idGroup);

		$stmt = $this->conn->query($sql, $param);

		$count = $stmt->fetchAll(PDO::FETCH_OBJ);

		$count = $count[0];

		return $count->count_activity;
	}

}