<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tsurveyform.php";
include_once "../objects/classLabel.php";
include_once "../config/config.php";
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
$cnf=new Config();
$rootPath=$cnf->path;
$userCode=isset($_SESSION["UserName"])?$_SESSION["UserName"]:"";
$fullName=isset($_SESSION["FullName"])?$_SESSION["FullName"]:"";
//print_r($userCode);

$projectGroupId=isset($_GET["projectGroupId"])?$_GET["projectGroupId"]:0;
$deparmentId=isset($_SESSION["DepartmentId"])?$_SESSION["DepartmentId"]:"";
//print_r($deparmentId);

?>

<div class="box box-warning">

<form role='form'>
<div class="box-body">
<input type="hidden"  id='obj_id' >
<input type="hidden" value="<?=$userCode?>" id='obj_userCode' >
<input type="hidden" value="<?=$projectGroupId?>" id='obj_projectGroupId' >
    
    <div class='form-group'>
      <label class="col-sm-12">ชื่อ-สกุล/<?php echo $objLbl->getLabel("t_surveyform","telNo","th").":" ?></label>
       <div class="col-sm-6">
        <label class="form-control"><?=$fullName?></label>
      </div>
      <div class="col-sm-6">
        <input type="text" 
              class="form-control" id='obj_telNo' 
              placeholder='โทรศัพท์'>
      </div>
     
    </div>
    <div class='form-group'>
      <label class="col-sm-12"><?php echo $objLbl->getLabel("t_surveyform","gender","th").":" ?></label>
      <div class="col-sm-6">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="obj_gender" id="obj_gender_1" value="1" checked >
          ชาย
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="obj_gender" id="obj_gender_2" value="2">
          หญิง
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="obj_gender" id="obj_gender_3" value="3">
          ไม่ระบุ
        </div>
      </div>
      
    </div>
    <div class='form-group'>
      <label class="col-sm-12"><?php echo $objLbl->getLabel("t_surveyform","contactPerson","th").":" ?>/<?php echo $objLbl->getLabel("t_surveyform","urgentTel","th").":" ?></label>
      <div class="col-sm-6">
        <input type="text" 
              class="form-control" id='obj_contactPerson' 
              placeholder='ชื่อผู้ติดต่อ'>
      </div>
      <div class="col-sm-6">
        <input type="text" 
              class="form-control" id='obj_urgentTel' 
              placeholder='เบอร์โทรศัพท์ผู้ติดต่อ'>
      </div>
  
    </div>
    <div class='form-group'>
      <label class="col-sm-12"><?php echo $objLbl->getLabel("t_surveyform","faculty","th").":" ?>/<?php echo $objLbl->getLabel("t_surveyform","levelYear","th").":" ?></label>
      
       <div class="col-sm-6">
          <select class="form-control" id='obj_faculty' ></select>
      </div>
      <div class="col-sm-2">

        <select class="form-control" id='obj_levelYear' >
          <option value="1">ชั้นปีที่ 1</option>
          <option value="2">ชั้นปีที่ 2</option>
          <option value="3">ชั้นปีที่ 3</option>
          <option value="4">ชั้นปีที่ 4</option>
        </select> 
      </div>
      <div class="col-sm-4">
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-sm-12">

      &nbsp;
    </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
              <a id="obj_logout" href="#" class="btn btn-warning pull-left"><i class="fa fa-sign-out"  aria-hidden="true"></i> ออกจากระบบ</a> 

      <button type='button' id="btnSave" class='btn btn-info'>
        <span class='fa fa-floppy-o'>บันทึก</span>
      </button>
    </div>
    </div>
</div>
</div>

</form>
<script>
  function setFaculty(){
      var url="<?=$rootPath?>/tdepartment/getFaculty.php";
      setDDLPrefix(url,"#obj_faculty","***เลือกคณะ***");
  }


  function createData(){

    var url='<?=$rootPath?>/tstudentsurveyform/create.php';
    jsonObj={
      userCode:$("#obj_userCode").val(),
      projectGroupId:$("#obj_projectGroupId").val(),
      contactPerson:$("#obj_contactPerson").val(),
      urgentTel:$("#obj_urgentTel").val(),
      telNo:$("#obj_telNo").val(),
      levelYear:$("#obj_levelYear").val(),
      faculty:$("#obj_faculty").val(),
      gender:$('input[name="obj_gender"]:checked').val()
    }
    var jsonData=JSON.stringify (jsonObj);
    //console.log(jsonData);
    var flag=executeData(url,jsonObj,false);
    return flag;
  }

  function updateData(){

    var url='<?=$rootPath?>/tstudentsurveyform/update.php';
    jsonObj={
      userCode:$("#obj_userCode").val(),
      projectGroupId:$("#obj_projectGroupId").val(),
      contactPerson:$("#obj_contactPerson").val(),
      urgentTel:$("#obj_urgentTel").val(),
      telNo:$("#obj_telNo").val(),
      levelYear:$("#obj_levelYear").val(),
      faculty:$("#obj_faculty").val(),
      gender:$('input[name="obj_gender"]:checked').val()
    }
    var jsonData=JSON.stringify (jsonObj);
    //console.log(jsonData);
    var flag=executeData(url,jsonObj,false);
    return flag;
  }


   function getIdExist(){
      var url="<?=$rootPath?>/tstudentsurveyform/getIdExist.php?userCode="+$("#obj_userCode").val();
      var data=queryData(url);
      return data;
    }

  function saveData(){
    var flag;
    flag=true;
    if(flag==true){

        data=getIdExist();
        
        if(data.flag===false){
          flag=createData();  
        }else
        { 
          $("#obj_id").val(data.id);
          flag=updateData();
          $("#obj_id").val("");
        }


    if(flag==true){
        swal.fire({
        title: "การบันทึกข้อมูลเสร็จสมบูรณ์แล้ว",
        type: "success",
        buttons: [false, "ปิด"],
        dangerMode: true,
      }).then(result=>{
         var url="<?=$rootPath?>/tsurveytransaction/deleteByUserCode.php?userCode="+$("#obj_userCode").val();
         data=executeGet(url);
         url="<?=$rootPath?>/tprojectgroup/genMentalHealth.php?projectGroupId="+$("#obj_projectGroupId").val()+"&userCode="+$("#obj_userCode").val();
         //console.log(url);
         $("#dvContent").load(url);
 
      });
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

  function renderQuestionair(){

  }

  $(document).ready(function(){
    setFaculty();
    $("#obj_faculty").val('<?=$deparmentId?>');

    $("#btnSave").click(function(){
        saveData();
    });

    $("#obj_logout").click(function(){
        
        var url="<?=$rootPath?>/logoutMentalHealth.php";
        console.log(url);
        $(location).attr('href', url);

      });
  });

</script>
