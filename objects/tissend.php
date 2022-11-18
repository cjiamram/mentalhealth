<?php
include_once "keyWord.php";
class  tissend{
	private $conn;
	private $table_name="t_issend";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $userCode;
	public $isSend;
	public function create(){
		$query='INSERT INTO t_issend  
        	SET 
			userCode=:userCode,
			isSend=:isSend
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":isSend",$this->isSend);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_issend 
        	SET 
			userCode=:userCode,
			isSend=:isSend
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":isSend",$this->isSend);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			userCode,
			isSend
		FROM t_issend WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData(){
		
		$query='SELECT  id,
			userCode,
			isSend
		FROM t_issend ';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function isSend($userCode){
		$query="SELECT id FROM t_issend 
		WHERE userCode=:userCode AND isSend=1 ";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		$flag=$stmt->rowCount()>0?true:false;
		return $flag;
	}


	function delete($userCode){
		$query='DELETE FROM t_issend WHERE userCode=:userCode';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_issend WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>