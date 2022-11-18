<?php
include_once "keyWord.php";
class  tprojectgroup{
	private $conn;
	private $table_name="t_projectgroup";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $ProjectGroup;
	public $CreateDate;
	public $Owner;
	public $Objective;
	public function create(){
		$query='INSERT INTO t_projectgroup  
        	SET 
			ProjectGroup=:ProjectGroup,
			CreateDate=:CreateDate,
			Owner=:Owner,
			Objective=:Objective
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":ProjectGroup",$this->ProjectGroup);
		$stmt->bindParam(":CreateDate",$this->CreateDate);
		$stmt->bindParam(":Owner",$this->Owner);
		$stmt->bindParam(":Objective",$this->Objective);
		$flag=$stmt->execute();
		return $flag;
	}

	public function getDescription($id){
		$query="SELECT description FROM t_projectgroup
		WHERE id=:id
		";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":id",$id);
		$stmt->execute();
		if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			return $description;
		}else
		return "";
	}


	public function update(){
		$query='UPDATE t_projectgroup 
        	SET 
			ProjectGroup=:ProjectGroup,
			CreateDate=:CreateDate,
			Owner=:Owner,
			Objective=:Objective
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":ProjectGroup",$this->ProjectGroup);
		$stmt->bindParam(":CreateDate",$this->CreateDate);
		$stmt->bindParam(":Owner",$this->Owner);
		$stmt->bindParam(":Objective",$this->Objective);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			ProjectGroup,
			CreateDate,
			Owner,
			Objective
		FROM t_projectgroup WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}

	public function listProjectGroup(){
		$query='SELECT  
			id,
			ProjectGroup
		FROM 
			t_projectgroup 
		';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}


	public function getData($keyWord){
		$query='SELECT  
			id,
			ProjectGroup,
			CreateDate,
			Owner,
			Objective
		FROM t_projectgroup 
		WHERE 
		ProjectGroup LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}

	function getTransaction($userCode){
		
	}


	function delete(){
		$query='DELETE FROM t_projectgroup WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_projectgroup WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>