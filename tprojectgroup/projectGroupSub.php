<?php
header("content-type:application/json;charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/tprojectgroupsub.php";
include_once "../config/config.php";

$database=new Database();
$db=$database->getConnection();
$obj=new tprojectgroupsub($db);
$cnf=new Config();
$rootPath=$cnf->path;



?>
<input type="hidden" id="obj_projectGroupId">
<form role='form'>
<table width="100%">
<tr>
<td width='50%' valign='top'>
		<div class="box box-warning">
		<div class="box-header with-border">
		<h3 class="box-title"><b>เลือกหัวข้อแบบสอบถาม</b></h3>
		</div>
		<table id="tblTopic" width="100%" class="table table-bordered">

		</table>	
		</div> 
</td>
<td width='50%' valign='top'>
		<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title"><b>หัวข้อแบบสอบถาม</b></h3>
		</div>
		<table id="tblTopicSub" width="100%" class="table table-bordered">

		</table>
		</div>
</td>
</tr>
</table>
 

</form>

<script>


	function displayTopic(){
		var url="<?=$rootPath?>/tprojects/chooseTopic.php?projectGroupId="+$("#obj_ProjectGroup").val();
		$("#tblTopic").load(url);
	}
	function displayProjectGroupSub(){
		var url="<?=$rootPath?>/tprojectgroupsub/displayData.php?projectGroupId="+$("#obj_ProjectGroup").val(); 
		$("#tblTopicSub").load(url);
	}

	function chooseOne(topicid){

		  var url="<?=$rootPath?>/tprojectgroupsub/create.php";
		  var jsonObj={
		      ProjectGroupId:$("#obj_ProjectGroup").val(),
		      ProjectId:topicid
  			}

		  var jsonData=JSON.stringify (jsonObj);
		  //console.log(jsonData);
		  var flag=executeData(url,jsonObj,false);
		  displayTopic();
		  displayProjectGroupSub();
		  return flag;
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
			url="<?=$rootPath?>/tprojectgroupsub/delete.php?id="+id;
			executeGet(url,false,"");

			displayTopic();
			displayProjectGroupSub();
			
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



	


	$(document).ready(function(){
		displayTopic();
		displayProjectGroupSub();
	});


</script>
