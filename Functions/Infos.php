<?php

function GetUser($email, $password) {
	$dbInfo = require "Config/config.php";

	try{
		$con = new PDO("mysql:host=".$dbInfo['db']['host']."; dbname=".$dbInfo['db']['name'].";", $dbInfo['db']['username'], $dbInfo['db']['password']);
		$res = $con->prepare("SELECT * FROM users WHERE email='".$email."';");
		$res->execute();
		if($Value=$res->fetch(PDO::FETCH_ASSOC)){
			if($password == $Value['password'])
				return $Value;
		}

		return null;
	}catch(PDOException $e){
		echo $e;
	}finally {
		$con=null;
	}
}


function GetTasks($user_id, $state){
	$dbInfo = require "../Config/config.php";

	try{
		$con = new PDO("mysql:host=".$dbInfo['db']['host']."; dbname=".$dbInfo['db']['name'].";", $dbInfo['db']['username'], $dbInfo['db']['password']);
		$res = $con->prepare("SELECT * FROM tasks WHERE user_id='".$user_id."' AND state='".$state."';");
		$res->execute();
		if($Value=$res->fetchAll(PDO::FETCH_ASSOC)){
			return $Value;
		}
		return null;
	}catch(PDOException $e){
		return null;
	}finally {
		$con=null;
	}
}



function UpdateTask($id) {
	$dbInfo = require "../Config/config.php";

	try{
		$con = new PDO("mysql:host=".$dbInfo['db']['host']."; dbname=".$dbInfo['db']['name'].";", $dbInfo['db']['username'], $dbInfo['db']['password']);
		$count = $con->exec("UPDATE TASKS set state='On' WHERE id=".$id.";");
		if($count > 0){
			return true;
		}
		return false;
	}catch(PDOException $e){
		return false;
	}finally {
		$con=null;
	}
}


function InsertTask($id, $title) {
	$dbInfo = require "../Config/config.php";

	try{
		$con = new PDO("mysql:host=".$dbInfo['db']['host']."; dbname=".$dbInfo['db']['name'].";", $dbInfo['db']['username'], $dbInfo['db']['password']);
		$count = $con->exec("INSERT INTO tasks(title, state, user_id) VALUES ('".$title."', 'Off', ".$id.");");
		if($count > 0){
			return true;
		}
		return false;
	}catch(PDOException $e){
		return false;
	}finally {
		$con=null;
	}
}


function DeleteTasks($id) {
	$dbInfo = require "../Config/config.php";

	try{
		$con = new PDO("mysql:host=".$dbInfo['db']['host']."; dbname=".$dbInfo['db']['name'].";", $dbInfo['db']['username'], $dbInfo['db']['password']);
		$count = $con->exec("DELETE FROM TASKS WHERE id=".$id.";");
		if($count > 0){
			return true;
		}
		return false;
	}catch(PDOException $e){
		return false;
	}finally {
		$con=null;
	}
}