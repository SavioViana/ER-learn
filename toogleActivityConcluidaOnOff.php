<?php 

require "class/activity.php";
require_once "class/diagram.php";

$activity_id = isset($_GET['activity_id']) ? $_GET['activity_id'] : 0;


$activityObj = new Activity();

$activity = $activityObj->selectActivity($activity_id);


if($activity->activity_status == 0){

	$activityObj->upadeStatusActivity($activity_id, 1);

	echo "A atividade marcada como Concluida!";
}else{

	$activityObj->upadeStatusActivity($activity_id, 0);

	echo "A atividade marcada como aberta!";
}

?>