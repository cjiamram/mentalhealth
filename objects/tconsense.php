<?php
include_once "keyWord.php";
class  tconsense{
	private $conn;
	private $table_name="t_consense";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $consense;
	public function create(){
		$query='INSERT INTO t_consense  
        	SET 
			consense=:consense
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":consense",$this->consense);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_consense 
        	SET 
			consense=:consense
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":consense",$this->consense);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT 
			consense
		FROM t_consense WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData(){
		$query='SELECT  
			consense
		FROM t_consense ';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_consense WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_consense WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>