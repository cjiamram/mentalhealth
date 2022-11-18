<?php
include_once "keyWord.php";
class  tsurveyform{
	private $conn;
	private $table_name="t_surveyform";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $userCode;
	public $projectGroupId;
	public $contactPerson;
	public $urgentTel;
	public $telNo;
	public $levelYear;
	public $faculty;
	public $gender;


	public function getAllUser(){
		$query="SELECT userCode FROM t_surveyform ";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	} 

	public function create(){
		$query='INSERT INTO t_surveyform  
        	SET 
			userCode=:userCode,
			projectGroupId=:projectGroupId,
			contactPerson=:contactPerson,
			urgentTel=:urgentTel,
			telNo=:telNo,
			levelYear=:levelYear,
			faculty=:faculty,
			gender=:gender
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":projectGroupId",$this->projectGroupId);
		$stmt->bindParam(":contactPerson",$this->contactPerson);
		$stmt->bindParam(":urgentTel",$this->urgentTel);
		$stmt->bindParam(":telNo",$this->telNo);
		$stmt->bindParam(":levelYear",$this->levelYear);
		$stmt->bindParam(":faculty",$this->faculty);
		$stmt->bindParam(":gender",$this->gender);

		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_surveyform 
        	SET 
			userCode=:userCode,
			projectGroupId=:projectGroupId,
			contactPerson=:contactPerson,
			urgentTel=:urgentTel,
			telNo=:telNo,
			levelYear=:levelYear,
			faculty=:faculty,
			gender=:gender
		 WHERE userCode=:userCode';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":projectGroupId",$this->projectGroupId);
		$stmt->bindParam(":contactPerson",$this->contactPerson);
		$stmt->bindParam(":urgentTel",$this->urgentTel);
		$stmt->bindParam(":telNo",$this->telNo);
		$stmt->bindParam(":levelYear",$this->levelYear);
		$stmt->bindParam(":faculty",$this->faculty);
		$stmt->bindParam(":gender",$this->gender);


		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			userCode,
			projectGroupId,
			contactPerson,
			urgentTel,
			telNo,
			levelYear,
			faculty,
			gerder
		FROM t_surveyform WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}

	public function getIdExist($userCode){
		$query="SELECT id 
		FROM t_surveyform 
		WHERE userCode=:userCode";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		$flag=$stmt->rowCount()>0?true:false;
		return $flag;
	} 

	public function getData($keyWord){
		$query='SELECT  id,
			userCode,
			projectGroupId,
			contactPerson,
			urgentTel,
			telNo,
			levelYear,
			faculty,
			gerder
		FROM t_surveyform WHERE userCode LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_surveyform WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function genCode(){
		$curYear = date("Y")-2000+543;
		$curYear = substr($curYear,1,2);
		$curYear = sprintf("%02d", $curYear);
		$curMonth=date("n");
		$curMonth = sprintf("%02d",$curMonth);
		$prefix= $curYear .$curMonth;
		$query ="SELECT MAX(CODE) AS MXCode FROM t_surveyform WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>