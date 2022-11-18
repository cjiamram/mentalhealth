<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/data.php";
	include_once "../objects/tleveldefinition.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new Data($db);
	$objL=new tleveldefinition($db);
	$YY=isset($_GET["YY"])?$_GET["YY"]:"";

	$stmt=$obj->getSumaryIssue($YY);
	$data=array();
	if($stmt->rowCount()>0){
		
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			
			$objItem=array(
					"userCode"=>$userCode,
					"fullName"=>$fullName,
					"gender"=>$gender,
					"departmentName"=>$departmentName,
					"stressGrade"=> $objL->getDescription($stressGrade),
					"stressRate"=>$stressRate,
					"suicideGrade"=>$objL->getDescription($suicideGrade),
					"suicideRate"=>$suicideRate,
					"depressGrade"=>$objL->getDescription($depressGrade),
					"depressRate"=>$depressRate
				);

			array_push($data, $objItem);
		}


	}


?>