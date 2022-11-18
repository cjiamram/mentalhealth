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
$ProjectCode=isset($_GET["ProjectCode"]) ? $_GET["ProjectCode"] : 0;
$stmt = $obj->getData($ProjectCode);
$num = $stmt->rowCount();
if($num>0){
		$objArr=array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$objItem=array(
					"id"=>$id,
					"QuestionNo"=>$QuestionNo,
					"HeaderCaption"=>$HeaderCaption,
					"ProjectCode"=>$ProjectCode,
					"Description"=>$Description,
					"Qtype"=>$Qtype,
					"QtypeCode"=>$QtypeCode,
					"uniform"=>$uniform
				);
				array_push($objArr, $objItem);
			}
			echo json_encode($objArr);
}
else{
			echo json_encode(array("message" => false));
}
?>