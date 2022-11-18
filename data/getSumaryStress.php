<?php
header("content-type:application/json;charset=UTF-8");
include_once "../config/database.php";
include_once "../objects/data.php";

$database=new Database();
$db=$database->getConnection();
$obj=new Data($db);

$yearNo=isset($_GET["yearNo"])?$_GET["yearNo"]:"";
$department=isset($_GET["department"])?$_GET["department"]:"";



$stmt=$obj->getSumaryStress($yearNo,$department);
if($stmt->rowCount()>0){
	$objArr=array();
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		
		$objItem=array("departmentName"=>$departmentName,
			"gender"=>$gender,
			"level"=>$stressLevel,
			"CNT"=>$CNT
			);

		array_push($objArr, $objItem);

	}

	echo json_encode($objArr);
}else
	echo json_decode(array("message"=>false));


?>