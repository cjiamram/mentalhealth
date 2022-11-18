<?php
	header("content-type:application/json;charset=UTF-8");

	include_once "../config/database.php";
	include_once "../objects/tsurveytransaction.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tsurveytransaction($db);
	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
	$value=$obj->getDepress2Q($userCode);

	echo json_encode(array("depress"=>$value));

?>