<?php
include_once "keyWord.php";
class  tprojects{
	private $conn;
	private $table_name="t_projects";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $ProjectName;
	public $Description;
	public $CreateDate;
	public $CreateBy;
	public $template;

	public function listProject(){
		$query="SELECT id,ProjectName FROM t_projects";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function getDataWithoutSub($projectGroupId){

		$query="SELECT id,ProjectName FROM t_projects
		WHERE id NOT IN(
			SELECT ProjectId FROM 
			t_projectgroupsub WHERE 
			ProjectGroupId=:ProjectGroupId 
			)
		";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":ProjectGroupId",$projectGroupId);
		$stmt->execute();
		return $stmt;
	}

	public function create(){
		$query='INSERT INTO t_projects  
        	SET 
			ProjectName=:ProjectName,
			Description=:Description,
			CreateDate=:CreateDate,
			CreateBy=:CreateBy,
			template=:template
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":ProjectName",$this->ProjectName);
		$stmt->bindParam(":Description",$this->Description);
		$stmt->bindParam(":CreateDate",$this->CreateDate);
		$stmt->bindParam(":CreateBy",$this->CreateBy);
		$stmt->bindParam(":template",$this->template);

		$flag=$stmt->execute();
		return $flag;
	}

	public function getProjectName($id){
		$query="SELECT id,ProjectName,Description FROM t_projects
		WHERE id=:id
		";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":id",$id);
		$stmt->execute();
		if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			return $ProjectName;
		}
		return "";

	}

	public function update(){
		$query='UPDATE t_projects 
        	SET 
			ProjectName=:ProjectName,
			Description=:Description,
			CreateDate=:CreateDate,
			CreateBy=:CreateBy,
			template=:template
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":ProjectName",$this->ProjectName);
		$stmt->bindParam(":Description",$this->Description);
		$stmt->bindParam(":CreateDate",$this->CreateDate);
		$stmt->bindParam(":CreateBy",$this->CreateBy);
		$stmt->bindParam(":template",$this->template);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			ProjectName,
			Description,
			CreateDate,
			CreateBy,
			template
		FROM t_projects WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
		$query='SELECT  A.id,
			A.ProjectName,
			A.Description,
			A.CreateDate,
			A.CreateBy,
			B.template
		FROM t_projects A
		LEFT OUTER JOIN t_template B ON 
		A.template=B.code 
		WHERE A.ProjectName LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_projects WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_projects WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>