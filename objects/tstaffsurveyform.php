<?php
include_once "keyWord.php";
class  tstaffsurveyform{
	private $conn;
	private $table_name="t_staffsurveyform";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $userCode;
	public $projectGroupId;
	public $contactPerson;
	public $urgentTel;
	public $telNo;
	public $staffType;
	public $department;
	public $age;
	public $gender;

	public function getAllUser(){
		$query="SELECT userCode FROM t_staffsurveyform ";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	} 

	public function getIdExist($userCode){
		$query="SELECT id FROM t_staffsurveyform 
		WHERE userCode=:userCode";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			$objItem=array("flag"=>true,"id"=>$id);	
			return $objItem;
		}else{
			$objItem=array("flag"=>false,"id"=>0);
			return $objItem;	
		}
	}

	

	public function create(){
		$query='INSERT INTO t_staffsurveyform  
        	SET 
			userCode=:userCode,
			projectGroupId=:projectGroupId,
			contactPerson=:contactPerson,
			urgentTel=:urgentTel,
			telNo=:telNo,
			staffType=:staffType,
			department=:department,
			age=:age,
			gender=:gender
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":projectGroupId",$this->projectGroupId);
		$stmt->bindParam(":contactPerson",$this->contactPerson);
		$stmt->bindParam(":urgentTel",$this->urgentTel);
		$stmt->bindParam(":telNo",$this->telNo);
		$stmt->bindParam(":staffType",$this->staffType);
		$stmt->bindParam(":department",$this->department);
		$stmt->bindParam(":age",$this->age);
		$stmt->bindParam(":gender",$this->gender);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_staffsurveyform 
        	SET 
			userCode=:userCode,
			projectGroupId=:projectGroupId,
			contactPerson=:contactPerson,
			urgentTel=:urgentTel,
			telNo=:telNo,
			staffType=:staffType,
			department=:department,
			age=:age,
			gender=:gender
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":projectGroupId",$this->projectGroupId);
		$stmt->bindParam(":contactPerson",$this->contactPerson);
		$stmt->bindParam(":urgentTel",$this->urgentTel);
		$stmt->bindParam(":telNo",$this->telNo);
		$stmt->bindParam(":staffType",$this->staffType);
		$stmt->bindParam(":department",$this->department);
		$stmt->bindParam(":age",$this->age);
		$stmt->bindParam(":gender",$this->gender);
		$stmt->bindParam(":id",$this->id);
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
			staffType,
			department,
			age,
			gender
		FROM t_staffsurveyform WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
		$key=KeyWord::getKeyWord($this->conn,$this->table_name);
		$key=($key!="")?$key:"keyWord";
		$query='SELECT  id,
			userCode,
			projectGroupId,
			contactPerson,
			urgentTel,
			telNo,
			staffType,
			department,
			age,
			gender
		FROM t_staffsurveyform WHERE '.$key.' LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	

	function delete(){
		$query='DELETE FROM t_staffsurveyform WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_staffsurveyform WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>