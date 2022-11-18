<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tqheader.php";
include_once "../objects/classLabel.php";
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
?>
<form role='form'>
<div class="box-body">
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_qheader","HeaderCaption","th").":" ?></label>
			<div class="col-sm-12">
				<table width="100%">
					<tr>
					<td width="70px">
						<input type="text" 
							class="form-control" id='obj_QuestionNo' 
							placeholder='No'>
					</td>
					<td>
						<input type="text" 
							class="form-control" id='obj_HeaderCaption' 
							placeholder='HeaderCaption'>
					</td>
					</tr>
				</table>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_qheader","ProjectCode","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_ProjectCode' 
							placeholder='ProjectCode'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_qheader","Description","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_Description' 
							placeholder='Description'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_qheader","ChoiceNo","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" value="5" id='obj_ChoiceNo' 
							placeholder='จำนวนคำตอบ'>
			</div>
		</div>
</div>
</form>
