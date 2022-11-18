var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
		var flag=true;
		{
			$("#obj_ProjectCode").focus();
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
		flag=regDec.test($("#obj_Score").val());
		if (flag==false){
			$("#obj_Score").focus();
			return flag;
}
		{
			$("#obj_Score").focus();
			return flag;
		}
		{
			$("#obj_QuestId").focus();
			return flag;
		}
		{
			$("#obj_StudentCode").focus();
			return flag;
		}
		return flag;
}
function displayData(){
		var url="tsurveytransaction/displayData.php?tableName=t_surveytransaction&dbName=dbquestionair&keyWord="+$("#txtSearch").val();
		$("#tblDisplay").load(url);
}
function createData(){
		var url='tsurveytransaction/create.php';
		jsonObj={
			ProjectCode:$("#obj_ProjectCode").val(),
			CreateDate:$("#obj_CreateDate").val(),
			Score:$("#obj_Score").val(),
			QuestId:$("#obj_QuestId").val(),
			StudentCode:$("#obj_StudentCode").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function updateData(){
		var url='tsurveytransaction/update.php';
		jsonObj={
			ProjectCode:$("#obj_ProjectCode").val(),
			CreateDate:$("#obj_CreateDate").val(),
			Score:$("#obj_Score").val(),
			QuestId:$("#obj_QuestId").val(),
			StudentCode:$("#obj_StudentCode").val(),
			id:$("#obj_id").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function readOne(id){
		var url='tsurveytransaction/readOne.php?id='+id;
		data=queryData(url);
		if(data!=""){
			$("#obj_ProjectCode").val(data.ProjectCode);
			$("#obj_CreateDate").val(data.CreateDate);
			$("#obj_Score").val(data.Score);
			$("#obj_QuestId").val(data.QuestId);
			$("#obj_StudentCode").val(data.StudentCode);
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
			url="tsurveytransaction/delete.php?id="+id;
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
			$("#obj_ProjectCode").val("");
			$("#obj_CreateDate").val("");
			$("#obj_Score").val("");
			$("#obj_QuestId").val("");
			$("#obj_StudentCode").val("");
}
function genCode(){
		//var url="genCode.php";
		//var data=queryData(url);
		//return data.code;
}
