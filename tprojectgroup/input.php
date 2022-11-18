<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tprojectgroup.php";
include_once "../objects/classLabel.php";
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
?>
<form role='form'>
<div class="box-body">
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_projectgroup","ProjectGroup","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_ProjectGroup' 
							placeholder='ProjectGroup'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_projectgroup","CreateDate","th").":" ?></label>
			<div class="col-sm-12">
				<div class="input-group date">
				<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
				</div>
				<input type="date" class="form-control" id="obj_CreateDate">
				</div>
			</div>
		</div>
		
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_projectgroup","Objective","th").":" ?></label>
			<div class="col-sm-12">
				<textarea class="form-control" id='obj_Objective'
				rows=3 cols=50
				></textarea>
				<!--<input type="text" 
							class="form-control" id='obj_Objective' 
							placeholder='Objective'>-->
			</div>
		</div>
</div>
</form>
