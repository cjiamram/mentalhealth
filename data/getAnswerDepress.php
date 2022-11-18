<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/data.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new Data($db);
	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";


	$stmt=$obj->getAnswerNormal($userCode,21);
	if($stmt->rowCount()>0){
		$objArr=array();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
		
			
				$objItem=array("StudentCode"=>$StudentCode,
				"QNo"=>$QNo,
				"Caption"=>$Question,
				"ProjectCode"=>$ProjectCode,
				"Answer"=>$Answer,
				"Score"=>$Score
				);
			
			
			array_push($objArr,$objItem);
		}
		echo json_encode($objArr);
	}
	else
		echo json_encode(array("message"=>false));


?>