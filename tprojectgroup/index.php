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
<script src="<?=$rootPath?>/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?=$rootPath?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<input type="hidden" id="obj_id" value="">
<section class="content-header">
     <h1>
        <b>ระบบการสร้างแบบสอบถาม Online</b>

        <small>>>โครงการ</small>
      </h1>
      <ol class="breadcrumb">
   
        <table width="40%" cellspacing="2" cellpading="2">
          <tr>
            <td width="100%" align="center">
                <input type="button" id="btnInput"   class="btn btn-primary col-sm-12" data-toggle="modal" data-target="#modal-input" value="สร้าง">
            </td>
            
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
      <h3 class="box-title"><b>รายการโครงการ</b></h3>
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
                <h4 class="modal-title">กำหนดโครงการ</h4>
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

     <div class="modal fade" id="modal-groupSub">
        <div class="modal-dialog" style="width:900px">
           <div class="modal-content">
            <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">จัดกลุ่มแบบสอบถาม</h4>
           </div>
           <div class="modal-body" id="dvChooseTopic">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnChooseClose" value="ปิด"  class="btn btn-default pull-left" data-dismiss="modal">
                  </div>
           </div>
        </div>
     </div>
   </div>
<script src="<?=$rootPath?>/tprojectgroup/jsExecute.js"></script>
<script>

 function loadInput(){
      var url="<?=$rootPath?>/tprojectgroup/input.php";
      $("#dvInputBody").load(url);
 }

function chooseTopic(projectGroupId){

    var url="<?=$rootPath?>/tprojectgroup/projectGroupSub.php?projectGroupId="+projectGroupId;    
    $("#dvChooseTopic").load(url);
    $("#obj_ProjectGroup").val(projectGroupId);
}



function displayData(){
 
    var url="<?=$rootPath?>/tprojectgroup/displayData.php?keyWord="+$("#txtSearch").val();
    $("#tblDisplay").load(url);
 }

 function readOne(id){
    var url='<?=$rootPath?>/tprojectgroup/readOne.php?id='+id;
    data=queryData(url);
    if(data!=""){
      $("#obj_ProjectGroup").val(data.ProjectGroup);
      $("#obj_Objective").val(data.Objective);
      $("#obj_CreateDate").val(data.CreateDate);
      $("#obj_id").val(data.id);
    }
}

function createData(){
    var url='tprojectgroup/create.php';
    jsonObj={
      ProjectGroup:$("#obj_ProjectGroup").val(),
      CreateDate:$("#obj_CreateDate").val(),
      Objective:$("#obj_Objective").val()
    }
    var jsonData=JSON.stringify (jsonObj);
    var flag=executeData(url,jsonObj,false);
    return flag;
}
function updateData(){
    var url='tprojectgroup/update.php';
    jsonObj={
      ProjectGroup:$("#obj_ProjectGroup").val(),
      CreateDate:$("#obj_CreateDate").val(),
      Objective:$("#obj_Objective").val(),
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
      url="tprojectgroup/delete.php?id="+id;
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
