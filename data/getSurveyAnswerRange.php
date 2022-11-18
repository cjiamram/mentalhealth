<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/data.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new Data($db);
	$sDate=isset($_GET["sDate"])?$_GET["sDate"]:date("Y-m-d");
	$fDate=isset($_GET["fDate"])?$_GET["fDate"]:date("Y-m-d");
    $userType=isset($_GET["userType"])?$_GET["userType"]:"";
	$stmt=$obj->getSurveyAnswerRange($sDate,$fDate,$userType);
	if($stmt->rowCount()>0){
		$objArr=array();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			
			$objItem=array(
				"isFollow"=>boolval($obj->getFollow($userCode)),
				"departmentName"=>$departmentName,
				"stressGrade"=>$stressGrade,
				"stressDef"=>$obj->getColorDescription($stressGrade,$stressRate,15),
				"stressRate"=>$stressRate,
				"suicideGrade"=>$suicideGrade,
				"suicideDef"=>$obj->getColorDescription($suicideGrade,$suicideRate,52),
				"suicideRate"=>$suicideRate,
				"depressGrade"=>$depressGrade,
				"depressDef"=>$obj->getColorDescription($depressGrade,$depressRate,27),
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