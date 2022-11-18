<?php
include_once "keyWord.php";
class  tevaluate{
	private $conn;
	private $table_name="t_evaluate";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $userCode;
	public $burnouteRate;
	public $burnouteGrade;
	public $strengthRate;
	public $strengthGrade;
	public $stressRate;
	public $stressGrade;
	public $suicideRate;
	public $suicideGrade;
	public $defenseStressRate;
	public $defenseStressGrade;
	public $depressRate;
	public $depressGrade;


	public function isExist($userCode){
		$query="SELECT id FROM t_evaluate WHERE userCode=:userCode";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		$flag=$stmt->rowCount()>0?true:false;
		return $flag;
	}

	public function getId($userCode){
		$query="SELECT id FROM t_evaluate WHERE userCode=:userCode";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			return $id;
		}
		return 0;
	}

	public function create(){
		$query='INSERT INTO t_evaluate  
        	SET 
			userCode=:userCode,
			burnouteRate=:burnouteRate,
			burnouteGrade=:burnouteGrade,
			strengthRate=:strengthRate,
			strengthGrade=:strengthGrade,
			stressRate=:stressRate,
			stressGrade=:stressGrade,
			suicideRate=:suicideRate,
			suicideGrade=:suicideGrade,
			defenseStressRate=:defenseStressRate,
			defenseStressGrade=:defenseStressGrade,
			depressRate=:depressRate,
			depressGrade=:depressGrade
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":burnouteRate",$this->burnouteRate);
		$stmt->bindParam(":burnouteGrade",$this->burnouteGrade);
		$stmt->bindParam(":strengthRate",$this->strengthRate);
		$stmt->bindParam(":strengthGrade",$this->strengthGrade);
		$stmt->bindParam(":stressRate",$this->stressRate);
		$stmt->bindParam(":stressGrade",$this->stressGrade);
		$stmt->bindParam(":suicideRate",$this->suicideRate);
		$stmt->bindParam(":suicideGrade",$this->suicideGrade);
		$stmt->bindParam(":defenseStressRate",$this->defenseStressRate);
		$stmt->bindParam(":defenseStressGrade",$this->defenseStressGrade);
		$stmt->bindParam(":depressRate",$this->depressRate);
		$stmt->bindParam(":depressGrade",$this->depressGrade);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_evaluate 
        	SET 
			userCode=:userCode,
			burnouteRate=:burnouteRate,
			burnouteGrade=:burnouteGrade,
			strengthRate=:strengthRate,
			strengthGrade=:strengthGrade,
			stressRate=:stressRate,
			stressGrade=:stressGrade,
			suicideRate=:suicideRate,
			suicideGrade=:suicideGrade,
			defenseStressRate=:defenseStressRate,
			defenseStressGrade=:defenseStressGrade,
			depressRate=:depressRate,
			depressGrade=:depressGrade
		 WHERE userCode=:userCode';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":burnouteRate",$this->burnouteRate);
		$stmt->bindParam(":burnouteGrade",$this->burnouteGrade);
		$stmt->bindParam(":strengthRate",$this->strengthRate);
		$stmt->bindParam(":strengthGrade",$this->strengthGrade);
		$stmt->bindParam(":stressRate",$this->stressRate);
		$stmt->bindParam(":stressGrade",$this->stressGrade);
		$stmt->bindParam(":suicideRate",$this->suicideRate);
		$stmt->bindParam(":suicideGrade",$this->suicideGrade);
		$stmt->bindParam(":defenseStressRate",$this->defenseStressRate);
		$stmt->bindParam(":defenseStressGrade",$this->defenseStressGrade);
		$stmt->bindParam(":depressRate",$this->depressRate);
		$stmt->bindParam(":depressGrade",$this->depressGrade);

		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			userCode,
			burnouteRate,
			burnouteGrade,
			strengthRate,
			strengthGrade,
			stressRate,
			stressGrade,
			suicideRate,
			suicideGrade,
			defenseStressRate,
			defenseStressGrade,
			depressRate,
			depressGrade
		FROM t_evaluate WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
		$key=KeyWord::getKeyWord($this->conn,$this->table_name);
		$key=($key!="")?$key:"keyWord";
		$query='SELECT  id,
			userCode,
			burnouteRate,
			burnouteGrade,
			strengthRate,
			strengthGrade,
			stressRate,
			stressGrade,
			suicideRate,
			suicideGrade,
			defenseStressRate,
			defenseStressGrade
		FROM t_evaluate WHERE '.$key.' LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_evaluate WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_evaluate WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>