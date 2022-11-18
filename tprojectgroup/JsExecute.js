var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
		var flag=true;
		
		
		{
			$("#obj_ProjectGroup").focus();
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
			$("#obj_Owner").focus();
			return flag;
		}
		{
			$("#obj_Objective").focus();
			return flag;
		}
		return flag;
}
function displayData(){
		var url="tprojectgroup/displayData.php?tableName=t_projectgroup&dbName=dbquestionair&keyWord="+$("#txtSearch").val();
		$("#tblDisplay").load(url);
}

function clearData(){
			$("#obj_ProjectGroup").val("");
			$("#obj_CreateDate").val("");
			$("#obj_Owner").val("");
			$("#obj_Objective").val("");
}
function genCode(){
		//var url="genCode.php";
		//var data=queryData(url);
		//return data.code;
}
