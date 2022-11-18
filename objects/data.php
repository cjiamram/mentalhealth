<?php
class Data{
		private $conn;
		public function __construct($db){
			$this->conn = $db;
		}

		public function getColorDescription($code,$value,$max){
			$query="SELECT color,description 
			FROM t_leveldefinition WHERE code=:code ";
			$stmt=$this->conn->prepare($query);
			$stmt->bindParam(":code",$code);
			$stmt->execute();
			
			if($stmt->rowCount()>0){
				$row=$stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				$percentage=($value/$max)*100;
				$objItem=array(
					"color"=>$color,
					"description"=>$description,
					"value"=>doubleval($value),
					"percentage"=>$percentage,
					"flag"=>true
				 );
				return $objItem;

			}else
			return array(
				"color"=>"#FFFFFF",
				"description"=>"ไม่ได้วัดผล",
				"value"=>0,
				"percentage"=>0,
				"flag"=>false);
		}

		public function getSumaryBurnout($year,$department){
			$query="SELECT 
				V.burnouteRate,
				V.departmentName,
				CASE 
					WHEN V.gender=1 THEN 'Male'
					ELSE 'Female'
				END AS gender, 
				L.description AS burnoutLevel,
				SUM(V.CNT) AS CNT

			 FROM (
			 
			 SELECT 
				A.`burnouteGrade`,
				A.`burnouteRate`,
				C.`departmentName`,
				B.gender,
				YEAR(A.`createDate`) AS YY,
				1 AS CNT 
			FROM  t_evaluate A INNER JOIN `t_staffsurveyform` B 
			ON A.`userCode`=B.`userCode` INNER JOIN t_department C ON 
			B.department=C.`departmentCode`
			WHERE C.departmentCode LIKE :department
			UNION
			SELECT 
				A.`burnouteGrade`,
				A.`burnouteRate`,
				C.departmentName,
				B.gender,
			YEAR(A.`createDate`) AS YY,
			1 AS CNT   
			FROM  t_evaluate A 
			INNER JOIN `t_surveyform` B 
			ON A.`userCode`=B.`userCode` 
			INNER JOIN t_department C ON 
			B.faculty=C.`departmentCode`
			WHERE C.departmentCode LIKE :department

			
			) AS V 
			INNER JOIN t_leveldefinition L ON V.`burnouteGrade`=L.code
			WHERE V.YY LIKE :YY
			GROUP BY 
			V.burnouteRate,
			V.departmentName,
			V.gender,
			L.description 

			";

			$stmt=$this->conn->prepare($query);
			$YY="%{$year}%";
			$stmt->bindParam(":YY",$YY);
			$department="%{$department}%";
			$stmt->bindParam(":department",$department);
			$stmt->execute();
			return $stmt;
		}


		public function getSumaryStress($year,$department){
			$query="SELECT 
				V.stressGrade,
				V.departmentName,
				CASE 
					WHEN V.gender=1 THEN 'Male'
					ELSE 'Female'
				END AS gender, 
				L.description AS stressLevel,
				SUM(V.CNT) AS CNT

			 FROM (
			 
			 SELECT 
				A.stressGrade,
				A.stressRate,
				C.`departmentName`,
				B.gender,
				YEAR(A.`createDate`) AS YY,
				1 AS CNT 
			FROM  t_evaluate A INNER JOIN `t_staffsurveyform` B 
			ON A.`userCode`=B.`userCode` INNER JOIN t_department C ON 
			B.department=C.`departmentCode`
			WHERE C.departmentCode LIKE :department

			UNION
			SELECT 
				A.stressGrade,
				A.stressRate,
				C.departmentName,
				B.gender,
				YEAR(A.`createDate`) AS YY,
				1 AS CNT  
			FROM  t_evaluate A 
			INNER JOIN `t_surveyform` B 
			ON A.`userCode`=B.`userCode` 
			INNER JOIN t_department C ON 
			B.faculty=C.`departmentCode`
			WHERE C.departmentCode LIKE :department

			
			) AS V 
			INNER JOIN t_leveldefinition L ON V.`stressGrade`=L.code
			WHERE V.YY LIKE :YY
			GROUP BY 
			V.stressGrade,
			V.departmentName,
			V.gender,
			L.description
			";

			$stmt=$this->conn->prepare($query);
			$YY="%{$year}%";
			$stmt->bindParam(":YY",$YY);
			$department="%{$department}%";
			$stmt->bindParam(":department",$department);
			$stmt->execute();
			return $stmt;
		}

		public function getSumaryDepress($year,$department){
			$query="SELECT 
				V.depressGrade,
				V.departmentName,
				CASE 
					WHEN V.gender=1 THEN 'Male'
					ELSE 'Female'
				END AS gender, 
				L.description AS depressLevel,
				SUM(V.CNT) AS CNT

			 FROM (
			 
			 SELECT 
				A.`depressGrade`,
				A.`depressRate`,
				C.`departmentName`,
				B.gender,
				YEAR(A.`createDate`) AS YY,
				1 AS CNT 
			FROM  t_evaluate A INNER JOIN `t_staffsurveyform` B 
			ON A.`userCode`=B.`userCode` INNER JOIN t_department C ON 
			B.department=C.`departmentCode`
			WHERE C.departmentCode LIKE :department
			UNION
			SELECT 
				A.`depressGrade`,
				A.`depressRate`,
				C.departmentName,
				B.gender,
				YEAR(A.`createDate`) AS YY,
				1 AS CNT  
			FROM  t_evaluate A 
			INNER JOIN `t_surveyform` B 
			ON A.`userCode`=B.`userCode` 
			INNER JOIN t_department C ON 
			B.faculty=C.`departmentCode`
			WHERE C.departmentCode LIKE :department
			
			) AS V 
			INNER JOIN t_leveldefinition L ON V.`depressGrade`=L.code
			WHERE V.YY LIKE :YY
			GROUP BY 
			V.depressGrade,
			V.departmentName,
			V.gender,
			L.description
			";

			$stmt=$this->conn->prepare($query);
			$YY="%{$year}%";
			$stmt->bindParam(":YY",$YY);
			$department="%{$department}%";
			$stmt->bindParam(":department",$department);

			$stmt->execute();
			return $stmt;
		}

		public function getSumarySuicide($year,$department){
			$query="SELECT 
				V.suicideGrade,
				V.departmentName,
				CASE 
					WHEN V.gender=1 THEN 'Male'
					ELSE 'Female'
				END AS gender, 
				L.description AS suicideLevel,
				SUM(V.CNT) AS CNT

			 FROM (
			 
			 SELECT 
				A.suicideRate,
				A.suicideGrade,
				C.`departmentName`,
				B.gender,
				YEAR(A.`createDate`) AS YY,
				1 AS CNT 
			FROM  t_evaluate A INNER JOIN `t_staffsurveyform` B 
			ON A.`userCode`=B.`userCode` INNER JOIN t_department C ON 
			B.department=C.`departmentCode` 
			WHERE C.departmentCode LIKE :department
			UNION
			SELECT 
				A.suicideRate,
				A.suicideGrade,
				C.departmentName,
				B.gender,
				YEAR(A.`createDate`) AS YY,
				1 AS CNT  
			FROM  t_evaluate A 
			INNER JOIN `t_surveyform` B 
			ON A.`userCode`=B.`userCode` 
			INNER JOIN t_department C ON 
			B.faculty=C.`departmentCode`
			 WHERE C.departmentCode LIKE :department
			
			) AS V 
			INNER JOIN t_leveldefinition L ON V.`suicideGrade`=L.code
			WHERE V.YY LIKE :YY
			GROUP BY 
			V.suicideGrade,
			V.departmentName,
			V.gender,
			L.description
			";

			$stmt=$this->conn->prepare($query);
			$YY="%{$year}%";
			$stmt->bindParam(":YY",$YY);
			$department="%{$department}%";
			$stmt->bindParam(":department",$department);
			$stmt->execute();
			return $stmt;
		}

		public function getFollow($userCode){
			$query="SELECT id FROM t_fillowlog WHERE userCode=:userCode ";
			$stmt=$this->conn->prepare($query);
			$stmt->bindParam(":userCode",$userCode);
			$stmt->execute();
			$follow=$stmt->rowCount()>0?true:false;
			return $follow; 
		}


		public function getSurveyAnswerRange($sDate,$fDate,$userType){

				$query="SELECT
									
									uCode AS userCode,		
									burnouteGrade,
									burnouteRate,
									strengthGrade,
									strengthRate,
									strengthRate,
									stressGrade,
									stressRate,
									suicideRate,
									suicideGrade,
									depressGrade,
									depressRate,
									defenseStressGrade,
									defenseStressRate,
									departmentName,
									gender,
									F.fullName,
									userType

			 	FROM 
			 	(

						SELECT
									 
									A.`burnouteGrade`,
									A.`burnouteRate`,
									A.`strengthGrade`,
									A.`strengthRate`,
									A.`stressGrade`,
									A.`stressRate`,
									A.`suicideGrade`,
									A.`suicideRate`,
									A.`depressGrade`,
									A.`depressRate`,
									A.`defenseStressGrade`,
									A.`defenseStressRate`,
									B.department,
									C.`departmentName`,
									B.gender,
									A.userCode AS uCode,
									A.createDate,
									2 AS userType 
						FROM  t_evaluate A INNER JOIN `t_staffsurveyform` B 
						ON A.`userCode`=B.`userCode` INNER JOIN t_department C ON 
						B.department=C.`departmentCode` 
						WHERE 
						DATE_FORMAT(A.createDate,'%Y-%m-%d')>=:sDate 
						AND
						DATE_FORMAT(A.createDate,'%Y-%m-%d')<=:fDate

			        UNION

						SELECT
									
									A.`burnouteGrade`,
									A.`burnouteRate`,
									A.`strengthGrade`,
									A.`strengthRate`,
									A.`stressGrade`,
									A.`stressRate`,
									A.`suicideGrade`,
									A.`suicideRate`,
									A.`depressGrade`,
									A.`depressRate`,
									A.`defenseStressGrade`,
									A.`defenseStressRate`,
									B.faculty AS department,
									C.departmentName,
									B.gender,
									A.userCode AS uCode,
								    A.createDate,
								    1 AS userType   
						FROM  t_evaluate A 
						INNER JOIN `t_surveyform` B 
						ON A.`userCode`=B.`userCode` 
						INNER JOIN t_department C ON 
						B.faculty=C.`departmentCode`
						WHERE 
						DATE_FORMAT(A.createDate,'%Y-%m-%d')>=:sDate 
						AND
						DATE_FORMAT(A.createDate,'%Y-%m-%d')<=:fDate

			) 
			AS V 
			INNER JOIN t_fullname F  ON V.uCode=F.userCode
			WHERE  userType LIKE :userType
			AND V.uCode IN (SELECT userCode FROM t_issend)
			";

			$stmt=$this->conn->prepare($query);
			$userType="{$userType}%";
			$stmt->bindParam(":sDate",$sDate);
			$stmt->bindParam(":fDate",$fDate);
			$stmt->bindParam(":userType",$userType);
			$stmt->execute();

			return $stmt;


		}

		public function getStaffByDepartment($departmentCode){
			$query="SELECT
									
									uCode AS userCode,		
									burnouteGrade,
									burnouteRate,
									strengthGrade,
									strengthRate,
									strengthRate,
									stressGrade,
									stressRate,
									suicideRate,
									suicideGrade,
									depressGrade,
									depressRate,
									defenseStressGrade,
									defenseStressRate,
									departmentName,
									gender,
									F.fullName,
									userType

			 	FROM 
			 	(

						SELECT
									 
									A.`burnouteGrade`,
									A.`burnouteRate`,
									A.`strengthGrade`,
									A.`strengthRate`,
									A.`stressGrade`,
									A.`stressRate`,
									A.`suicideGrade`,
									A.`suicideRate`,
									A.`depressGrade`,
									A.`depressRate`,
									A.`defenseStressGrade`,
									A.`defenseStressRate`,
									B.department,
									C.`departmentName`,
									B.gender,
									A.userCode AS uCode,
									A.createDate,
									2 AS userType 
						FROM  t_evaluate A INNER JOIN `t_staffsurveyform` B 
						ON A.`userCode`=B.`userCode` INNER JOIN t_department C ON 
						B.department=C.`departmentCode` 
						WHERE C.`departmentCode` LIKE :departmentCode
						

			) 
			AS V 
			INNER JOIN t_fullname F  ON V.uCode=F.userCode
			
			";

			$stmt=$this->conn->prepare($query);
			$departmentCode="%{$departmentCode}%";
			$stmt->bindParam(":departmentCode",$departmentCode);
			$stmt->execute();
			return $stmt;
		}

		public function getStudentByFaculty($faculty){

				$query="SELECT
									
									uCode AS userCode,		
									burnouteGrade,
									burnouteRate,
									strengthGrade,
									strengthRate,
									strengthRate,
									stressGrade,
									stressRate,
									suicideRate,
									suicideGrade,
									depressGrade,
									depressRate,
									defenseStressGrade,
									defenseStressRate,
									departmentName,
									gender,
									F.fullName,
									userType

			 	FROM 
			 	(

						SELECT
									
									A.`burnouteGrade`,
									A.`burnouteRate`,
									A.`strengthGrade`,
									A.`strengthRate`,
									A.`stressGrade`,
									A.`stressRate`,
									A.`suicideGrade`,
									A.`suicideRate`,
									A.`depressGrade`,
									A.`depressRate`,
									A.`defenseStressGrade`,
									A.`defenseStressRate`,
									B.faculty AS department,
									C.departmentName,
									B.gender,
									A.userCode AS uCode,
								    A.createDate,
								    1 AS userType   
						FROM  t_evaluate A 
						LEFT OUTER JOIN `t_surveyform` B 
						ON A.`userCode`=B.`userCode` 
						LEFT OUTER JOIN t_department C ON 
						B.faculty=C.`departmentCode`
						WHERE C.`departmentCode` 
						LIKE :faculty

						

			) 
			AS V 
			LEFT OUTER JOIN t_fullname F  ON V.uCode=F.userCode
			
			";

			$stmt=$this->conn->prepare($query);
			$faculty="%{$faculty}%";
			$stmt->bindParam(":faculty",$faculty);
			$stmt->execute();
			return $stmt;
		
		}

		public function getSurveyAnswer($surveyDate,$userType){

				$query="SELECT
									
									uCode AS userCode,		
									burnouteGrade,
									burnouteRate,
									strengthGrade,
									strengthRate,
									strengthRate,
									stressGrade,
									stressRate,
									suicideRate,
									suicideGrade,
									depressGrade,
									depressRate,
									defenseStressGrade,
									defenseStressRate,
									departmentName,
									gender,
									F.fullName,
									userType

			 	FROM 
			 	(

						SELECT
									 
									A.`burnouteGrade`,
									A.`burnouteRate`,
									A.`strengthGrade`,
									A.`strengthRate`,
									A.`stressGrade`,
									A.`stressRate`,
									A.`suicideGrade`,
									A.`suicideRate`,
									A.`depressGrade`,
									A.`depressRate`,
									A.`defenseStressGrade`,
									A.`defenseStressRate`,
									B.department,
									C.`departmentName`,
									B.gender,
									A.userCode AS uCode,
									A.createDate,
									2 AS userType 
						FROM  t_evaluate A INNER JOIN `t_staffsurveyform` B 
						ON A.`userCode`=B.`userCode` INNER JOIN t_department C ON 
						B.department=C.`departmentCode` 
						WHERE DATE_FORMAT(A.createDate,'%Y-%m-%d')=:surveyDate

			        UNION

						SELECT
									
									A.`burnouteGrade`,
									A.`burnouteRate`,
									A.`strengthGrade`,
									A.`strengthRate`,
									A.`stressGrade`,
									A.`stressRate`,
									A.`suicideGrade`,
									A.`suicideRate`,
									A.`depressGrade`,
									A.`depressRate`,
									A.`defenseStressGrade`,
									A.`defenseStressRate`,
									B.faculty AS department,
									C.departmentName,
									B.gender,
									A.userCode AS uCode,
								    A.createDate,
								    1 AS userType   
						FROM  t_evaluate A 
						INNER JOIN `t_surveyform` B 
						ON A.`userCode`=B.`userCode` 
						INNER JOIN t_department C ON 
						B.faculty=C.`departmentCode`
						WHERE DATE_FORMAT(A.createDate,'%Y-%m-%d')=:surveyDate

			) 
			AS V 
			INNER JOIN t_fullname F  ON V.uCode=F.userCode
			WHERE  userType LIKE :userType
			AND V.uCode IN (SELECT userCode FROM t_issend)
			";

			$stmt=$this->conn->prepare($query);
			$userType="{$userType}%";
			//print_r($userType);
			//$surveyDate=date('Y-m-d',$surveyDate);
			//date("d-m-Y", $timestamp);
			$stmt->bindParam(":surveyDate",$surveyDate);
			$stmt->bindParam(":userType",$userType);
			$stmt->execute();

			return $stmt;


		}

		public function getSumaryIssue($year){
			$query="SELECT 
				stressGrade,
				stressRate,
				suicideRate,
				suicideGrade,
				depressGrade,
				depressRate,
				departmentName,
				gender,
				F.fullName,
				F.userCode

			 FROM (
			 	SELECT 
						A.`stressGrade`,
						A.`stressRate`,
						A.`suicideGrade`,
						A.`suicideRate`,
						A.`depressGrade`,
						A.`depressRate`,
						B.department,
						C.`departmentName`,
						B.gender,
						A.userCode,
						YEAR(A.`createDate`) AS YY 
			FROM  t_evaluate A INNER JOIN `t_staffsurveyform` B 
			ON A.`userCode`=B.`userCode` INNER JOIN t_department C ON 
			B.department=C.`departmentCode`
			UNION
			SELECT 
				
						A.`stressGrade`,
						A.`stressRate`,
						A.`suicideGrade`,
						A.`suicideRate`,
						A.`depressGrade`,
						A.`depressRate`,
						B.faculty AS department,
						C.departmentName,
						B.gender,
						A.userCode,
						YEAR(A.`createDate`) AS YY  
			FROM  t_evaluate A 
			INNER JOIN `t_surveyform` B 
			ON A.`userCode`=B.`userCode` 
			INNER JOIN t_department C ON 
			B.faculty=C.`departmentCode`) AS V 
			INNER JOIN t_fullname F  ON V.userCode=F.userCode
			WHERE V.YY LIKE :YY
			";

			$stmt=$this->conn->prepare($query);
			$YY="%{$year}%";
			$stmt->bindParam(":YY",$YY);
			$stmt->execute();
			return $stmt;
		}


		public function sumaryReport($year){
			$query="SELECT 
				burnouteGrade,
				burnouteRate,
				strengthGrade,
				strengthRate,
				strengthRate,
				stressGrade,
				stressRate,
				suicideRate,
				suicideGrade,
				depressGrade,
				depressRate,
				defenseStressGrade,
				defenseStressRate,
				departmentName,
				gender,
				F.fullName

			 FROM (SELECT 
				A.`burnouteGrade`,
				A.`burnouteRate`,
				A.`strengthGrade`,
				A.`strengthRate`,
				A.`stressGrade`,
				A.`stressRate`,
				A.`suicideGrade`,
				A.`suicideRate`,
				A.`depressGrade`,
				A.`depressRate`,
				A.`defenseStressGrade`,
				A.`defenseStressRate`,
				B.department,
				C.`departmentName`,
				B.gender,
				A.userCode,
				YEAR(A.`createDate`) AS YY 
			FROM  t_evaluate A INNER JOIN `t_staffsurveyform` B 
			ON A.`userCode`=B.`userCode` INNER JOIN t_department C ON 
			B.department=C.`departmentCode`

			UNION

			SELECT 
				A.`burnouteGrade`,
				A.`burnouteRate`,
				A.`strengthGrade`,
				A.`strengthRate`,
				A.`stressGrade`,
				A.`stressRate`,
				A.`suicideGrade`,
				A.`suicideRate`,
				A.`depressGrade`,
				A.`depressRate`,
				A.`defenseStressGrade`,
				A.`defenseStressRate`,
				B.faculty AS department,
				C.departmentName,
				B.gender,
				A.userCode,
			YEAR(A.`createDate`) AS YY  
			FROM  t_evaluate A 
			INNER JOIN `t_surveyform` B 
			ON A.`userCode`=B.`userCode` 
			INNER JOIN t_department C ON 
			B.faculty=C.`departmentCode`) AS V 
			INNER JOIN t_fullname F  ON V.userCode=F.userCode
			WHERE V.YY LIKE :YY
			";

			$stmt=$this->conn->prepare($query);
			$YY="%{$year}%";
			$stmt->bindParam(":YY",$YY);
			$stmt->execute();
			return $stmt;


		}


		public function getData($userCode){
					$query="SELECT 
							V.userCode,
							V.telNo,
							V.contactPerson,
							V.urgentTel,
							V.facultyCode,
							V.departmentName,
							C.fullName

					 FROM 
					(
						SELECT 
							userCode,
							telNo,
							contactPerson,
							urgentTel,
							A.department AS facultyCode,
							B.departmentName 
						FROM t_staffsurveyform A 
						INNER JOIN t_department B
						ON A.department=B.departmentId
						WHERE userCode=:userCode
						UNION 
						SELECT 
							userCode,
							telNo,
							contactPerson,
							urgentTel,
							A.faculty AS facultyCode,
							B.departmentName 
						FROM t_surveyform A 
						INNER JOIN t_department B
						ON A.faculty=B.departmentId
						WHERE userCode=:userCode
					) AS V LEFT OUTER JOIN t_fullname C
					ON V.userCode=C.userCode
					";
					
					$stmt=$this->conn->prepare($query);
					$stmt->bindParam(":userCode",$userCode);
					$stmt->execute();
					return $stmt;

		}

		public function getAnswerList($userCode,$projectId,$list){
			$strL="";
			$l=count($list);
			$i=0;
			foreach ($list as $p) {
				if($i==$l-1){
					$strL.="'".$p ."'";
				}else{
					$strL.="'".$p ."',";
				}
			}


			$query="SELECT 
				A.`StudentCode`,
				B.`QuestionNo` AS QNo,
				B.`HeaderCaption` AS Question,
				B.`ProjectCode`,
				D.`label` AS Answer,
				A.`Score` 
			FROM `t_surveytransaction`  A INNER JOIN t_qheader B 
				ON A.`QuestId`=B.id INNER JOIN t_projects C 
				ON B.`ProjectCode`=C.`id` INNER JOIN t_qlabel D 
				ON B.`ProjectCode`=D.`projectId` 
			WHERE D.`choiceNo`=A.`weightIndex`
			AND A.`StudentCode`=:userCode 
			AND B.`ProjectCode`=:projectId
			AND B.`QuestionNo` IN (".$strL.")
			ORDER BY B.`QuestionNo`
			";


			$stmt=$this->conn->prepare($query);
			$stmt->bindParam(":userCode",$userCode);
			$stmt->bindParam(":projectId",$projectId);
			$stmt->execute();

		}



		public function getAnswerBurnout($userCode,$projectId){
			$query="SELECT 
				A.`StudentCode`,
				B.`QuestionNo` AS QNo,
				B.`HeaderCaption` AS Question,
				B.`ProjectCode`,
				D.`label` AS Answer,
				A.`Score`,
				A.`weightIndex`
			FROM `t_surveytransaction`  A INNER JOIN t_qheader B 
			ON A.`QuestId`=B.id INNER JOIN t_projects C 
			ON B.`ProjectCode`=C.`id` INNER JOIN t_qlabel D 
			ON B.`ProjectCode`=D.`projectId` 
			WHERE D.`choiceNo`=7-A.`weightIndex`
			AND A.`StudentCode`=:userCode 
			AND B.`ProjectCode`=:projectId
			ORDER BY B.`QuestionNo`
			";

			$stmt=$this->conn->prepare($query);
			$stmt->bindParam(":userCode",$userCode);
			$stmt->bindParam(":projectId",$projectId);
			$stmt->execute();
			return $stmt;

		}

		public function getAnswerNormal($userCode,$projectId){
			$query="SELECT 
				A.`StudentCode`,
				B.`QuestionNo` AS QNo,
				B.`HeaderCaption` AS Question,
				B.`ProjectCode`,
				D.`label` AS Answer,
				A.`Score`,
				A.`weightIndex`
			FROM `t_surveytransaction`  A INNER JOIN t_qheader B 
			ON A.`QuestId`=B.id INNER JOIN t_projects C 
			ON B.`ProjectCode`=C.`id` INNER JOIN t_qlabel D 
			ON B.`ProjectCode`=D.`projectId` 
			WHERE D.`choiceNo`=A.`weightIndex`
			AND A.`StudentCode`=:userCode 
			AND B.`ProjectCode`=:projectId
			ORDER BY B.`QuestionNo`
			";

			$stmt=$this->conn->prepare($query);
			$stmt->bindParam(":userCode",$userCode);
			$stmt->bindParam(":projectId",$projectId);
			$stmt->execute();
			return $stmt;

		}

		public function getAnswerSuicide($userCode){
			$query="SELECT 
					A.`StudentCode`,
					B.`QuestionNo` AS QNo,
					B.`HeaderCaption` AS Question,
					B.`ProjectCode`,
					D.`caption` AS Answer, 
					A.Score
			FROM `t_surveytransaction`  A INNER JOIN t_qheader B 
			ON A.`QuestId`=B.id INNER JOIN t_projects C 
			ON B.`ProjectCode`=C.`id` INNER JOIN t_questionchoice D 
			ON B.id=D.`questionId` WHERE  A.`weightIndex`=D.`indexNo`  
			AND  B.`ProjectCode`=15 AND A.StudentCode=:userCode ORDER BY B.`QuestionNo` ";
			$stmt=$this->conn->prepare($query);
			$stmt->bindParam(":userCode",$userCode);
			$stmt->execute();
			return $stmt;

		}



}

?>