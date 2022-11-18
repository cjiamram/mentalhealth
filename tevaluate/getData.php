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
$keyWord=isset($_GET["keyWord"]) ? $_GET["keyWord"] : "";
$stmt = $obj->getData($keyWord);
$num = $stmt->rowCount();
if($num>0){
		$objArr=array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$objItem=array(
					"id"=>$id,
					"userCode"=>$userCode,
					"burnouteRate"=>$burnouteRate,
					"burnouteGrade"=>$burnouteGrade,
					"strengthRate"=>$strengthRate,
					"strengthGrade"=>$strengthGrade,
					"stressRate"=>$stressRate,
					"stressGrade"=>$stressGrade,
					"suicideRate"=>$suicideRate,
					"suicideGrade"=>$suicideGrade,
					"defenseStressRate"=>$defenseStressRate,
					"defenseStressGrade"=>$defenseStressGrade,
				);
				array_push($objArr, $objItem);
			}
			echo json_encode($objArr);
}
else{
			echo json_encode(array("message" => false));
}
?>