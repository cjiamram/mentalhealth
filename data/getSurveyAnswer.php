<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/data.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new Data($db);
	$surveyDate=isset($_GET["surveyDate"])?$_GET["surveyDate"]:date("Y-m-d");
    $userType=isset($_GET["userType"])?$_GET["userType"]:"";
	$stmt=$obj->getSurveyAnswer($surveyDate,$userType);
	if($stmt->rowCount()>0){
		$objArr=array();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			
			$objItem=array(
				"isFollow"=>boolval($obj->getFollow($userCode)),
				"departmentName"=>$departmentName,
				"burnouteGrade"=>$burnouteGrade,
				"burnoutDef"=>$obj->getColorDescription($burnouteGrade,$burnouteRate,132),
				"burnouteRate"=>$burnouteRate,
				"strengthGrade"=>$strengthGrade,
				"strengthDef"=>$obj->getColorDescription($strengthGrade,$strengthGrade,30),
				"strengthRate"=>$strengthRate,
				"stressGrade"=>$stressGrade,
				"stressDef"=>$obj->getColorDescription($stressGrade,$stressRate,15),
				"stressRate"=>$stressRate,
				"suicideGrade"=>$suicideGrade,
				"suicideDef"=>$obj->getColorDescription($suicideGrade,$suicideRate,52),
				"suicideRate"=>$suicideRate,
				"depressGrade"=>$depressGrade,
				"depressDef"=>$obj->getColorDescription($depressGrade,$depressRate,27),
				"defenseStressGrade"=>$defenseStressGrade,
				"defenseStressDef"=>$obj->getColorDescription($defenseStressGrade,$defenseStressRate,4.00),
				"defenseStressRate"=>$defenseStressRate,
				"gender"=>$gender,
				"fullName"=>$fullName,
				"userCode"=>$userCode

				);

			array_push($objArr, $objItem);
		}

		echo json_encode($objArr);

	}
	else
		echo json_encode(array("message"=>false));

?>