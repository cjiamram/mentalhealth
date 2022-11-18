<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tstaffsurveyform.php";
include_once "../objects/classLabel.php";
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
?>
<form role='form'>
<div class="box-body">
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_staffsurveyform","userCode","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_userCode' 
							placeholder='userCode'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_staffsurveyform","projectGroupId","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_projectGroupId' 
							placeholder='projectGroupId'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_staffsurveyform","contactPerson","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_contactPerson' 
							placeholder='contactPerson'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_staffsurveyform","urgentTel","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_urgentTel' 
							placeholder='urgentTel'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_staffsurveyform","telNo","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_telNo' 
							placeholder='telNo'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_staffsurveyform","staffType","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_staffType' 
							placeholder='staffType'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_staffsurveyform","department","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_department' 
							placeholder='department'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_staffsurveyform","age","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_age' 
							placeholder='age'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_staffsurveyform","gender","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_gender' 
							placeholder='gender'>
			</div>
		</div>
</div>
</form>
