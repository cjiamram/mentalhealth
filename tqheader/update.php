<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tqheader.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tqheader($db);
$data = json_decode(file_get_contents("php://input"));
$obj->QuestionNo = $data->QuestionNo;
$obj->HeaderCaption = $data->HeaderCaption;
$obj->ProjectCode = $data->ProjectCode;
$obj->Description = $data->Description;
$obj->Qtype = $data->Qtype;
$obj->ChoiceNo=$data->ChoiceNo;
$obj->uniform=$data->uniform;
$obj->id = $data->id;
if($obj->update()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>