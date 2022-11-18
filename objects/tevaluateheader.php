<?php
include_once "keyWord.php";
class  tevaluateheader{
	private $conn;
	private $table_name="t_evaluateheader";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $studentCode;
	public $projectGroup;
	public $status;
	public $department;
	public function create(){
		$query='INSERT INTO t_evaluateheader  
        	SET 
			studentCode=:studentCode,
			projectGroup=:projectGroup,
			status=:status,
			department=:department
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":studentCode",$this->studentCode);
		$stmt->bindParam(":projectGroup",$this->projectGroup);
		$stmt->bindParam(":status",$this->status);
		$stmt->bindParam(":department",$this->department);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_evaluateheader 
        	SET 
			studentCode=:studentCode,
			projectGroup=:projectGroup,
			status=:status,
			department=:department
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":studentCode",$this->studentCode);
		$stmt->bindParam(":projectGroup",$this->projectGroup);
		$stmt->bindParam(":status",$this->status);
		$stmt->bindParam(":department",$this->department);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			studentCode,
			projectGroup,
			status,
			department
		FROM t_evaluateheader WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
		$key=KeyWord::getKeyWord($this->conn,$this->table_name);
		$key=($key!="")?$key:"keyWord";
		$query='SELECT  id,
			studentCode,
			projectGroup,
			status,
			department
		FROM t_evaluateheader WHERE '.$key.' LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_evaluateheader WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_evaluateheader WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>