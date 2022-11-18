<?php
	include_once "../config/config.php";
	include_once "../config/database.php";
	include_once "../objects/classLabel.php";


	$database = new Database();
	$db = $database->getConnection();
	$objLbl = new ClassLabel($db);
	$cnf=new Config();
	$rootPath=$cnf->path;
	$projectId=isset($_GET["projectId"])?$_GET["projectId"]:0;

?>
<input type="hidden"  id="obj_labelid">
<input type="hidden" 
id='obj_projectId' value='<?=$projectId?>' 
			>

<div class="box-body">
		
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_qlabel","choiceNo","th").":" ?>/<?php echo $objLbl->getLabel("t_qlabel","label","th").":" ?></label>
			<div class="col-sm-2">
				<input type="text" class="form-control" id='obj_choiceNo'>
			</div>
			<div class="col-sm-10">
				<input type="text" 
							class="form-control" id='obj_label' >
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_qlabel","weight","th").":" ?></label>
			<div class="col-sm-2">
				<input type="text" class="form-control" id='obj_Weight'>
			</div>
			<div class="col-sm-10">
				
			</div>
		</div>
		
		<div class='form-group'>&nbsp;
		</div>
		<div class='form-group'>
		   <div class="col-sm-12">
               <input type="button" id="btnLabelSave" value="บันทึก"  class="btn btn-primary" >
          </div>
        </div>


<div>&nbsp;</div>
<div class="col-sm-12">
<div class="box box-warning">
<div class="box-header with-border">
<h3 class="box-title"><b><?php echo $objLbl->getLabel("t_qlabel","legend","th").":" ?></b></h3>
</div>
<table id="tblDisplayLabel" class="table table-bordered table-hover">
</table>
</div>  
</div>
</div>

<script>

//***********************************************
function createLabelData(){
    var url='<?=$rootPath?>/tqlabel/create.php';
    jsonObj={
      projectId:$("#obj_projectId").val(),
      choiceNo:$("#obj_choiceNo").val(),
      weight:$("#obj_Weight").val(),
      label:$("#obj_label").val()
    }
    var jsonData=JSON.stringify (jsonObj);
    console.log(jsonData);
    var flag=executeData(url,jsonObj,false);
    return flag;
}
function updateLabelData(){
    var url='<?=$rootPath?>/tqlabel/update.php';
    jsonObj={
      projectId:$("#obj_projectId").val(),
      choiceNo:$("#obj_choiceNo").val(),
      label:$("#obj_label").val(),
      weight:$("#obj_Weight").val(),
      id:$("#obj_labelid").val()
    }
    var jsonData=JSON.stringify (jsonObj);
    var flag=executeData(url,jsonObj,false);
    return flag;
}
function readOneLabel(id){
    var url='<?=$rootPath?>/tqlabel/readOne.php?id='+id;
    data=queryData(url);
    if(data!=""){
      $("#obj_projectId").val(data.projectId);
      $("#obj_choiceNo").val(data.choiceNo);
      $("#obj_label").val(data.label);
      $("#obj_labelid").val(data.id);
      $("#obj_Weight").val(data.weight);
    }
}
function saveLabelData(){
    var flag;
    flag=true;
    if(flag==true){
          if($("#obj_id").val()!=""){
      flag=updateLabelData();
      }else{
      flag=createLabelData();
    }
    if(flag==true){
      swal.fire({
      title: "การบันทึกข้อมูลเสร็จสมบูรณ์แล้ว",
      type: "success",
      buttons: [false, "ปิด"],
      dangerMode: true,
    });
    displayLabelData();
    }
    else{
      swal.fire({
      title: "การบันทึกข้อมูลผิดพลาด",
      type: "error",
      buttons: [false, "ปิด"],
      dangerMode: true,
    });
    }
    }else{
      swal.fire({
      title: "รูปแบบการกรอกข้อมูลไม่ถูกต้อง",
      type: "error",
      buttons: [false, "ปิด"],
      dangerMode: true,
      });
      }
}

function displayLabelData(){
    var url="<?=$rootPath?>/tqlabel/displayData.php?projectId=<?=$projectId?>";
    //console.log(url);
    $("#tblDisplayLabel").load(url);
}
function confirmLabelDelete(id){
    swal.fire({
      title: "คุณต้องการที่จะลบข้อมูลนี้หรือไม่?",
      text: "***กรุณาตรวจสอบข้อมูลให้ครบถ้วนก่อนกดปุ่มตกลง",
      type: "warning",
      confirmButtonText: "ตกลง",
      cancelButtonText: "ยกเลิก",
      showCancelButton: true,
      showConfirmButton: true
    }).then((willDelete) => {
    if (willDelete.value) {
      url="<?=$rootPath?>/tqlabel/delete.php?id="+id;
      executeGet(url,false,"");
      displayLabelData();
    swal.fire({
      title: "ลบข้อมูลเรียบร้อยแล้ว",
      type: "success",
      buttons: "ตกลง",
    });
    } else {
      swal.fire({
      title: "ยกเลิกการทำรายการ",
      type: "error",
      buttons: [false, "ปิด"],
      dangerMode: true,
    })
    }
    });
}
function clearLabelData(){
      $("#obj_projectId").val("");
      $("#obj_choiceNo").val("");
      $("#obj_label").val("");
}


 //***********************************************

$(document).ready(function(){
	displayLabelData();
	$("#btnLabelSave").click(function(){
      saveLabelData();
    });
});

</script>

