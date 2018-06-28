<?php

if(!class_exists('Db')){
	require "config/db.class.php";
}

class StudentGroup extends Db{

	function __construct()
	{
		parent::__construct();

		$this->conn = new Db();
	}


	public function addGroup($fkTeacher, $fkStudent){
		$sql = "INSERT INTO student_group (fk_user_student, fk_user_teacher) 
				VALUES(:FKSTUDENT, :FkTEACHER)";

		$param = array(':FKSTUDENT' => $fkStudent,
					':FkTEACHER' => $fkTeacher );

		$stmt = $this->conn->query($sql, $param);
		
		return $stmt;
	}


	public function selectAllStudents($fkTeacher){
		$sql = "SELECT * FROM user
				INNER JOIN student_group on user.user_id = student_group.fk_user_student
				WHERE user_type = 2 AND student_group.fk_user_teacher =  :FkTEACHER";

		$param = array(':FkTEACHER' => $fkTeacher);

		$stmt = $this->conn->query($sql, $param);

		$group = $stmt->fetchAll(PDO::FETCH_OBJ);

		return $group;
	}


	public function studentGroup($idGroup){
		$sql = "SELECT * FROM user 
			INNER JOIN student_group on user.user_id = student_group.fk_user_student
			WHERE student_group.student_group_id = :ID";

		$param = array(':ID' => $idGroup);

		$stmt = $this->conn->query($sql, $param);

		$student = $stmt->fetchAll(PDO::FETCH_OBJ);

		return $student[0];
	}

}