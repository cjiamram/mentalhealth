<?php
  include_once "../config/config.php";
  $cnf=new Config();
  $rootPath=$cnf->path;
?>
<section class="content-header">
     <h1>
        <b>ระบบการประเมินสุขภาพจิต</b>

        <small>>>สรุปผลการประเมินของบุคลากร</small>
      </h1>
      <ol class="breadcrumb">
      </ol>
 </section>

<section class="content container-fluid">
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title"><b>ผลสรุปการประเมินของบุคลาการ</b></h3>
	</div>
	<div class="form-group">
          <table>
            <tr>
              <td width="150px">&nbsp;&nbsp;<label>หน่วยงาน :</label></td>
               <td width="400px">
	               	<select id="obj_department" class="form-control">
	               </select>
           		</td>
           		<td>&nbsp;</td>
               <td>&nbsp;
                  <a id="obj_display" href="#" class="btn btn-primary pull-left"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;แสดงผล</a>
               </td>
            </tr>
          </table>
          </div>
</div>
<div >

<div  class="col-sm-6" >
	<div id="dvLevelStress" class="box box-info"></div>
</div>
<div  class="col-sm-6" >
	<div id="dvGenderStress" class="box box-primary"></div>
</div>

<div  class="col-sm-6" >
	<div id="dvLevelDepress" class="box box-info"></div>
</div>
<div  class="col-sm-6" >
	<div id="dvGenderDepress" class="box box-primary"></div>
</div>

<div  class="col-sm-6" >
	<div id="dvLevelSuicide" class="box box-info"></div>
</div>
<div  class="col-sm-6" >
	<div id="dvGenderSuicide" class="box box-primary"></div>
</div>

</div>



</section>
<script type="text/javascript">
	function setDepartment(){
		var url="<?=$rootPath?>/tdepartment/getDepartment.php";
		setDDLPrefix(url,"#obj_department","***เลือกหน่วยงาน***");
	}

	

	function renderLevelStress(){
		var url="<?=$rootPath?>/report/pieStaffStress.php?departmentCode="+$("#obj_department").val();
		$("#dvLevelStress").load(url);
	}

	function renderStressGender(levelCode,levelName){
		//var url="<?=$rootPath?>/report/pieStaffStressGender.php?departmentCode="+$("#obj_department").val()+"&levelCode="+levelCode+"&levelName="+levelName;
		var url="<?=$rootPath?>/report/barStaffStressGender.php?departmentCode="+$("#obj_department").val()+"&levelCode="+levelCode+"&levelName="+levelName;

		$("#dvGenderStress").load(url);
	}


	function renderLevelSuicide(){
		var url="<?=$rootPath?>/report/pieStaffSuicide.php?departmentCode="+$("#obj_department").val();
		$("#dvLevelSuicide").load(url);
	}

	function renderSuicideGender(levelCode,levelName){
		var url="<?=$rootPath?>/report/barStaffSuicideGender.php?departmentCode="+$("#obj_department").val()+"&levelCode="+levelCode+"&levelName="+levelName;
		$("#dvGenderSuicide").load(url);
	}


	function renderLevelDepress(){
		var url="<?=$rootPath?>/report/pieStaffDepress.php?departmentCode="+$("#obj_department").val();
		
		$("#dvLevelDepress").load(url);
	}


	function renderDepressGender(levelCode,levelName){
		var url="<?=$rootPath?>/report/barStaffDepressGender.php?departmentCode="+$("#obj_department").val()+"&levelCode="+levelCode+"&levelName="+levelName;
		$("#dvGenderDepress").load(url);
	}

	$(document).ready(function(){
		setDepartment();
		renderLevelStress();
		renderLevelSuicide();
		renderLevelDepress();
		renderStressGender("","");
		renderDepressGender("","");
		renderSuicideGender("","");

		$("#obj_display").click(function(){
			renderLevelStress();
			renderLevelSuicide();
			renderLevelDepress();
			renderStressGender("","");
			renderDepressGender("","");
			renderSuicideGender("","");
		});

	});
</script>
