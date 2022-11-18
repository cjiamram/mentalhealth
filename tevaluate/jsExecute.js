var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
		var flag=true;
		flag=regDec.test($("#obj_burnouteRate").val());
		if (flag==false){
			$("#obj_burnouteRate").focus();
			return flag;
}
		flag=regDec.test($("#obj_strengthRate").val());
		if (flag==false){
			$("#obj_strengthRate").focus();
			return flag;
}
		flag=regDec.test($("#obj_stressRate").val());
		if (flag==false){
			$("#obj_stressRate").focus();
			return flag;
}
		flag=regDec.test($("#obj_suicideRate").val());
		if (flag==false){
			$("#obj_suicideRate").focus();
			return flag;
}
		flag=regDec.test($("#obj_defenseStressRate").val());
		if (flag==false){
			$("#obj_defenseStressRate").focus();
			return flag;
}
		return flag;
}
function displayData(){
		var url="tevaluate/displayData.php?tableName=t_evaluate&dbName=dbmentalhealth&keyWord="+$("#txtSearch").val();
		$("#tblDisplay").load(url);
}
function createData(){
		var url='tevaluate/create.php';
		jsonObj={
			userCode:$("#obj_userCode").val(),
			burnouteRate:$("#obj_burnouteRate").val(),
			burnouteGrade:$("#obj_burnouteGrade").val(),
			strengthRate:$("#obj_strengthRate").val(),
			strengthGrade:$("#obj_strengthGrade").val(),
			stressRate:$("#obj_stressRate").val(),
			stressGrade:$("#obj_stressGrade").val(),
			suicideRate:$("#obj_suicideRate").val(),
			suicideGrade:$("#obj_suicideGrade").val(),
			defenseStressRate:$("#obj_defenseStressRate").val(),
			defenseStressGrade:$("#obj_defenseStressGrade").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function updateData(){
		var url='tevaluate/update.php';
		jsonObj={
			userCode:$("#obj_userCode").val(),
			burnouteRate:$("#obj_burnouteRate").val(),
			burnouteGrade:$("#obj_burnouteGrade").val(),
			strengthRate:$("#obj_strengthRate").val(),
			strengthGrade:$("#obj_strengthGrade").val(),
			stressRate:$("#obj_stressRate").val(),
			stressGrade:$("#obj_stressGrade").val(),
			suicideRate:$("#obj_suicideRate").val(),
			suicideGrade:$("#obj_suicideGrade").val(),
			defenseStressRate:$("#obj_defenseStressRate").val(),
			defenseStressGrade:$("#obj_defenseStressGrade").val(),
			id:$("#obj_id").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function readOne(id){
		var url='tevaluate/readOne.php?id='+id;
		data=queryData(url);
		if(data!=""){
			$("#obj_userCode").val(data.userCode);
			$("#obj_burnouteRate").val(data.burnouteRate);
			$("#obj_burnouteGrade").val(data.burnouteGrade);
			$("#obj_strengthRate").val(data.strengthRate);
			$("#obj_strengthGrade").val(data.strengthGrade);
			$("#obj_stressRate").val(data.stressRate);
			$("#obj_stressGrade").val(data.stressGrade);
			$("#obj_suicideRate").val(data.suicideRate);
			$("#obj_suicideGrade").val(data.suicideGrade);
			$("#obj_defenseStressRate").val(data.defenseStressRate);
			$("#obj_defenseStressGrade").val(data.defenseStressGrade);
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
			url="tevaluate/delete.php?id="+id;
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
			$("#obj_burnouteRate").val("");
			$("#obj_burnouteGrade").val("");
			$("#obj_strengthRate").val("");
			$("#obj_strengthGrade").val("");
			$("#obj_stressRate").val("");
			$("#obj_stressGrade").val("");
			$("#obj_suicideRate").val("");
			$("#obj_suicideGrade").val("");
			$("#obj_defenseStressRate").val("");
			$("#obj_defenseStressGrade").val("");
}
function genCode(){
		//var url="genCode.php";
		//var data=queryData(url);
		//return data.code;
}
