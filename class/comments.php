<?php

if(!class_exists('Db')){
	require "config/db.class.php";
}

class Comments extends Db{

	function __construct()
	{
		parent::__construct();

		$this->conn = new Db();
	}


	public function addComments($title = null, $description, $fkActivity, $fkUser, $fkComments = null) {

		$sql = "INSERT INTO comments (comments.comments_title, comments.comments_description, comments.fk_activity, comments.fk_user, comments.fk_comments) VALUES (:TITLE, :DESCRIPTION, :FKACTIVITY, :FKUSER, :FKCOMMENTS)";



		$param = array(':TITLE' => $title,
					':DESCRIPTION' => $description, 
					':FKACTIVITY' => $fkActivity,
					':FKUSER' => $fkUser, 
					':FKCOMMENTS' => $fkComments);

		$stmt = $this->conn->query($sql, $param);

		return $stmt;
	}



	
	public function getComments($fkActivity,  $fkComments = 0) {

		if ($fkComments == 0) {

			$sql = "SELECT * FROM comments WHERE comments.fk_comments IS NULL and comments.fk_activity = :FKACTIVITY";

			$param = array(':FKACTIVITY' => $fkActivity);

		}else{

			$sql = "SELECT * FROM comments WHERE comments.fk_comments = :FKCOMMENTS and comments.fk_activity = :FKACTIVITY";
			$param = array(':FKCOMMENTS' => $fkComments,
					':FKACTIVITY' => $fkActivity);

		}

		


		$stmt = $this->conn->query($sql, $param);

		$comments = $stmt->fetchAll(PDO::FETCH_OBJ);
		

		return $comments;
	}


	public function getComment($idComment) {
		$sql = "SELECT * FROM comments WHERE comments.comments_id = :ID";

		$param = array(':ID' => $idComment);


		$stmt = $this->conn->query($sql, $param);

		$comments = $stmt->fetchAll(PDO::FETCH_OBJ);
		

		return $comments[0];
	}



}


?>