<?php
include_once "keyWord.php";
class  tprojectgroupsub{
	private $conn;
	private $table_name="t_projectgroupsub";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $ProjectGroupId;
	public $ProjectId;
	public function create(){
		$query='INSERT INTO t_projectgroupsub  
        	SET 
			ProjectGroupId=:ProjectGroupId,
			ProjectId=:ProjectId
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":ProjectGroupId",$this->ProjectGroupId);
		$stmt->bindParam(":ProjectId",$this->ProjectId);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_projectgroupsub 
        	SET 
			ProjectGroupId=:ProjectGroupId,
			ProjectId=:ProjectId
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":ProjectGroupId",$this->ProjectGroupId);
		$stmt->bindParam(":ProjectId",$this->ProjectId);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			ProjectGroupId,
			ProjectId
		FROM t_projectgroupsub WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($projectGroupId){
		$query='SELECT  
			A.id,
			A.ProjectGroupId,
			A.ProjectId,
			B.ProjectName
		FROM t_projectgroupsub A  
		INNER JOIN t_projects B 
		ON A.ProjectId=B.id	
		WHERE 
		A.ProjectGroupId LIKE :projectGroupId';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':projectGroupId',$projectGroupId);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_projectgroupsub WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_projectgroupsub WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>