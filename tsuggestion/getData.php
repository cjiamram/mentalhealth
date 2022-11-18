<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tsuggestion.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tsuggestion($db);
$projectId=isset($_GET["projectId"])?$_GET["projectId"]:0;
$keyIndex=isset($_GET["keyIndex"])?$_GET["keyIndex"]:"ALL";

$stmt = $obj->getData($projectId,$keyIndex);
$num = $stmt->rowCount();
if($num>0){
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$objItem=array(
					"projectId"=>$projectId,
					"suggestion"=>$suggestion,
					"keyIndex"=>$keyIndex,
			);
		echo json_encode($objItem);

}
else{
			echo json_encode(array("message" => false));
}
?>