<?php
header("content-type:application/json;charset=UTF-8");
include_once "../config/database.php";
include_once "../objects/tsurveyform.php";

$database=new Database();
$db=$database->getConnection();
$obj=new tsurveyform($db);
$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
$flag=$obj->getIdExist($userCode);

echo json_encode(array("flag"=>$flag));
?>