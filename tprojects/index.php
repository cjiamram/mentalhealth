<?php
      include_once '../config/database.php';
      include_once '../config/config.php';
      include_once '../objects/classLabel.php';
      $cnf=new Config();
      $rootPath=$cnf->path; 
      $database = new Database();
      $db = $database->getConnection();
      $objLbl=new ClassLabel($db);

?>
<input type="hidden" id="obj_id" value="">
<section class="content-header">
     <h1>
        <b>ระบบการสร้างแบบสอบถาม Online</b>

        <small>>>หัวข้อแบบสอบถาม</small>
      </h1>
      <ol class="breadcrumb">
   
        <table width="40%" cellspacing="2" cellpading="2">
          <tr>
            <td width="100%" align="center">
                <input type="button" id="btnInput"   class="btn btn-primary col-sm-12" data-toggle="modal" data-target="#modal-input" value="สร้าง">
            </td>
            <!--<td width="60%" align="center">
                <input type="button" id="btnSearch"  class="btn btn-success col-sm-12" data-toggle="modal" data-target="#modal-search" value="ค้นหาข้นสูง">
             </td>-->
          </tr>
        </table>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box"></div>
        <div class="form-group">
          <div class="col-sm-12">
             <div class="col-sm-6">
               <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-search"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="txtSearch">
                </div>
             </div>
             <div>
              <div  class="col-sm-4">
              </div>
          </div>
          </div>
        </div>

      <div>&nbsp;</div>
      <div class="col-sm-12">
      <div class="box box-warning">
      <div class="box-header with-border">
      <h3 class="box-title"><b>รายการหัวข้อแบบสอบถาม</b></h3>
      </div>
      <table id="tblDisplay" class="table table-bordered table-hover">
      </table>
      </div>  
      </div>
        
    </section>


   <div class="modal fade" id="modal-input">
     <div class="modal-dialog" id="dvInput" >
      <div class="modal-content">
          <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">หัวข้อแบบสอบถาม</h4>
           </div>
           <div class="modal-body" id="dvInputBody">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnClose" value="ปิด"  class="btn btn-default pull-left" data-dismiss="modal">
                    <input type="button" id="btnSave" value="บันทึก"  class="btn btn-primary" data-dismiss="modal">
                  </div>
          </div>
      </div>
     </div>
   </div>

     <div class="modal fade" id="modal-label">
        <div class="modal-dialog" style="width:700px" >
           <div class="modal-content">
            <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">คำอธิบาย</h4>
           </div>
           <div class="modal-body" id="dvLabel">
           
           </div>
        
        </div>
     </div>
   </div>
<script src="<?=$rootPath?>/tprojects/jsExecute.js"></script>
<script>
 
 function loadInput(){
      var url="<?=$rootPath?>/tprojects/input.php";
      $("#dvInputBody").load(url);
 }

 function readOne(id){
    var url='tprojects/readOne.php?id='+id;
    data=queryData(url);
    if(data!=""){
      $("#obj_ProjectName").val(data.ProjectName);
      $("#obj_Description").val(data.Description);
      $("#obj_template").val(data.template);
      $("#obj_id").val(id);
    }
}

function createLabel(id){
  var url="<?=$rootPath?>/tqlabel/createLabel.php?projectId="+id;
  $("#dvLabel").load(url);
}

function createData(){
    var url='<?=$rootPath?>/tprojects/create.php';
    jsonObj={
      ProjectName:$("#obj_ProjectName").val(),
      Description:$("#obj_Description").val(),
      template:$("#obj_template").val()
    
    }
    var jsonData=JSON.stringify (jsonObj);
    //console.log(jsonData);
    var flag=executeData(url,jsonObj,false);
    return flag;
}
function updateData(){
    var url='<?=$rootPath?>/tprojects/update.php';
    jsonObj={
      ProjectName:$("#obj_ProjectName").val(),
      Description:$("#obj_Description").val(),
      template:$("#obj_template").val(),
      id:$("#obj_id").val()
    }
    var jsonData=JSON.stringify (jsonObj);
    var flag=executeData(url,jsonObj,false);
    return flag;
}

function saveData(){
    var flag;
    flag=true;

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


function displayData(){
    var url="<?=$rootPath?>/tprojects/displayData.php?keyWord="+$("#txtSearch").val();
    $("#tblDisplay").load(url);
 }

 function loadPage(){
    loadInput();
    displayData();
 }

 $( document ).ready(function() {
    loadPage();
    $("#btnInput").click(function(){
        clearData();
        $("#obj_code").val(genCode());
    });

    $("#txtSearch").change(function(){
        displayData();
    });

    $("#btnSave").click(function(){
        saveData();
    });
 });

</script>
