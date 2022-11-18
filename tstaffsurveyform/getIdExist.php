<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../objects/tstaffsurveyform.php";
	include_once "../config/database.php";
	$database=new Database();
	$db=$database->getConnection();
	$obj=new tstaffsurveyform($db);

	$userCode=isset($_GET["userCode"]) ? $_GET["userCode"] : "";

	$objArr=$obj->getIdExist($userCode);

	echo json_encode($objArr);

?>