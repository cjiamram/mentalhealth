<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tfillowlog.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tfillowlog($db);
$data = json_decode(file_get_contents("php://input"));
$obj->userCode = $data->userCode;
$obj->isFollow = 1;
$obj->isContact = $data->isContact;
$obj->isAppoint = $data->isAppoint;
$obj->helpDescription = $data->helpDescription;
$obj->helpEffective = $data->helpEffective;
$obj->createDate = date("Y-m-d");
if($obj->create()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>