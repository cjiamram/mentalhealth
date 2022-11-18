<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tsuggestion.php";
include_once "../objects/classLabel.php";
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
?>
<form role='form'>
<div class="box-body">
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_suggestion","projectId","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_projectId' 
							placeholder='projectId'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_suggestion","suggestion","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_suggestion' 
							placeholder='suggestion'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_suggestion","keyIndex","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_keyIndex' 
							placeholder='keyIndex'>
			</div>
		</div>
</div>
</form>
