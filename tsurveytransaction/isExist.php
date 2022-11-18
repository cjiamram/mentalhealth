<?php
header("content-type:application/json;charset=UTF-8");
include_once "../config/database.php";
include_once "../objects/tsurveytransaction.php";

$database=new Database();
$db=$database->getConnection();
$studentCode=isset($_GET["studentCode"])?$_GET["studentCode"]:"";
$questId=isset($_GET["questId"])?$_GET["questId"]:0;
$obj=new tsurveytransaction($db);
echo json_encode(array("exist"=>$obj->isExist($questId,$studentCode)));

?>