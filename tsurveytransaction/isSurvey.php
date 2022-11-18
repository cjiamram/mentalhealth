<?php
header("content-type:application/json;charset=UTF-8");
include_once "../config/database.php";
include_once "../objects/tsurveytransaction.php";

$database=new Database();
$db=$database->getConnection();
$studentCode=isset($_GET["studentCode"])?$_GET["studentCode"]:"";
$projectId=isset($_GET["projectId"])?$_GET["projectId"]:0;
$obj=new tsurveytransaction($db);
echo json_encode(array("exist"=>$obj->isSurvey($projectId,$studentCode)));
?>