var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
		var flag=true;
		{
			$("#obj_ProjectName").focus();
			return flag;
		}
		{
			$("#obj_Description").focus();
			return flag;
		}
		{
			$("#obj_CreateDate").focus();
			return flag;
		}
		flag=regDate.test($("#obj_CreateDate").val());
		if (flag==false){
				$("#obj_CreateDate").focus();
				return flag;
		}
		{
			$("#obj_CreateBy").focus();
			return flag;
		}
		return flag;
}
function displayData(){
		var url="tprojects/displayData.php?tableName=t_projects&dbName=dbquestionair&keyWord="+$("#txtSearch").val();
		$("#tblDisplay").load(url);
}
/*function createData(){
		var url='tprojects/create.php';
		jsonObj={
			ProjectName:$("#obj_ProjectName").val(),
			Description:$("#obj_Description").val()
		
		}
		var jsonData=JSON.stringify (jsonObj);
		console.log(jsonData);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function updateData(){
		var url='tprojects/update.php';
		jsonObj={
			ProjectName:$("#obj_ProjectName").val(),
			Description:$("#obj_Description").val(),
			id:$("#obj_id").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		console.log(jsonData);
		var flag=executeData(url,jsonObj,false);
		return flag;
}*/
/*function readOne(id){
		var url='tprojects/readOne.php?id='+id;
		console.log(url);
		data=queryData(url);
		console.log(data);
		if(data!=""){
			$("#obj_ProjectName").val(data.ProjectName);
			$("#obj_Description").val(data.Description);
			//$("#obj_CreateDate").val(data.CreateDate);
			//$("#obj_CreateBy").val(data.CreateBy);
			$("#obj_id").val(id);
			console.log($("#obj_id").val());
		}
}*/
/*function saveData(){
		var flag;
		flag=true;
		console.log($("#obj_id").val());
		//console.log("xxxxx");
		//flag=validInput();

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
}*/
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
			url="tprojects/delete.php?id="+id;
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
			$("#obj_ProjectName").val("");
			$("#obj_Description").val("");
			$("#obj_CreateDate").val("");
			$("#obj_CreateBy").val("");
}
function genCode(){
		//var url="genCode.php";
		//var data=queryData(url);
		//return data.code;
}
