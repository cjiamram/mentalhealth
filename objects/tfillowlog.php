<?php
include_once "keyWord.php";
class  tfillowlog{
	private $conn;
	private $table_name="t_fillowlog";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $userCode;
	public $isFollow;
	public $isContact;
	public $isAppoint;
	public $helpDescription;
	public $helpEffective;
	public $createDate;
	public $status;
	public function create(){
		$query='INSERT INTO t_fillowlog  
        	SET 
			userCode=:userCode,
			isFollow=:isFollow,
			isContact=:isContact,
			isAppoint=:isAppoint,
			helpDescription=:helpDescription,
			helpEffective=:helpEffective,
			createDate=:createDate
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":isFollow",$this->isFollow);
		$stmt->bindParam(":isContact",$this->isContact);
		$stmt->bindParam(":isAppoint",$this->isAppoint);
		$stmt->bindParam(":helpDescription",$this->helpDescription);
		$stmt->bindParam(":helpEffective",$this->helpEffective);
		$stmt->bindParam(":createDate",$this->createDate);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_fillowlog 
        	SET 
			userCode=:userCode,
			isFollow=:isFollow,
			isContact=:isContact,
			isAppoint=:isAppoint,
			helpDescription=:helpDescription,
			helpEffective=:helpEffective,
			createDate=:createDate
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":isFollow",$this->isFollow);
		$stmt->bindParam(":isContact",$this->isContact);
		$stmt->bindParam(":isAppoint",$this->isAppoint);
		$stmt->bindParam(":helpDescription",$this->helpDescription);
		$stmt->bindParam(":helpEffective",$this->helpEffective);
		$stmt->bindParam(":createDate",$this->createDate);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			userCode,
			isFollow,
			isContact,
			isAppoint,
			helpDescription,
			helpEffective,
			createDate
		FROM t_fillowlog WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($userCode){
		//$key=KeyWord::getKeyWord($this->conn,$this->table_name);
		//$key=($key!="")?$key:"keyWord";
		$query='SELECT  id,
			userCode,
			isFollow,
			isContact,
			isAppoint,
			helpDescription,
			helpEffective,
			createDate
		FROM t_fillowlog WHERE userCode LIKE :userCode';
		$stmt = $this->conn->prepare($query);
		//$keyWord="%{$keyWord}%";
		$stmt->bindParam(':userCode',$userCode);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_fillowlog WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_fillowlog WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>