<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tstaffsurveyform.php";
	include_once "../objects/tsurveytransaction.php";
	include_once "../objects/tevaluate.php";

	$database=new Database();
	$db=$database->getConnection();
	$objS=new tstaffsurveyform($db);
	$objT=new tsurveytransaction($db);
	$objE=new tevaluate($db);

	function getBurnoutGrade($totalBurnOut){
				$burnouteGrade="";
				if($totalBurnOut>=0&&$totalBurnOut<=53){
					$burnouteGrade="01";
				} else
				if($totalBurnOut>53&&$totalBurnOut<=78){
					$burnouteGrade="02";
				}else
				if($totalBurnOut>78){
					$burnouteGrade="03";
				}

				return $burnouteGrade;
	}

	function getMindStrengthGrade($mindStrengthRate){
			$mindStrengthGrade="";
			if($mindStrengthRate>0&&$mindStrengthRate<=16)
				$mindStrengthGrade="01";
			else
			if($mindStrengthRate>0&&$mindStrengthRate<=16)
				$mindStrengthGrade="02";
			else
			if($mindStrengthRate>16)
				$mindStrengthGrade="03";
		return $mindStrengthGrade;
	}

	function getStressGrade($stressRate){
			$mindStressGrade="";
			if($stressRate>=0&&$stressRate<=4){
				$mindStressGrade="01";
			}else
			if($stressRate>4&&$stressRate<=7){
				$mindStressGrade="02";
			}else
			if($stressRate>7&&$stressRate<=9){
				$mindStressGrade="02-1";
			}else
			if($stressRate>9){
				$mindStressGrade="03";
			}
			return $mindStressGrade;
	}

	function getSuicideGrade($suicideRate){
			$suicideGrade="";
			if($suicideRate==0){
				 $suicideGrade="01-1";
			}else
			if($suicideRate>1&&$suicideRate<=7){
				 $suicideGrade="01-2";
			}else
			if($suicideRate>7&&$suicideRate<=12){
				 $suicideGrade="01-3";
			}else
			if($suicideRate>12){
				 $suicideGrade="01-4";
			}
			return $suicideGrade;
	}

	function getDepressGrade($depressRate){
			$depressGrade="";
			if($depressRate>=0&&$depressRate<=12){
				 $depressGrade="01";
			}else
			if($depressRate>12&&$depressRate<=18){
				 $depressGrade="02";
			}else
			if($depressRate>18&&$depressRate<=19){
				 $depressGrade="02-1";
			}
			else
			if($depressRate>19){
				 $depressGrade="03";
			}
		return $depressGrade;
	}


	function getDefenceStressGrade($defenceStressRate){
			$defenceStressGrade="";
			if($defenceStressRate>=0&&$defenceStressRate<=1.75){
				 $defenceStressGrade="01";
			}else
			if($defenceStressRate>1.75&&$defenceStressRate<=2.50){
				 $defenceStressGrade="02";
			}else
			if($defenceStressRate>2.50&&$defenceStressRate<=3.25){
				 $defenceStressGrade="02-1";
			}
			else
			if($defenceStressRate>3.25){
				 $defenceStressGrade="03";
			}
	}

	$stmt=$objS->getAllUser();
	$result=array();
	if($stmt->rowCount()>0){
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$emotionalLackValue=$objT->getEmotionalLack($userCode);
			$personalLackValue=$objT->getPersonalLack($userCode);
			$successValue=$objT->getSuccess($userCode);
			$totalBurnOut=$emotionalLackValue+$personalLackValue+$successValue;
			$mindStrengthValue=$objT->getMindStrength($userCode);
			$mindStressValue=$objT->getMindStress($userCode);
			$depress2QValue=$objT->getDepress2Q($userCode);
			$depress9QValue=$objT->getDepress9Q($userCode);
			$depress9Q_1Value=$objT->getDepress9Q_1($userCode);
			$suicideValue=$objT->getSuicide8Q($userCode);

			if($objE->isExist($userCode)===false){
				$objE->userCode = $userCode;
				$objE->burnouteRate = $totalBurnOut;
				$objE->burnouteGrade = getBurnoutGrade($totalBurnOut);
				$objE->strengthRate = $mindStrengthValue;
				$objE->strengthGrade = getMindStrengthGrade($mindStrengthValue);
				$objE->stressRate = $mindStressValue;
				$objE->stressGrade = getStressGrade($mindStressValue);
				$objE->suicideRate = $suicideValue;
				$objE->suicideGrade = getSuicideGrade($suicideValue);
				$objE->defenseStressRate = 0;
				$objE->defenseStressGrade = "";
				$objE->depressRate = $depress9QValue;
				$objE->depressGrade = getDepressGrade($depress9QValue);
				
				$flag=$objE->create();

				array_push($result, array("userCode"=>$userCode,"status"=>"Create","flag"=>$flag));
				
			}
			else{
				$id=$objE->getId($userCode);
				$objE->userCode = $userCode;
				$objE->burnouteRate = $totalBurnOut;
				$objE->burnouteGrade = getBurnoutGrade($totalBurnOut);
				$objE->strengthRate = $mindStrengthValue;
				$objE->strengthGrade = getMindStrengthGrade($mindStrengthValue);
				$objE->stressRate = $mindStressValue;
				$objE->stressGrade = getStressGrade($mindStressValue);
				$objE->suicideRate = $suicideValue;
				$objE->suicideGrade = getSuicideGrade($suicideValue);
				$objE->defenseStressRate = 0;
				$objE->defenseStressGrade = "";
				$objE->depressRate = $depress9QValue;
				$objE->depressGrade = getDepressGrade($depress9QValue);
				$objE->id=$id;
				$flag=$objE->update();
				array_push($result, array("userCode"=>$userCode,"status"=>"Update","flag"=>$flag));

				
			}


		}
		echo json_encode($result);
		
	}
?>