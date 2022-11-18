<?php
include_once "keyWord.php";
class  tqlabel{
	private $conn;
	private $table_name="t_qlabel";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $projectId;
	public $choiceNo;
	public $label;
	public $weight;
	public function create(){
		$query='INSERT INTO t_qlabel  
        	SET 
			projectId=:projectId,
			choiceNo=:choiceNo,
			label=:label,
			weight=:weight
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":projectId",$this->projectId);
		$stmt->bindParam(":choiceNo",$this->choiceNo);
		$stmt->bindParam(":label",$this->label);
		$stmt->bindParam(":weight",$this->weight);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_qlabel 
        	SET 
			projectId=:projectId,
			choiceNo=:choiceNo,
			label=:label,
			weight=:weight
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":projectId",$this->projectId);
		$stmt->bindParam(":choiceNo",$this->choiceNo);
		$stmt->bindParam(":label",$this->label);
		$stmt->bindParam(":weight",$this->weight);

		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			projectId,
			choiceNo,
			label,
			weight
		FROM t_qlabel WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}

	public function getCount($projectId){
		$query="SELECT id 
		FROM t_qlabel WHERE projectId=:projectId";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":projectId",$projectId);
		$stmt->execute();
		$cnt=$stmt->rowCount();
		return $cnt;
	}

	public function getData($projectId){
		$query='SELECT  id,
			projectId,
			choiceNo,
			label,
			weight
		FROM t_qlabel WHERE projectId=:projectId';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":projectId",$projectId);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_qlabel WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_qlabel WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>