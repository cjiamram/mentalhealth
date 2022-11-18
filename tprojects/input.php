<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tprojects.php";
include_once "../objects/classLabel.php";
include_once "../config/config.php";
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
$cnf=new Config();
$rootPath=$cnf->path;
?>
<form role='form'>
<div class="box-body">
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_projects","ProjectName","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_ProjectName' 
							placeholder='ProjectName'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_projects","Description","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_Description' 
							placeholder='Description'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_projects","template","th").":" ?></label>
			<div class="col-sm-12">
				<select id="obj_template" class="form-control"></select>
			</div>
		</div>
		
</div>
</form>

<script>
	function listTemplate(){
		var url="<?=$rootPath?>/ttemplate/getData.php";
		setDDL(url,"#obj_template");
	}

	$(document).ready(function(){
		listTemplate();
	});

</script>
