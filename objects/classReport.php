<?php
class ClassReport{
		private $conn;
        public $table_name;
        public $db_name;


        public function __construct($db){
            $this->conn = $db;
        }

        

        public function groupStaffAgeRange($departmentCode){
             $query="SELECT B.`ageRange`,COUNT(A.id) AS CNT
                FROM t_staffsurveyform A 
                INNER JOIN `t_agerange` B 
                ON A.`age`=B.`code` 
                INNER JOIN t_evaluate C 
                ON A.userCode=C.userCode
                WHERE A.department LIKE :departmentCode
                GROUP BY B.`ageRange`
            ";
            $stmt=$this->conn->prepare($query);
            $departmentCode="%{$departmentCode}%";
            $stmt->bindParam(":departmentCode",$departmentCode);
            $stmt->execute();
            return $stmt;
        }

         public function groupStaffGender($departmentCode){
            $query="SELECT B.gender,COUNT(A.ID) AS CNT  
            FROM t_staffsurveyform A INNER JOIN t_gender B
            ON A.`gender`=B.code INNER JOIN t_evaluate C 
            ON A.userCode=C.userCode
            WHERE A.department LIKE :departmentCode
            GROUP BY B.gender  
            ";
            $stmt=$this->conn->prepare($query);
            $departmentCode="%{$departmentCode}%";
            $stmt->bindParam(":departmentCode",$departmentCode);
            $stmt->execute();
            return $stmt;
        }	

        public function groupStudentGender($departmentCode){
        	$query="SELECT B.gender,COUNT(A.ID) AS CNT  
        	FROM t_surveyform A INNER JOIN t_gender B
			ON A.`gender`=B.code INNER JOIN t_evaluate C 
            ON A.userCode=C.userCode
            WHERE A.faculty LIKE :departmentCode
            GROUP BY B.gender 
			";
			$stmt=$this->conn->prepare($query);
			$departmentCode="%{$departmentCode}%";
			$stmt->bindParam(":departmentCode",$departmentCode);
			$stmt->execute();
			return $stmt;
        }

         public function groupStudentLevelYear($departmentCode){
        	$query="SELECT A.LevelYear,
        	COUNT(A.ID) AS CNT  
        	FROM t_surveyform A INNER JOIN t_evaluate B 
            ON A.userCode=B.userCode
        	WHERE A.faculty LIKE :departmentCode 

			GROUP BY A.LevelYear";
			$stmt=$this->conn->prepare($query);
			$departmentCode="%{$departmentCode}%";
			$stmt->bindParam(":departmentCode",$departmentCode);
			$stmt->execute();
			return $stmt;
        }



        //******************************************************************//

        public function getStaffStress($departmentCode){
            $query="SELECT C.description AS stress,C.code,C.color,COUNT(A.id) AS CNT 
            FROM `t_staffsurveyform` A INNER JOIN `t_evaluate` B 
            ON A.`userCode`=B.`userCode` INNER JOIN `t_leveldefinition` C 
            ON B.`stressGrade`=C.`code`
            WHERE A.`department` LIKE :departmentCode
            GROUP BY C.`description`,C.code,C.color";
            $stmt=$this->conn->prepare($query);
            $departmentCode="%{$departmentCode}%";
            $stmt->bindParam(":departmentCode",$departmentCode);
            $stmt->execute();
            return $stmt;
        }

        public function getStaffStressGender($departmentCode,$levelCode){
            $query="SELECT D.gender,COUNT(A.id) AS CNT 
                FROM `t_staffsurveyform` A INNER JOIN `t_evaluate` B 
                ON A.`userCode`=B.`userCode` INNER JOIN `t_leveldefinition` C 
                ON B.`stressGrade`=C.`code` INNER JOIN t_gender D 
                ON A.`gender`=D.code 
                WHERE A.`department` LIKE :departmentCode 
                AND C.code LIKE :levelCode
                GROUP BY D.gender";
                $stmt=$this->conn->prepare($query);
                $departmentCode="%{$departmentCode}%";
                $levelCode="%{$levelCode}%";
                $stmt->bindParam(":departmentCode",$departmentCode);
                $stmt->bindParam(":levelCode",$levelCode);
                $stmt->execute();
                return $stmt;
        }


        public function getStaffSuicide($departmentCode){
            $query="SELECT C.description AS suicide,C.code,C.color,COUNT(A.id) AS CNT 
            FROM `t_staffsurveyform` A INNER JOIN `t_evaluate` B 
            ON A.`userCode`=B.`userCode` INNER JOIN `t_leveldefinition` C 
            ON B.`suicideGrade`=C.`code`
            WHERE A.`department` LIKE :departmentCode
            GROUP BY C.`description`,C.code,C.color";
            $stmt=$this->conn->prepare($query);
            $departmentCode="%{$departmentCode}%";
            $stmt->bindParam(":departmentCode",$departmentCode);
            $stmt->execute();
            return $stmt;
        }


        public function getStaffSuicideGender($departmentCode,$levelCode){
            $query="SELECT D.gender,COUNT(A.id) AS CNT 
                FROM `t_staffsurveyform` A INNER JOIN `t_evaluate` B 
                ON A.`userCode`=B.`userCode` INNER JOIN `t_leveldefinition` C 
                ON B.`suicideGrade`=C.`code` INNER JOIN t_gender D 
                ON A.`gender`=D.code 
                WHERE A.`department` LIKE :departmentCode 
                AND C.code LIKE :levelCode
                GROUP BY D.gender";
                $stmt=$this->conn->prepare($query);
                $departmentCode="%{$departmentCode}%";
                $levelCode="%{$levelCode}%";
                $stmt->bindParam(":departmentCode",$departmentCode);
                $stmt->bindParam(":levelCode",$levelCode);
                $stmt->execute();
                return $stmt;
        }


        public function getStaffDepress($departmentCode){
            $query="SELECT C.description AS depress,C.code,C.color,COUNT(A.id) AS CNT 
            FROM `t_staffsurveyform` A INNER JOIN `t_evaluate` B 
            ON A.`userCode`=B.`userCode` INNER JOIN `t_leveldefinition` C 
            ON B.`depressGrade`=C.`code`
            WHERE A.`department` LIKE :departmentCode
            GROUP BY C.`description`,C.code,C.color";
            $stmt=$this->conn->prepare($query);
            $departmentCode="%{$departmentCode}%";
            $stmt->bindParam(":departmentCode",$departmentCode);
            $stmt->execute();
            return $stmt;
        }

        public function getStaffDepressGender($departmentCode,$levelCode){
            $query="SELECT D.gender,COUNT(A.id) AS CNT 
                FROM `t_staffsurveyform` A INNER JOIN `t_evaluate` B 
                ON A.`userCode`=B.`userCode` INNER JOIN `t_leveldefinition` C 
                ON B.`depressGrade`=C.`code` INNER JOIN t_gender D 
                ON A.`gender`=D.code 
                WHERE A.`department` LIKE :departmentCode 
                AND C.code LIKE :levelCode
                GROUP BY D.gender";
                $stmt=$this->conn->prepare($query);
                $departmentCode="%{$departmentCode}%";
                $levelCode="%{$levelCode}%";
                $stmt->bindParam(":departmentCode",$departmentCode);
                $stmt->bindParam(":levelCode",$levelCode);
                $stmt->execute();
                return $stmt;
        }

    //******************************************************************//

    public function getStudentStress($departmentCode){
            $query="SELECT C.description AS stress,C.code,C.color,COUNT(A.id) AS CNT 
            FROM `t_surveyform` A INNER JOIN `t_evaluate` B 
            ON A.`userCode`=B.`userCode` INNER JOIN `t_leveldefinition` C 
            ON B.`stressGrade`=C.`code`
            WHERE A.`faculty` LIKE :departmentCode
            GROUP BY C.`description`,C.code,C.color";
            $stmt=$this->conn->prepare($query);
            $departmentCode="%{$departmentCode}%";
            $stmt->bindParam(":departmentCode",$departmentCode);
            $stmt->execute();
            return $stmt;
    }


    public function getStudentSressGender($departmentCode,$levelCode){
            $query="SELECT D.gender,COUNT(A.id) AS CNT 
                FROM `t_surveyform` A INNER JOIN `t_evaluate` B 
                ON A.`userCode`=B.`userCode` INNER JOIN `t_leveldefinition` C 
                ON B.`stressGrade`=C.`code` INNER JOIN t_gender D 
                ON A.`gender`=D.code 
                WHERE A.`faculty` LIKE :departmentCode 
                AND C.code LIKE :levelCode
                GROUP BY D.gender";
                $stmt=$this->conn->prepare($query);
                $departmentCode="%{$departmentCode}%";
                $levelCode="%{$levelCode}%";
                $stmt->bindParam(":departmentCode",$departmentCode);
                $stmt->bindParam(":levelCode",$levelCode);
                $stmt->execute();
                return $stmt;
        }


        public function getStudentSuicide($departmentCode){
            $query="SELECT C.description AS suicide,C.code,C.color,COUNT(A.id) AS CNT 
            FROM `t_surveyform` A INNER JOIN `t_evaluate` B 
            ON A.`userCode`=B.`userCode` INNER JOIN `t_leveldefinition` C 
            ON B.`suicideGrade`=C.`code`
            WHERE A.`faculty` LIKE :departmentCode
            GROUP BY C.`description`,C.code,C.color ";
            $stmt=$this->conn->prepare($query);
            $departmentCode="%{$departmentCode}%";
            $stmt->bindParam(":departmentCode",$departmentCode);
            $stmt->execute();
            return $stmt;
        }

      public function getStudentSuicideGender($departmentCode,$levelCode){
            $query="SELECT D.gender,COUNT(A.id) AS CNT 
                FROM `t_surveyform` A INNER JOIN `t_evaluate` B 
                ON A.`userCode`=B.`userCode` INNER JOIN `t_leveldefinition` C 
                ON B.`suicideGrade`=C.`code` INNER JOIN t_gender D 
                ON A.`gender`=D.code 
                WHERE A.`faculty` LIKE :departmentCode 
                AND C.code LIKE :levelCode
                GROUP BY D.gender";
                $stmt=$this->conn->prepare($query);
                $departmentCode="%{$departmentCode}%";
                $levelCode="%{$levelCode}%";
                $stmt->bindParam(":departmentCode",$departmentCode);
                $stmt->bindParam(":levelCode",$levelCode);
                $stmt->execute();
                return $stmt;
        }


        public function getStudentDepress($departmentCode){
            $query="SELECT C.description AS depress,C.code,C.color,COUNT(A.id) AS CNT 
            FROM `t_surveyform` A INNER JOIN `t_evaluate` B 
            ON A.`userCode`=B.`userCode` INNER JOIN `t_leveldefinition` C 
            ON B.`depressGrade`=C.`code`
            WHERE A.`faculty` LIKE :departmentCode
            GROUP BY C.`description`,C.code,C.color";
            $stmt=$this->conn->prepare($query);
            $departmentCode="%{$departmentCode}%";
            $stmt->bindParam(":departmentCode",$departmentCode);
            $stmt->execute();
            return $stmt;
        }

        public function getStudentDepressGender($departmentCode,$levelCode){
            $query="SELECT D.gender,COUNT(A.id) AS CNT 
                FROM `t_surveyform` A INNER JOIN `t_evaluate` B 
                ON A.`userCode`=B.`userCode` INNER JOIN `t_leveldefinition` C 
                ON B.`depressGrade`=C.`code` INNER JOIN t_gender D 
                ON A.`gender`=D.code 
                WHERE A.`faculty` LIKE :departmentCode 
                AND C.code LIKE :levelCode
                GROUP BY D.gender";
                $stmt=$this->conn->prepare($query);
                $departmentCode="%{$departmentCode}%";
                $levelCode="%{$levelCode}%";
                $stmt->bindParam(":departmentCode",$departmentCode);
                $stmt->bindParam(":levelCode",$levelCode);
                $stmt->execute();
                return $stmt;
        }   


}

?>