<?php
include_once "keyWord.php";
class  tagerange{
	private $conn;
	private $table_name="t_agerange";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $code;
	public $ageRange;
	public function create(){
		$query='INSERT INTO t_agerange  
        	SET 
			code=:code,
			ageRange=:ageRange
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":code",$this->code);
		$stmt->bindParam(":ageRange",$this->ageRange);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_agerange 
        	SET 
			code=:code,
			ageRange=:ageRange
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":code",$this->code);
		$stmt->bindParam(":ageRange",$this->ageRange);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			code,
			ageRange
		FROM t_agerange WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData(){
		$query='SELECT  id,
			code,
			ageRange
		FROM t_agerange ';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_agerange WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_agerange WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>