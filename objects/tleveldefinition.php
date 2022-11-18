<?php
include_once "keyWord.php";
class  tleveldefinition{
	private $conn;
	private $table_name="t_leveldefinition";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $code;
	public $color;
	public $description;
	public function create(){
		$query='INSERT INTO t_leveldefinition  
        	SET 
			code=:code,
			color=:color,
			description=:description
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":code",$this->code);
		$stmt->bindParam(":color",$this->color);
		$stmt->bindParam(":description",$this->description);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_leveldefinition 
        	SET 
			code=:code,
			color=:color,
			description=:description
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":code",$this->code);
		$stmt->bindParam(":color",$this->color);
		$stmt->bindParam(":description",$this->description);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			code,
			color,
			description
		FROM t_leveldefinition WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($code){
		$query="SELECT  
			id,
			code,
			color,
			description
		FROM t_leveldefinition 
		WHERE code=:code";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':code',$code);
		$stmt->execute();
		return $stmt;
	}

	public function getDescription($code){
		$query="SELECT  
			description
		FROM t_leveldefinition 
		WHERE code=:code";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':code',$code);
		$stmt->execute();
		if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			return $description;
		}
		return "";
	}

	function delete(){
		$query='DELETE FROM t_leveldefinition WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_leveldefinition WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>