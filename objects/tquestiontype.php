<?php
include_once "keyWord.php";
class  tquestiontype{
	private $conn;
	private $table_name="t_questiontype";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $Caption;
	public function create(){
		$query='INSERT INTO t_questiontype  
        	SET 
			Caption=:Caption
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":Caption",$this->Caption);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_questiontype 
        	SET 
			Caption=:Caption
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":Caption",$this->Caption);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			Caption
		FROM t_questiontype WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData(){
		
		$query='SELECT  
			id,
			Caption
		FROM t_questiontype ';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_questiontype WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_questiontype WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>