<?php
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		header("Access-Control-Allow-Methods: POST");
		header("Access-Control-Max-Age: 3600");
		header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
		include_once "../config/database.php";
		include_once "../objects/tquestionchoice.php";
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
		<input type="hidden" id='obj_choiceId'>

		
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_questionchoice","index","th").":" ?>/<?php echo $objLbl->getLabel("t_questionchoice","caption","th").":" ?></label>
			<div class="col-sm-2">
				<input type="text" 
							class="form-control" id='obj_indexNo' 
							placeholder='index'>
			</div>	
			<div class="col-sm-10">
				<input type="text" 
							class="form-control" id='obj_caption' 
							placeholder='caption'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_questionchoice","weight","th").":" ?></label>
			<div class="col-sm-2">
				<input type="text" 
							class="form-control" id='obj_weight' 
							placeholder='weight'>
			</div>
		</div>
		<div class='form-group'>&nbsp;
		</div>
		<div class='form-group'>
		   <div class="col-sm-12">
               <input type="button" id="btnChoiceSave" value="บันทึก"  class="btn btn-primary" >
          </div>
        </div>
        <div>&nbsp;</div>
        <div class="col-sm-12">
			<div class="box box-warning">
			<div class="box-header with-border">
			<h3 class="box-title"><b><?php echo $objLbl->getLabel("t_questionchoice","legend","th").":" ?></b></h3>
			</div>
			<table id="tblDisplayChoice" class="table table-bordered table-hover">
			</table>
			</div>  
			</div>


</div>
</form>

<script>
	

	 function createChoice(){
			var url='<?=$rootPath?>/tquestionchoice/create.php';
			var questionId=$("#obj_id").val();
			jsonObj={
				questionId:questionId,
				caption:$("#obj_caption").val(),
				weight:$("#obj_weight").val(),
				indexNo:$("#obj_indexNo").val()
			}
			var jsonData=JSON.stringify (jsonObj);
			//console.log(jsonData);
			var flag=executeData(url,jsonObj,false);
			return flag;
	}
	function updateChoice(){
			var url='<?=$rootPath?>/tquestionchoice/update.php';
			var questionId=$("#obj_id").val();
			jsonObj={
				questionId:questionId,
				caption:$("#obj_caption").val(),
				weight:$("#obj_weight").val(),
				indexNo:$("#obj_indexNo").val(),
				id:$("#obj_choiceId").val()
			}
			var jsonData=JSON.stringify (jsonObj);
			//console.log(jsonData);

			var flag=executeData(url,jsonObj,false);
			return flag;
	}
	function readOneChoice(id){
			var url='<?=$rootPath?>/tquestionchoice/readOne.php?id='+id;
			data=queryData(url);
			if(data!=""){
				$("#obj_id").val(data.questionId);
				$("#obj_caption").val(data.caption);
				$("#obj_weight").val(data.weight);
				$("#obj_indexNo").val(data.indexNo);
				$("#obj_choiceId").val(data.id);
			}
	}
	function saveChoice(){
			var flag;
			flag=true;
			if(flag==true){
				if($("#obj_choiceId").val()!=""){
					flag=updateChoice();
				}else{
					flag=createChoice();
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
	function confirmDeleteChoice(id){
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
				url="<?=$rootPath?>/tquestionchoice/delete.php?id="+id;
				executeGet(url,false,"");
				displayChoice();
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
		$("#obj_caption").val("");
		$("#obj_weight").val("");
		$("#obj_indexNo").val("");
	}


	$(document).ready(function(){
		displayChoice();
		$("#btnChoiceSave").click(function(){
			saveChoice();
			clearData();
		});
	});	

</script>