<?php
include_once "keyWord.php";
class  tfaculty{
	private $conn;
	private $table_name="t_faculty";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $code;
	public $faculty;
	public function create(){
		$query='INSERT INTO t_faculty  
        	SET 
			code=:code,
			faculty=:faculty
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":code",$this->code);
		$stmt->bindParam(":faculty",$this->faculty);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_faculty 
        	SET 
			code=:code,
			faculty=:faculty
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":code",$this->code);
		$stmt->bindParam(":faculty",$this->faculty);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			code,
			faculty
		FROM t_faculty WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
		
		$query='SELECT  id,
			code,
			faculty
		FROM t_faculty WHERE faculty LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}



	function delete(){
		$query='DELETE FROM t_faculty WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_faculty WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>