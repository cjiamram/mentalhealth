<?php
include_once "keyWord.php";
class  tsurveytransaction{
	private $conn;
	private $table_name="t_surveytransaction";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $ProjectCode;
	public $CreateDate;
	public $Score;
	public $QuestId;
	public $StudentCode;
	public $Answer;
	public $weightIndex;
	public $projectId;

	public function isSurvey($projectId,$studentCode){
		$query="SELECT id 
			FROM t_surveytransaction
		WHERE ProjectCode=:projectId 
			AND StudentCode=:studentCode
		";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":projectId",$projectId);
		$stmt->bindParam(":studentCode",$studentCode);
		$stmt->execute();
		if($stmt->rowCount()>0){
			return true;
		}
		return false;
	}


	public function isSurveyExist($userCode){
		$query="SELECT id 
		FROM t_surveytransaction 
		WHERE studentCode=:userCode
		";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		$flag=$stmt->rowCount()>0?true:false;
		return $flag;
	}



	public function isExist($questId,$studentCode){
		$query="SELECT 
		id
		FROM 
		t_surveytransaction 
		WHERE
			StudentCode=:StudentCode
		AND 
			QuestId=:QuestId
		 ";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":QuestId",$questId);
		$stmt->bindParam(":StudentCode",$studentCode);
		$stmt->execute();
		if($stmt->rowCount()>0){
			return true;
		}
		return false;

	}

	public function create(){
		$query="INSERT INTO t_surveytransaction  
        	SET 
			ProjectCode=:ProjectCode,
			CreateDate=:CreateDate,
			Score=:Score,
			QuestId=:QuestId,
			StudentCode=:StudentCode,
			Answer=:Answer,
			weightIndex=:weightIndex";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":ProjectCode",$this->ProjectCode);
		$stmt->bindParam(":CreateDate",$this->CreateDate);
		$stmt->bindParam(":Score",$this->Score);
		$stmt->bindParam(":QuestId",$this->QuestId);
		$stmt->bindParam(":StudentCode",$this->StudentCode);
		$stmt->bindParam(":Answer",$this->Answer);
		$stmt->bindParam(":weightIndex",$this->weightIndex);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_surveytransaction 
        	SET 
			ProjectCode=:ProjectCode,
			CreateDate=:CreateDate,
			Score=:Score,
			QuestId=:QuestId,
			StudentCode=:StudentCode,
			Answer=:Answer
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":ProjectCode",$this->ProjectCode);
		$stmt->bindParam(":CreateDate",$this->CreateDate);
		$stmt->bindParam(":Score",$this->Score);
		$stmt->bindParam(":QuestId",$this->QuestId);
		$stmt->bindParam(":StudentCode",$this->StudentCode);
		$stmt->bindParam(":Answer",$this->Answer);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			ProjectCode,
			CreateDate,
			Score,
			QuestId,
			StudentCode
		FROM t_surveytransaction WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
		$key=KeyWord::getKeyWord($this->conn,$this->table_name);
		$key=($key!="")?$key:"keyWord";
		$query='SELECT  id,
			ProjectCode,
			CreateDate,
			Score,
			QuestId,
			StudentCode
		FROM t_surveytransaction WHERE '.$key.' LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_surveytransaction WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$flag=$stmt->execute();
		return $flag;
	}

	function deleteByUserCode($userCode){
		$query="DELETE FROM t_surveytransaction WHERE StudentCode=:userCode";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':userCode',$userCode);
		$flag=$stmt->execute();
		return $flag;
	}

	function deleteSuicide($userCode){
		$query="DELETE FROM t_surveytransaction WHERE StudentCode=:userCode AND projectcode=9";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':userCode',$userCode);
		$flag=$stmt->execute();
		return $flag;
	}

	

    function getEmotionalLack($userCode){
    	$query="SELECT 
		SUM(6-A.`Score`) AS Score 
		FROM t_surveytransaction A 
		LEFT OUTER JOIN `t_qheader` B ON A.`QuestId`=B.`id` 
		LEFT OUTER JOIN `t_projects` C ON B.`ProjectCode`=C.`id`
		WHERE A.`StudentCode`=:userCode 
		AND B.`ProjectCode`=10
		AND B.QuestionNo IN (1, 2, 3, 6, 8, 13,14, 16, 20)";

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		if($stmt->rowCount()>0){
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		return intval($Score);}
		return 0;
	}

	  function getPersonalLack($userCode){
    	$query="SELECT 
		SUM(6-A.`Score`) AS Score 
		FROM t_surveytransaction A 
		LEFT OUTER JOIN `t_qheader` B ON A.`QuestId`=B.`id` 
		LEFT OUTER JOIN `t_projects` C ON B.`ProjectCode`=C.`id`
		WHERE A.`StudentCode`=:userCode 
		AND B.`ProjectCode`=10
		AND B.QuestionNo IN (5, 10, 11, 15, 22)";

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		if($stmt->rowCount()>0){
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		return intval($Score);}
		return 0;
	}

	 function getSuccess($userCode){
    	$query="SELECT 
		SUM(A.`Score`) AS Score 
		FROM t_surveytransaction A 
		LEFT OUTER JOIN `t_qheader` B ON A.`QuestId`=B.`id` 
		LEFT OUTER JOIN `t_projects` C ON B.`ProjectCode`=C.`id`
		WHERE A.`StudentCode`=:userCode 
		AND B.`ProjectCode`=10
		AND B.QuestionNo IN ( 4, 7, 9, 12, 17, 18,19, 21)";

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			return intval($Score);
		}
		return 0;
	}

	function getSucessRevert($userCode){
		$query="SELECT 
		SUM(6-A.`Score`) AS Score 
		FROM t_surveytransaction A 
		LEFT OUTER JOIN `t_qheader` B ON A.`QuestId`=B.`id` 
		LEFT OUTER JOIN `t_projects` C ON B.`ProjectCode`=C.`id`
		WHERE A.`StudentCode`=:userCode 
		AND B.`ProjectCode`=10
		AND B.QuestionNo IN ( 4, 7, 9, 12, 17, 18,19, 21)";

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		return $Score;
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		if($stmt->rowCount()>0){
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		return intval($Score);}
		return 0;
	}





	function getTotalBurnOut($userCode){
		return $this->getEmotionalLack($userCode)+$this->getPersonalLack($userCode)+$this->getSucess($userCode);
	}

	

	function getStressDefence($userCode){
    	$query="SELECT 
		SUM(A.`Score`)/10 AS Score 
		FROM t_surveytransaction A 
		LEFT OUTER JOIN `t_qheader` B ON A.`QuestId`=B.`id` 
		LEFT OUTER JOIN `t_projects` C ON B.`ProjectCode`=C.`id`
		WHERE A.`StudentCode`=:userCode 
		AND B.`ProjectCode`=11";

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		if($stmt->rowCount()>0){
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		return intval($Score);}

		return 0;
		
	}

	

	function getMindStrength($userCode){
    	$query="SELECT 
		SUM(A.`Score`) AS Score 
		FROM t_surveytransaction A 
		LEFT OUTER JOIN `t_qheader` B ON A.`QuestId`=B.`id` 
		LEFT OUTER JOIN `t_projects` C ON B.`ProjectCode`=C.`id`
		WHERE A.`StudentCode`=:userCode 
		AND B.`ProjectCode`=11";

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		if($stmt->rowCount()>0){
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		return intval($Score);}
		return 0;
	}

	function getMindStress($userCode){
    	$query="SELECT 
		SUM(A.`Score`) AS Score 
		FROM t_surveytransaction A 
		LEFT OUTER JOIN `t_qheader` B ON A.`QuestId`=B.`id` 
		LEFT OUTER JOIN `t_projects` C ON B.`ProjectCode`=C.`id`
		WHERE A.`StudentCode`=:userCode 
		AND B.`ProjectCode`=12";

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		if($stmt->rowCount()>0){
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		return intval($Score);}
		return 0;
	}
    


	function getDepress2Q($userCode){
		$query="SELECT 
		SUM(A.`Score`) AS Score 
		FROM t_surveytransaction A 
		LEFT OUTER JOIN `t_qheader` B ON A.`QuestId`=B.`id` 
		LEFT OUTER JOIN `t_projects` C ON B.`ProjectCode`=C.`id`
		WHERE A.`StudentCode`=:userCode 
		AND B.`ProjectCode`=13";

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		if($stmt->rowCount()>0){

			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			return intval($Score);
		}
		return 0;
	}


	function getDepress9Q($userCode){
		$query="SELECT 
		SUM(A.`Score`) AS Score 
		FROM t_surveytransaction A 
		LEFT OUTER JOIN `t_qheader` B ON A.`QuestId`=B.`id` 
		LEFT OUTER JOIN `t_projects` C ON B.`ProjectCode`=C.`id`
		WHERE A.`StudentCode`=:userCode AND B.`ProjectCode`=21";

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			return intval($Score);
		}else
			return 0;
	}

	function getDepress9Q_1($userCode){
		$query="SELECT 
		A.Score
		FROM t_surveytransaction A 
		LEFT OUTER JOIN t_qheader B ON A.QuestId=B.id 
		LEFT OUTER JOIN t_projects C ON B.ProjectCode=C.id
		WHERE A.StudentCode=:userCode AND B.ProjectCode=21
		AND B.QuestionNo=9
		";

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			extract($row);
			return intval($Score);
		}else
			return 0;
	}


	function getSuicide8Q($userCode){
		$query="SELECT 
		SUM(A.`Score`) AS Score 
		FROM t_surveytransaction A 
		LEFT OUTER JOIN `t_qheader` B ON A.`QuestId`=B.`id` 
		LEFT OUTER JOIN `t_projects` C ON B.`ProjectCode`=C.`id`
		WHERE A.`StudentCode`=:userCode AND B.`ProjectCode`=15";
		

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		if($stmt->rowCount()>0){

			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			return intval($Score);
		}
		else
			return 0;
	}




	public function genCode(){
		$curYear = date("Y")-2000+543;
		$curYear = substr($curYear,1,2);
		$curYear = sprintf("%02d", $curYear);
		$curMonth=date("n");
		$curMonth = sprintf("%02d",$curMonth);
		$prefix= $curYear .$curMonth;
		$query ="SELECT MAX(CODE) AS MXCode FROM t_surveytransaction WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>