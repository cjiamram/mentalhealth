<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tprojectgroupsub.php";
include_once "../objects/classLabel.php";
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
?>
<form role='form'>
<div class="box-body">
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_projectgroupsub","ProjectGroupId","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_ProjectGroupId' 
							placeholder='ProjectGroupId'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_projectgroupsub","ProjectId","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_ProjectId' 
							placeholder='ProjectId'>
			</div>
		</div>
</div>
</form>
