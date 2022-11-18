var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
		var flag=true;
		{
			$("#obj_HeaderCaption").focus();
			return flag;
		}
		{
			$("#obj_ProjectCode").focus();
			return flag;
		}
		{
			$("#obj_Description").focus();
			return flag;
		}
		return flag;
}
function displayData(){
		var url="tqheader/displayData.php?tableName=t_qheader&dbName=dbquestionair&keyWord="+$("#txtSearch").val();
		$("#tblDisplay").load(url);
}
function createData(){
		var url='tqheader/create.php';
		jsonObj={
			HeaderCaption:$("#obj_HeaderCaption").val(),
			ProjectCode:$("#obj_ProjectCode").val(),
			Description:$("#obj_Description").val(),
			sChoiceNo:$("#obj_ChoiceNo").val(),

		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function updateData(){
		var url='tqheader/update.php';
		jsonObj={
			HeaderCaption:$("#obj_HeaderCaption").val(),
			ProjectCode:$("#obj_ProjectCode").val(),
			Description:$("#obj_Description").val(),
			ChoiceNo:$("#obj_ChoiceNo").val(),
			id:$("#obj_id").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function readOne(id){
		var url='tqheader/readOne.php?id='+id;
		data=queryData(url);
		if(data!=""){
			$("#obj_HeaderCaption").val(data.HeaderCaption);
			$("#obj_ProjectCode").val(data.ProjectCode);
			$("#obj_Description").val(data.Description);
			$("#obj_ChoiceNo").val(data.ChoiceNo);
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
			$("#obj_ProjectCode").val("");
			$("#obj_Description").val("");
}
function genCode(){
		//var url="genCode.php";
		//var data=queryData(url);
		//return data.code;
}
