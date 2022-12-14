<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->UserName = isset($data->userName) ?$data->userName: "";
$user->Password = isset($data->password) ? $data->password : "";
//print_r($user->Password);

$stmt=$user->getUserName();
if($stmt->rowCount()>0){
	 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	 	extract($row);
	 	$_SESSION["UserName"]=$UserName;
        $_SESSION["FullName"]=$FullName;
        $_SESSION["UserCode"]=$UserCode;
        $_SESSION["Picture"]=$Picture;
	 }
	 $status=array("flag"=>true); 
	 echo json_encode($status); 
}
else
{
	 $status=array("flag"=>false); 
	 echo json_encode($status); 
}


?>