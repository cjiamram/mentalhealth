<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../config/config.php";
	include_once "../objects/classLabel.php";
	$database=new Database();
	$db=$database->getConnection();
	$objLbl=new ClassLabel($db);
	$cnf=new Config();
	$rootPath=$cnf->path;
?>
  <script src="<?=$rootPath?>/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?=$rootPath?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<section class="content-header">
<div class="box box-warning">
	<div class="box-header with-border">
      <h3 class="box-title"><b>เลือกกลุ่มทำแบบสอบถาม</b>
      </h3>
 	</div>
 		<div class="box-body">
		<div class='form-group'>
		<label class="col-sm-12"><?php echo $objLbl->getLabel("t_projectgroup","ProjectGroup","th").":" ?></label>
		<table width="60%">
		<tr>
			<td width="200px">
				<select id="obj_projectGroup" class="form-control"></select>
			</td>
			<td width="10px">-</td>
			<td width="150px">
				<select id="obj_template" class="form-control">
					<!--<option value='1'>Template 1</option>
					<option value='2'>Template 2</option>-->
				</select>
			</td>
			<td width="5px">&nbsp;
			</td>
			<td width="100px">
			<input type="button" id="btnGenQR" value="Generate QR"  class="btn btn-primary">

			</td>
			
		</tr>

		</table>
		</div>
		
	</div>
</div>
</section>
<div id="dvSimQuestionair"></div>


  <div class="modal fade" id="modal-QR">
     <div class="modal-dialog"  >
      <div class="modal-content">
          <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Generate QR</h4>
           </div>
           <div class="modal-body" id="dvQR">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnClose" value="ปิด"  class="btn btn-default pull-left" data-dismiss="modal">
                  </div>
          </div>
      </div>
     </div>
   </div>
<script>

function listProjectGroup(){
	var url="<?=$rootPath?>/tprojectgroup/listProjectGroup.php";
	setDDLPrefix(url,"#obj_projectGroup","***โครงการ***");
}

function listTemplate(){
	var url="<?=$rootPath?>/ttemplate/getData.php";
	setDDL(url,"#obj_template");
}

function generateQR(){
	$("#modal-QR").modal("toggle");
	var url="<?=$rootPath?>/tprojectgroup/generateQR.php?projectGroupId="+$("#obj_projectGroup").val();
	$("#dvQR").load(url);
}

function getURL(option){
	var url="";
		switch(option){
			case "1":
				url="<?=$rootPath?>/tprojectgroup/simQuestionairProject.php?projectGroupId="+$("#obj_projectGroup").val();
				break;
			case "2":
				url="<?=$rootPath?>/tprojectgroup/simQuestionairProject_1.php?projectGroupId="+$("#obj_projectGroup").val();
				break;
			case "3":
				url="<?=$rootPath?>/tprojectgroup/simQuestionairProject_2.php?projectGroupId="+$("#obj_projectGroup").val();
				break;
			default:
				url="<?=$rootPath?>/tprojectgroup/simQuestionairProject.php?projectGroupId="+$("#obj_projectGroup").val();
				break;

		}
	return url;
}


$(document).ready(function(){
	listProjectGroup();
	listTemplate();

	$("#obj_projectGroup").change(function(){
		var option=$("#obj_template").val();
		var url =getURL(option);
		$("#dvSimQuestionair").load(url);
	});

	$("#obj_template").change(function(){
		var option=$("#obj_template").val();
		var url =getURL(option);
		$("#dvSimQuestionair").load(url);
	});

	$("#btnGenQR").click(function(){
		generateQR();
	});
});
</script>