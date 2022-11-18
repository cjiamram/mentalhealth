<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tsuggestion.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tsuggestion($db);
	$projectId=isset($_GET["projectId"])?$_GET["projectId"]:0;
	$keyIndex=isset($_GET["keyIndex"])?$_GET["keyIndex"]:"ALL";
	$msg=$obj->getData($projectId,$keyIndex);

	echo $msg;
?>