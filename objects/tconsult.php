<?php
include_once "keyWord.php";
class  tconsult{
	private $conn;
	private $table_name="t_consult";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $email;
	public $description;
	public $flag;
	public function create(){
		$query="INSERT INTO t_consult  
        	SET 
			email=:email,
			description=:description,
			flag=:flag";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":email",$this->email);
		$stmt->bindParam(":description",$this->description);
		$stmt->bindParam(":flag",$this->flag);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_consult 
        	SET 
			email=:email,
			description=:description,
			flag=:flag
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":email",$this->email);
		$stmt->bindParam(":description",$this->description);
		$stmt->bindParam(":flag",$this->flag);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			email,
			description,
			flag
		FROM t_consult WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData(){
		$query="SELECT  id,
			email,
			description,
			flag
		FROM t_consult WHERE flag=1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function getDataByLevel($sendOrder){
		$query="SELECT  id,
			email,
			description,
			flag
		FROM t_consult 
		WHERE 
			flag=1
		AND 
			levelIndex=:sendOrder
		";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":sendOrder",$sendOrder);
		$stmt->execute();
		return $stmt;
	}

	public function getDataByFaculty($falculty){
		$query="SELECT  id,
			email,
			description,
			flag
		FROM t_consult 
		WHERE 
			flag=1
		AND 
			adminFaculty=:faculty
		";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":falculty",$falculty);
		$stmt->execute();
		return $stmt;
	}



	function delete(){
		$query='DELETE FROM t_consult WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_consult WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>