<?php
header("Access-Control-Allow-Origin: *");
include_once "../config/database.php";
include_once "../objects/classLabel.php";
include_once "../config/config.php";


$database=new Database();
$db= $database->getConnection();
$objLbl=new ClassLabel($db);
$cnf=new Config();
$rootPath=$cnf->path;


?>
<link rel="stylesheet" href="<?=$rootPath?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script src="<?=$rootPath?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$rootPath?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<section class="content-header">

<input type="hidden" id="obj_id">
<div class="box box-warning">
<div class="box-header with-border">
      <h3 class="box-title"><b>
      	<?php echo $objLbl->getLabel("t_qheader","Create Question","th").":" ?></b></h3>
 </div>
 <div>
 	<form role='form'>
<div class="box-body">
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_qheader","ProjectCode","th").":" ?></label>
			<div class="col-sm-12">

				<select class="form-control" id="obj_ProjectCode" ></select>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_qheader","HeaderCaption","th").":" ?></label>
			<div class="col-sm-12">
				<table width="100%">
					<tr>
					<td width="80px">
						<input type="text" 
							class="form-control" id='obj_QuestionNo' 
							placeholder='No'>
					</td>
					<td width="10px" align="center">-
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
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_qheader","Description","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_Description' 
							placeholder='Description'>
			</div>
		</div>

		<div class='form-group'>
			
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_qheader","Qtype","th").":" ?>/<?php echo $objLbl->getLabel("t_qheader","ChoiceNo","th").":" ?></label>
			<div class="col-sm-3">
			<select class="form-control" id="obj_Qtype"></select>
			</div>
			<div class="col-sm-1">
				<input type="text" 
							class="form-control" value="5" id='obj_ChoiceNo' 
							placeholder='จำนวนคำตอบ'>
			</div>
				<div class="col-sm-8">&nbsp;
				</div>
			
		</div>
				<div class='form-group'>
			
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_qheader","uniform","th").":" ?></label>
			
			  <div class="col-sm-6">
		        <div class="form-check">
		        <input class="form-check-input" type="radio" name="obj_uniform" id="obj_uniform_1" value="1" checked >
		          เท่าเทียม
		        </div>
		        <div class="form-check">
		        <input class="form-check-input" type="radio" name="obj_uniform" id="obj_uniform_2" value="0">
		          ไม่เท่าเทียม
		        </div>
      
      </div>
			<div class="col-sm-6">&nbsp;
			</div>
			
		</div>

		<div class='form-group'>
			<div class="col-sm-12">
		       <input type="button" id="btnSave" 
		       value="บันทึก"  
		       class="btn btn-success" >
		       <input type="button" id="btnNew" 
		       value="เพิ่ม"  
		       class="btn btn-primary" >
	   		</div>

		</div>	
</div>
</form>
</div>


</div>

<div class="box box-primary">
<div id="dvDisplay">
  	  <table id="tblDisplay" class="table table-bordered table-hover">
      </table>
</div>
</div> 

</section>

<div class="modal fade" id="modal-createChoice">
     <div class="modal-dialog"  >
      <div class="modal-content">
          <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">สร้างตัวเลือกแบบสอบถาม</h4>
           </div>
           <div class="modal-body" id="dvChoice">
           
           </div>
        
     </div>
   </div>

<script>

function displayChoice(){

		var url="<?=$rootPath?>/tquestionchoice/displayData.php?questionId="+$("#obj_id").val();
		$("#tblDisplayChoice").load(url);	
}

function displayData(){
		var url="tqheader/displayData.php?tableName=t_qheader&dbName=dbquestionair&ProjectCode="+$("#obj_ProjectCode").val();
		$("#tblDisplay").load(url);
}

 function popupChoice(id){
 	$("#modal-createChoice").modal("toggle");
 	$("#obj_id").val(id);
    var url="<?=$rootPath?>/tquestionchoice/createQuestionChoice.php";
    $("#dvChoice").load(url);
    displayChoice();

 }


function getRadioVal(formId, name) {
    var val;
    // get list of radio buttons with specified name
    var radios = document.getElementsByName(name);
    
    // loop through list of radio buttons
    for (var i=0, len=radios.length; i<len; i++) {
        if ( radios[i].checked ) { // radio checked?
            val = radios[i].value; // if so, hold its value in val
            break; // and break out of for loop
        }
    }
    return val; // return value of checked radio or undefined if none checked
}
	
function createData(){
		var url='tqheader/create.php';
		jsonObj={
			QuestionNo:$("#obj_QuestionNo").val(),
			HeaderCaption:$("#obj_HeaderCaption").val(),
			ProjectCode:$("#obj_ProjectCode").val(),
			Description:$("#obj_Description").val(),
			Qtype:$("#obj_Qtype").val(),
			ChoiceNo:$("#obj_ChoiceNo").val(),
			uniform:$('input[name="obj_uniform"]:checked').val()

		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function updateData(){
		var url='tqheader/update.php';
		

		jsonObj={
			QuestionNo:$("#obj_QuestionNo").val(),
			HeaderCaption:$("#obj_HeaderCaption").val(),
			ProjectCode:$("#obj_ProjectCode").val(),
			Description:$("#obj_Description").val(),
			Qtype:$("#obj_Qtype").val(),
			ChoiceNo:$("#obj_ChoiceNo").val(),
			id:$("#obj_id").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		//console.log(jsonData);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function readOne(id){
		var url='tqheader/readOne.php?id='+id;
		data=queryData(url);
		if(data!=""){
			$("#obj_QuestionNo").val(data.QuestionNo);
			$("#obj_HeaderCaption").val(data.HeaderCaption);
			$("#obj_ProjectCode").val(data.ProjectCode);
			$("#obj_Description").val(data.Description);
			$("#obj_Qtype").val(data.Qtype);
			$("#obj_ChoiceNo").val(data.ChoiceNo);
			switch(data.uniform){
		        case 1:
		            $("#obj_uniform_1").attr("checked",true);
		            break;
		        case 0:
		            $("#obj_uniform_2").attr("checked",true);
		            break;
		      }
			$("#obj_id").val(data.id);
		}
}
function saveData(){
		var flag=true;
		if(flag==true){
					if($("#obj_id").val()!=""){
			flag=updateData();
			}else{
			flag=createData();
		}
		if(flag==true){
			swal.fire({
			title: "การบันทึกข้อมูลเสร็จสมบูรณ์แล้ว",
			type: "success",
			buttons: [false, "ปิด"],
			dangerMode: true,
		});
		displayData();
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
function confirmDelete(id){
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
			url="tqheader/delete.php?id="+id;
			executeGet(url,false,"");
			displayData();
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
function clearData(){
			$("#obj_HeaderCaption").val("");
			$("#obj_Description").val("");
			$("#obj_id").val("");
			$("#obj_ChoiceNo").val(5);
			jQuery("input[name='obj_Qtype']").val(1);

}

function listProject(){
	var url="<?=$rootPath?>/tprojects/listProject.php";
	setDDLPrefix(url,"#obj_ProjectCode","***หัวข้อแบบสอบถาม***");
}

function listQtype(){
	var url="<?=$rootPath?>/tquestiontype/getData.php";
	setDDLPrefix(url,"#obj_Qtype","***ประเภทแบบสอบถาม***");
}


$(document).ready(function(){
	listProject();
	displayData();
	listQtype();

	$("#obj_ProjectCode").change(function(){
		displayData();
	});

	$("#btnSave").click(function(){
		saveData();
		$("#modal-input").modal("hide");
	});

	$("#btnNew").click(function(){
		clearData();
		var v =$("#obj_QuestionNo").val()===""?1:parseInt($("#obj_QuestionNo").val())+1;
		$("#obj_QuestionNo").val(v);
	});

	$(".close").click(function(){
		$("#modal-createChoice").modal("hide");
		$("#modal-input").modal("hide");
	});



	
})
</script>