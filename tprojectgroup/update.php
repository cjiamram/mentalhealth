<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tprojectgroup.php";
include_once "../objects/manage.php";
$UserName=isset($_SESSION["UserName"])?$_SESSION["UserName"]:"Admin";

$database = new Database();
$db = $database->getConnection();
$obj = new tprojectgroup($db);
$data = json_decode(file_get_contents("php://input"));
$obj->ProjectGroup = $data->ProjectGroup;
$currDate=Format::getSystemDate(date("Y/m/d"));
$obj->CreateDate = $currDate;
$obj->Owner = $UserName;
$obj->Objective = $data->Objective;
$obj->id = $data->id;
if($obj->update()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>