<?php
include_once "keyWord.php";
class  tqheader{
	private $conn;
	private $table_name="t_qheader";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $HeaderCaption;
	public $ProjectCode;
	public $Description;
	public $QuestionNo;
	public $Qtype;
	public $ChoiceNo;
	public $uniform;
	public function create(){
		$query='INSERT INTO t_qheader  
        	SET 
			HeaderCaption=:HeaderCaption,
			ProjectCode=:ProjectCode,
			Description=:Description,
			QuestionNo=:QuestionNo,
			Qtype=:Qtype,
			ChoiceNo=:ChoiceNo,
			uniform=:uniform
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":HeaderCaption",$this->HeaderCaption);
		$stmt->bindParam(":ProjectCode",$this->ProjectCode);
		$stmt->bindParam(":Description",$this->Description);
		$stmt->bindParam(":QuestionNo",$this->QuestionNo);
		$stmt->bindParam(":Qtype",$this->Qtype);
		$stmt->bindParam(":ChoiceNo",$this->ChoiceNo);
		$stmt->bindParam(":uniform",$this->uniform);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_qheader 
        	SET 
			HeaderCaption=:HeaderCaption,
			ProjectCode=:ProjectCode,
			Description=:Description,
			QuestionNo=:QuestionNo,
			Qtype=:Qtype,
			ChoiceNo=:ChoiceNo,
			uniform=:uniform
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":HeaderCaption",$this->HeaderCaption);
		$stmt->bindParam(":ProjectCode",$this->ProjectCode);
		$stmt->bindParam(":Description",$this->Description);
		$stmt->bindParam(":QuestionNo",$this->QuestionNo);
		$stmt->bindParam(":Qtype",$this->Qtype);
		$stmt->bindParam(":ChoiceNo",$this->ChoiceNo);
		$stmt->bindParam(":uniform",$this->uniform);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			HeaderCaption,
			ProjectCode,
			Description,
			QuestionNo,
			Qtype,
			ChoiceNo,
			uniform
		FROM t_qheader WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($ProjectCode){
		
		$query='SELECT  
			A.id,
			A.QuestionNo,
			A.HeaderCaption,
			B.ProjectName AS ProjectCode,
			A.Description,
			C.Caption AS Qtype,
			A.Qtype AS QtypeCode,
			A.ChoiceNo,
			A.uniform
		FROM t_qheader A 
		INNER JOIN t_projects B 
		ON A.ProjectCode=B.id
		INNER JOIN t_questiontype C 
		ON A.Qtype=C.id
		WHERE A.ProjectCode = :ProjectCode ORDER BY A.QuestionNo';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':ProjectCode',$ProjectCode);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_qheader WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_qheader WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>