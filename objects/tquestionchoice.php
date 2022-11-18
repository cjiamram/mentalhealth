<?php
include_once "keyWord.php";
class  tquestionchoice{
	private $conn;
	private $table_name="t_questionchoice";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $questionId;
	public $caption;
	public $weight;
	public $indexNo;
	public function create(){
		$query='INSERT INTO t_questionchoice  
        	SET 
			questionId=:questionId,
			caption=:caption,
			weight=:weight,
			indexNo=:indexNo
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":questionId",$this->questionId);
		$stmt->bindParam(":caption",$this->caption);
		$stmt->bindParam(":weight",$this->weight);
		$stmt->bindParam(":indexNo",$this->indexNo);

		//print_r($this->index);

		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_questionchoice 
        	SET 
			questionId=:questionId,
			caption=:caption,
			weight=:weight,
			indexNo=:indexNo
	
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":questionId",$this->questionId);
		$stmt->bindParam(":caption",$this->caption);
		$stmt->bindParam(":weight",$this->weight);
		$stmt->bindParam(":indexNo",$this->indexNo);

		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			questionId,
			caption,
			weight,
			indexNo
		FROM t_questionchoice WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($questionId){

		//print_r($questionId);
		$query='SELECT  id AS cid,
			questionId,
			caption,
			weight,
			indexNo
		FROM t_questionchoice WHERE questionId LIKE :questionId';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':questionId',$questionId);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_questionchoice WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_questionchoice WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>