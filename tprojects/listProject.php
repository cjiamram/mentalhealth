<?php
	header("content-type:application/json;charset=UTF8");
	include_once "../config/database.php";
	include_once "../objects/tprojects.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tprojects($db);
	$stmt=$obj->listProject();

	if($stmt->rowCount()>0){
		$objArr=array();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$objItem=array(
				"id"=>$id,
				"ProjectCode"=>$id,
				"ProjectName"=>$ProjectName
				);
			array_push($objArr,$objItem);
		}
		echo json_encode($objArr);
	}else
	echo json_decode(array("message"=>false));
?>