<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../objects/tsurveytransaction.php";
	include_once "../config/database.php";


	$database=new Database();
	$db=$database->getConnection();
	$obj=new tsurveytransaction($db);
	$flag=$obj->deleteSuicide("chatchai.j");

	echo json_encode(array("message"=>$flag));

?>