<?php
header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/classReport.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new ClassReport($db);

	$departmentCode=isset($_GET["departmentCode"])?$_GET["departmentCode"]:"";
	$stmt=$obj->getStaffSuicide($departmentCode);
	$objArr=array();
	if($stmt->rowCount()>0){
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$objItem=array("suicide"=>$suicide,"code"=>$code,"color"=>$color,"cnt"=>intval($CNT));
			array_push($objArr,$objItem);

		}
		echo json_encode($objArr);
	}else
	echo json_encode(array("message"=>false));
?>