<?php
include_once "keyWord.php";
class  ttemplate{
	private $conn;
	private $table_name="t_template";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $code;
	public $template;
	public function create(){
		$query='INSERT INTO t_template  
        	SET 
			code=:code,
			template=:template
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":code",$this->code);
		$stmt->bindParam(":template",$this->template);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_template 
        	SET 
			code=:code,
			template=:template
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":code",$this->code);
		$stmt->bindParam(":template",$this->template);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			code,
			template
		FROM t_template WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData(){
		$query='SELECT  id,
			code,
			template
		FROM t_template ';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_template WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_template WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>