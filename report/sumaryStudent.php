<?php
  include_once "../config/config.php";
  $cnf=new Config();
  $rootPath=$cnf->path;
?>
<style type="text/css">
.preLoad {
    width: 100%;
    height: 150px;
    z-index: 9999;
    background: url(img/spinning-arrows.gif) center no-repeat #fff;
}

.afterLoad {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
}

</style>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<section class="content-header">
     <h1>
        <b>ระบบการประเมินสุขภาพจิต</b>

        <small>>>รายงานสรุปการทำแบบทดสอบของนักศึกษา</small>
      </h1>
      <ol class="breadcrumb">
      </ol>
 </section>

<section class="content container-fluid">
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title"><b>ผลการทดสอบของนักศึกษา</b></h3>
	</div>
	<div class="form-group">
          <table>
            <tr>
              <td width="150px">&nbsp;&nbsp;<label>คณะ :</label></td>
               <td width="400px">
	               	<select id="obj_department" class="form-control">
	               </select>
           		</td>
           		<td>&nbsp;</td>
               <td>&nbsp;
                  <a id="obj_display" href="#" class="btn btn-primary pull-left"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;แสดงผล</a>
               	  <a id="obj_export" href="#" class="btn btn-warning pull-left"><i class="fas fa-file-export" aria-hidden="true"></i>&nbsp;export</a>
	
               </td>
            </tr>
          </table>
          </div>
</div>
<div >

<div  class="col-sm-6" >
	<div id="dvGender" class="box box-info"></div>
</div>
<div  class="col-sm-6" >
	<div id="dvLevel" class="box box-primary"></div>
</div>
<div  class="col-sm-12">
	<div id="dvStudent" style='height:600px;min-height:400;max-height:1000px;overflow-y: scroll;'>
	</div>
</div>
</div>
<div id="dvExcel" style='display:none'></div>


</section>
<script type="text/javascript">
	function setDepartment(){
		var url="<?=$rootPath?>/tdepartment/getFaculty.php";
		setDDLPrefix(url,"#obj_department","***เลือกคณะ***");
	}

	function renderPie(){
		var url="<?=$rootPath?>/report/pieGender.php?faculty="+$("#obj_department").val();
		$("#dvGender").load(url);
	}


	function renderBar(){
		var url="<?=$rootPath?>/report/barLevelYear.php?faculty="+$("#obj_department").val();
		$("#dvLevel").load(url);
	}

	function renderStudentByFaculty(){
		$("#dvStudent").addClass("preLoad");

		var url="<?=$rootPath?>/report/displayStudentByFaculty.php?faculty="+$("#obj_department").val();
		$("#dvStudent").load(url,function() {
  				$("#dvStudent" ).removeClass( "preLoad" );
		});
		
	}

	function exportStudentByDepartment(){
		
		var url="<?=$rootPath?>/report/displayRawStudentByFaculty.php?faculty="+$("#obj_department").val();
		$("#dvExcel").load(url);
	}

	$(document).ready(function(){
		setDepartment();
		renderPie();
		renderBar();
		renderStudentByFaculty();

		$("#obj_display").click(function(){
			renderPie();
			renderBar();
			renderStudentByFaculty();
		});

		$("#obj_export").click(function(){
			exportStudentByDepartment();
		});

	});
</script>
