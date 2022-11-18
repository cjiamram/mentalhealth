<?php
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		header("Access-Control-Allow-Methods: POST");
		header("Access-Control-Max-Age: 3600");
		header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
		include_once "../config/database.php";
		include_once "../objects/tfillowlog.php";
		include_once "../objects/classLabel.php";
		include_once "../config/config.php";
		$cnf=new Config();
		$rootPath=$cnf->path;
		$database = new Database();
		$db = $database->getConnection();
		$objLbl = new ClassLabel($db);
		$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";

?>

<form role='form'>
<div class="box-body">
	
		<input type="hidden" 
							value='<?=$userCode?>' id='obj_userCode' 
							>

		<div class='form-group'>
			<div class="col-sm-12">
				<input type="checkbox" 
							 id='obj_isFollow' 
							>&nbsp;<label><?php echo $objLbl->getLabel("t_fillowlog","isFollow","th").":" ?></label>
			</div>
		</div>
		<div class='form-group'>
			<div class="col-sm-12">
				<input type="checkbox" 
							 id='obj_isAppoint' 
							>&nbsp;<label><?php echo $objLbl->getLabel("t_fillowlog","isAppoint","th").":" ?></label>
			</div>
		</div>
	
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_fillowlog","helpDescription","th").":" ?></label>
			<div class="col-sm-12">

				<textarea class="form-control" id='obj_helpDescription' row="3" style="width:100%"></textarea>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_fillowlog","helpEffective","th").":" ?></label>
			<div class="col-sm-12">
		
				<textarea class="form-control" id='obj_helpEffective' row="3" style="width:100%"></textarea>
			</div>
		</div>
		
</div>
</form>

