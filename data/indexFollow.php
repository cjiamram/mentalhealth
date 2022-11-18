<?php
  include_once "../config/config.php";
  $cnf=new Config();
  $rootPath=$cnf->path;
?>
<input type="hidden" id="obj_id">
<section class="content-header">
     <h1>
        <b>ระบบการประเมินสุขภาพจิต</b>

        <small>>>รายการติดตาม</small>
      </h1>
      <ol class="breadcrumb">
      </ol>
  </section>


     <section class="content container-fluid">
       <div class="box">

       <div class="box-header with-border">
          <h3 class="box-title"><b>รายการติดตาม</b></h3>
      </div>

       
        <div class="form-group">
          <table>
            <tr>
              <td width="150px">&nbsp;&nbsp;<label>ประเภท :</label></td>
               <td width="200px"><select id="obj_userType" class="form-control">
                  <option value="">****ทังหมด****</option>
                  <option value="1">นักเรียนนักศึกษา</option>
                  <option value="2">บุลคลากรภายในมหาวิทยาลัย</option>

               </select></td>
               <td width="150px">&nbsp;&nbsp;<label>ระหว่างวันที่ :</label></td>
               <td width="150px"><input type="date" value="<?=date('Y-m-d')?>" id="obj_sDate" class="form-control"></td>
               <td width="10px">&nbsp;
               </td>
                <td width="150px"><input type="date" value="<?=date('Y-m-d')?>" id="obj_fDate" class="form-control"></td>

               <td>
                  <a id="obj_display" href="#" class="btn btn-primary pull-left"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;แสดงผล</a>
               </td>
            </tr>
          </table>

       
          </div>
        </div>

        <div id="dvDisplay" >
        </div>    
       

    </section>


    <div class="modal fade" id="modal-input">
     <div class="modal-dialog" id="dvInput" >
      <div class="modal-content">
          <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">บันทึกผลการติดตาม</h4>
           </div>
           <div class="modal-body" id="dvInputBody">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnClose" value="ปิด"  data-dismiss="modal"  class="btn btn-default pull-left" >
                    <input type="button" id="btnSave" value="บันทึก"  data-dismiss="modal"  class="btn btn-primary" >
                  </div>
          </div>
      </div>
     </div>
   </div>


    <div class="modal fade" id="modal-readOne">
     <div class="modal-dialog"  >
      <div class="modal-content">
          <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ผลการติดตาม</h4>
           </div>
           <div class="modal-body" id="dvReadOneBody">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnCloseView" value="ปิด"  data-dismiss="modal"  class="btn btn-default pull-left" >
                  </div>
          </div>
      </div>
     </div>
   </div>

    <script>

      function displayData(){
          var sDate=$("#obj_sDate").val();
          var fDate=$("#obj_fDate").val();
          var userType=$("#obj_userType").val();
          var url="<?=$rootPath?>/data/displayFollowAnswerRange.php?sDate="+sDate+"&fDate="+fDate+"&userType="+userType;
          $("#dvDisplay").load(url);
      }

      function follow(userCode){

          var url="<?=$rootPath?>/tfillowlog/input.php?userCode="+userCode;
          $("#dvInputBody").load(url);

      }


      function displayOne(userCode){

          var url="<?=$rootPath?>/tfillowlog/displayReadone.php?userCode="+userCode;
          $("#dvReadOneBody").load(url);

      }


        function createData(){
                var url="<?=$rootPath?>/tfillowlog/create.php";
                var isContact=$("#obj_isContact").checked===true?true:false;
                var isAppoint=$("#obj_isAppoint").checked===true?true:false;
                jsonObj={
                    userCode:$("#obj_userCode").val(),
                    isContact:isContact,
                    isAppoint:isAppoint,
                    helpDescription:$("#obj_helpDescription").val(),
                    helpEffective:$("#obj_helpEffective").val()
                  }
                var jsonData=JSON.stringify (jsonObj);

                var flag=executeData(url,jsonObj,false);
                return flag;

        }
        function updateData(){
                var url="<?=$rootPath?>/tfillowlog/update.php";
                var isContact=$("#obj_isContact").checked===true?true:false;
                var isAppoint=$("#obj_isAppoint").checked===true?true:false;

                jsonObj={
                  userCode:$("#obj_userCode").val(),
                  isContact:isContact,
                  isAppoint:isAppoint,
                  helpDescription:$("#obj_helpDescription").val(),
                  helpEffective:$("#obj_helpEffective").val(),
                  id:$("#obj_id").val()
                }
                var jsonData=JSON.stringify (jsonObj);
                console.log(jsonData);
                var flag=executeData(url,jsonObj,false);
                return flag;
        }
        function readOne(id){
              var url='tfillowlog/readOne.php?id='+id;
              data=queryData(url);
              if(data!=""){
                $("#obj_userCode").val(data.userCode);
                $("#obj_isFollow").val(data.isFollow);
                $("#obj_isContact").val(data.isContact);
                $("#obj_isAppoint").val(data.isAppoint);
                $("#obj_helpDescription").val(data.helpDescription);
                $("#obj_helpEffective").val(data.helpEffective);
                $("#obj_createDate").val(data.createDate);
                $("#obj_id").val(data.id);
              }
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



      $(document).ready(function(){
          displayData();  
          $("#obj_display").click(function(){
               displayData();
          });

          $("#btnSave").click(function(){
            saveData();
          });
      });

    </script>