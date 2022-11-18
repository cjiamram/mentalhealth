<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tevaluate.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tevaluate($db);
	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
	$flag=$obj->isExist($userCode);
	echo json_encode(array("flag"=>$flag));

?>