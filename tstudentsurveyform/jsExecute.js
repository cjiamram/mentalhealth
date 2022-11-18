var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
		var flag=true;
		return flag;
}
function displayData(){
		var url="tsurveyform/displayData.php?tableName=t_surveyform&dbName=dbquestionair&keyWord="+$("#txtSearch").val();
		$("#tblDisplay").load(url);
}
function createData(){
		var url='tsurveyform/create.php';
		jsonObj={
			userCode:$("#obj_userCode").val(),
			projectGroupId:$("#obj_projectGroupId").val(),
			contactPerson:$("#obj_contactPerson").val(),
			urgentTel:$("#obj_urgentTel").val(),
			telNo:$("#obj_telNo").val(),
			levelYear:$("#obj_levelYear").val(),
			faculty:$("#obj_faculty").val(),
			gender:$("#obj_gender").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function updateData(){
		var url='tsurveyform/update.php';
		jsonObj={
			userCode:$("#obj_userCode").val(),
			projectGroupId:$("#obj_projectGroupId").val(),
			contactPerson:$("#obj_contactPerson").val(),
			urgentTel:$("#obj_urgentTel").val(),
			telNo:$("#obj_telNo").val(),
			levelYear:$("#obj_levelYear").val(),
			faculty:$("#obj_faculty").val(),
			gender:$("#obj_gender").val(),
			id:$("#obj_id").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function readOne(id){
		var url='tsurveyform/readOne.php?id='+id;
		data=queryData(url);
		if(data!=""){
			$("#obj_userCode").val(data.userCode);
			$("#obj_projectGroupId").val(data.projectGroupId);
			$("#obj_contactPerson").val(data.contactPerson);
			$("#obj_urgentTel").val(data.urgentTel);
			$("#obj_telNo").val(data.telNo);
			$("#obj_levelYear").val(data.levelYear);
			$("#obj_faculty").val(data.faculty);
			$("#obj_gender").val(data.gender);
			$("#obj_id").val(data.id);
		}
}
function saveData(){
		var flag;
		flag=validInput();
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
			url="tsurveyform/delete.php?id="+id;
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
			$("#obj_userCode").val("");
			$("#obj_projectGroupId").val("");
			$("#obj_contactPerson").val("");
			$("#obj_urgentTel").val("");
			$("#obj_telNo").val("");
			$("#obj_levelYear").val("");
			$("#obj_faculty").val("");
			$("#obj_gender").val("");
}
function genCode(){
		//var url="genCode.php";
		//var data=queryData(url);
		//return data.code;
}
