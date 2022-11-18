<?php
include_once "keyWord.php";
class  tsuggestion{
	private $conn;
	private $table_name="t_suggestion";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $projectId;
	public $suggestion;
	public $keyIndex;
	public function create(){
		$query='INSERT INTO t_suggestion  
        	SET 
			projectId=:projectId,
			suggestion=:suggestion,
			keyIndex=:keyIndex
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":projectId",$this->projectId);
		$stmt->bindParam(":suggestion",$this->suggestion);
		$stmt->bindParam(":keyIndex",$this->keyIndex);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_suggestion 
        	SET 
			projectId=:projectId,
			suggestion=:suggestion,
			keyIndex=:keyIndex
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":projectId",$this->projectId);
		$stmt->bindParam(":suggestion",$this->suggestion);
		$stmt->bindParam(":keyIndex",$this->keyIndex);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			projectId,
			suggestion,
			keyIndex
		FROM t_suggestion WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	
	public function getData($projectId,$keyIndex){

		$query="SELECT  id,
			projectId,
			suggestion,
			keyIndex
		FROM t_suggestion
		WHERE  projectId=:projectId 
		AND keyIndex = :keyIndex
		";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":projectId",$projectId);
		$stmt->bindParam(":keyIndex",$keyIndex);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_suggestion WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_suggestion WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>