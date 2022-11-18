<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tevaluate.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tevaluate($db);
$data = json_decode(file_get_contents("php://input"));
$obj->userCode = $data->userCode;
$obj->burnouteRate = $data->burnouteRate;
$obj->burnouteGrade = $data->burnouteGrade;
$obj->strengthRate = $data->strengthRate;
$obj->strengthGrade = $data->strengthGrade;
$obj->stressRate = $data->stressRate;
$obj->stressGrade = $data->stressGrade;
$obj->suicideRate = $data->suicideRate;
$obj->suicideGrade = $data->suicideGrade;
$obj->defenseStressRate = $data->defenseStressRate;
$obj->defenseStressGrade = $data->defenseStressGrade;
$obj->depressGrade = $data->depressGrade;
$obj->depressRate = $data->depressRate;

if($obj->update()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>