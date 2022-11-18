<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/data.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new Data($db);
	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";


	$stmt=$obj->getAnswerBurnout($userCode,10);
	if($stmt->rowCount()>0){
		$objArr=array();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
		
			//4, 7, 9, 12, 17, 18,19, 21
			if($QNo==4||$QNo==7||$QNo==9||$QNo==12||$QNo==18||$QNo==19||$QNo==21){
				$objItem=array("StudentCode"=>$StudentCode,
				"QNo"=>$QNo,
				"Caption"=>$Question,
				"ProjectCode"=>$ProjectCode,
				"Answer"=>$Answer,
				"Score"=>6-$Score,
				"weightIndex"=>intval($weightIndex),

				);
			}else{
				$objItem=array("StudentCode"=>$StudentCode,
				"QNo"=>$QNo,
				"Caption"=>$Question,
				"ProjectCode"=>$ProjectCode,
				"Answer"=>$Answer,
				"Score"=>$Score,
				"weightIndex"=>intval($weightIndex),
				);
			}
			
			array_push($objArr,$objItem);
		}
		echo json_encode($objArr);
	}
	else
		echo json_encode(array("message"=>false));


?>