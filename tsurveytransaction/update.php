<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tsurveytransaction.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tsurveytransaction($db);
$data = json_decode(file_get_contents("php://input"));
$obj->ProjectCode = $data->ProjectCode;
$obj->CreateDate = Format::getSystemDate(date("Y/m/d"));
$obj->Score = $data->Score;
$obj->QuestId = $data->QuestId;
$obj->StudentCode = $data->StudentCode;
$obj->id = $data->id;
if($obj->update()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>