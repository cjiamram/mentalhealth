<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tprojectgroup.php";
	include_once "../objects/tprojectgroupsub.php";
	include_once "../objects/classLabel.php";
	include_once "../objects/tqheader.php";
	include_once "../objects/tprojects.php";
	include_once "../config/config.php";

	$cnf=new Config();
	$database=new Database();
	$db=$database->getConnection();
	$objLbl=new ClassLabel($db);
	$obj=new tqheader($db);
	$objProject=new tprojects($db);
	$objProjectGroup =new tprojectgroup($db);
	$rootPath=$cnf->path;

	

?>
<section class="content-header">
<div class="box box-warning">
	<div class="box-header with-border">
      <h3 class="box-title"><b>
      	<?php echo $objLbl->getLabel("t_projectgroup","Question","th").":" ?></b>
      </h3>
 	</div>
 	<form role='form'>
	<div class="box-body">
		<div class='form-group'>
		<label class="col-sm-12"><?php echo $objLbl->getLabel("t_projectgroup","StudentName","th").":" ?></label>

			 <div class="col-sm-2"><input class="form-control" type="text" id="obj_stdId"></div>
  			 <div class="col-sm-4"><input class="form-control" type="text" id="obj_stdName"></div>
		
	
		</div>
		<div class='form-group'>
		<label class="col-sm-12">สถานะ</label>

			 <div class="col-sm-6"><select id="obj_status" class="form-control"></select></div>
		
	
		</div>
		<div class='form-group'>
		<label class="col-sm-12">หน่วยงาน</label>

			 <div class="col-sm-6"><select id="obj_department" class="form-control"></select></div>
		
	
		</div>
		
	</div>
	

</div>
<div class="box box-primary">
	<?php
		function getQuestionairSub($projectId,$obj,$objProject,&$i){
					$projectName=$objProject->getProjectName($projectId);

			/**********************/
					echo "<table class=\"table table-bordered\">\n";
					echo "<tr>\n";
					echo '<td><label style=\'color:blue;\'>'.$projectName.'</label></td>'."\n";
					echo "</tr>\n";
					echo "<tr>\n";
					echo "<td>\n";
					echo "<table width=\"100%\" class=\"table table-bordered table-hover\">\n";


					$stmt=$obj->getData($projectId);

					if($stmt->rowCount()>0){
						echo "<tr>";
						echo "<td>No.</td>";
						echo "<td>หัวข้อ</td>";
						echo "<td align=\"center\">1</td>\n";
						echo "<td align=\"center\">2</td>\n";
						echo "<td align=\"center\">3</td>\n";
						echo "<td align=\"center\">4</td>\n";
						echo "<td align=\"center\">5</td>\n";
						echo "</tr>";
						//echo "<input type='hidden' id='obj_QCount' value='".$stmt->rowCount()."'>";

						while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
							extract($row);

							echo "<input type='hidden' id='objId-". $i ."' value='".$id."' >";
							echo "<input type='hidden' id='objQtype-". $i ."' value='".$QtypeCode."' >";
							
							if($QtypeCode==1){

									echo "<tr>\n";
									echo "<td width=\"70px\" align=\"center\">\n";
									echo $QuestionNo;
									echo "</td>\n";
									echo '<td>'.$HeaderCaption.'<input type=\'hidden\' id=\'obj_Q-'.$id.'\'></td>';
									echo '<td width="50px" align=\'center\'><input type="radio" class="btn-check" name="obj_Q-'.$id.'"  onchange=\'setQuestValue("obj_Q-'.$id.'","1")\'></td>';
									echo '<td width="50px" align=\'center\'><input type="radio" class="btn-check" name="obj_Q-'.$id.'"  onchange=\'setQuestValue("obj_Q-'.$id.'","2")\'></td>';
									echo '<td width="50px" align=\'center\'><input type="radio" class="btn-check" name="obj_Q-'.$id.'"  onchange=\'setQuestValue("obj_Q-'.$id.'","3")\'></td>';
									echo '<td width="50px" align=\'center\'><input type="radio" class="btn-check" name="obj_Q-'.$id.'"  onchange=\'setQuestValue("obj_Q-'.$id.'","4")\'></td>';
									echo '<td width="50px" align=\'center\'><input type="radio" class="btn-check" name="obj_Q-'.$id.'"  onchange=\'setQuestValue("obj_Q-'.$id.'","5")\'></td>';
									echo "</tr>\n"; 
							}
							else
							{
								echo "<tr>\n";
								echo "<td width=\"70px\" align=\"center\">";
								echo $QuestionNo;
								echo "</td>\n";
								echo '<td colspan=\'6\'>'.$HeaderCaption.'</td>'."\n";
								echo "</tr>\n";
								echo "<tr>\n";
								echo '<td colspan=\'7\'><textarea class=\'form-control\' name=\'obj_Q-'.$id.'\' id=\'obj_Q-'.$id.'\' rows=\'3\'></textarea></td>'."\n";
								echo "</tr>\n";
							}
							$i++;
						}
					}

					echo "</table>\n";
					echo "</td>\n";
					echo "</tr>\n";
					echo "</table>\n";

			/**********************/
			
		}
		

		$objGroupSub=new tprojectgroupsub($db);
		$projectGroupId=isset($_GET["projectGroupId"])?$_GET["projectGroupId"]:1;
		$description=$objProjectGroup->getDescription($projectGroupId);
		$stmt=$objGroupSub->getData($projectGroupId);
		//print_r($stmt);
		//$projectGroupId
		echo "<table width='100%' style='table table-bordered table-hover'>\n";
		$i=0;
		if($stmt->rowCount()>0){
			while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				echo "<tr><td>\n";
					getQuestionairSub($ProjectId,$obj,$objProject,$i);
				echo "</td></tr>\n";
			}
		}

		echo "<tr><td ><div class=\"col-sm-12\">
		<input type=\"button\" id=\"btnSaveSurvey\" value=\"Send Questionair\"  class=\"btn btn-primary\" >
		</div>
		</td></tr>";
		
		echo "</table>\n";
	?>

</div>

<div class="modal fade" id="modal-description">
        <div class="modal-dialog" style="width:900px">
           <div class="modal-content">
            <div class="box-header with-border">
                <button type="button" class="close"  aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">คำชี้แจง</h4>
           </div>
           <div class="modal-body" id="dvDescription">
           		<?php 
           			echo $description;

           		?>
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnCloseDesc" value="ปิด"  class="btn btn-default pull-left" >
                  </div>
           </div>
        </div>
     </div>
   </div>

</section>
<script>
	
	var projectId='<?= $projectGroupId?>';

	function listDepartment(){
		var url ="<?=$rootPath?>/tdepartment/getData.php";
		setDDLPrefix(url,$("#obj_department"),"***เลือก***");
	}

	function listStatus(){
		var url ="<?=$rootPath?>/tstatus/getData.php";
		setDDLPrefix(url,$("#obj_status"),"***เลือก***");
	}


	function listFaculty(){
		var url="<?=$rootPath?>/tfaculty/getData.php?keyWord=";
		setDDLPrefix(url,"#obj_faculty","***คณะ***");
	}

	function listProgram(){
		var url="<?=$rootPath?>/tprogram/getData.php?keyWord="+$("#obj_faculty").val();
		setDDLPrefix(url,"#obj_program","***สาขา***");
	}

	function setQuestValue(objQuestion,val){
		$("#"+objQuestion).val(val);

	}

	function isUndefined(x) { 
  			return typeof x == "undefined"; 
	} 

	
	function isExist(questId,studentCode){
		var url="<?=$rootPath?>/tsurveytransaction/isExist.php?questId="+questId+"&studentCode="+studentCode;
		data=queryData(url);
		return data.exist; 
	}

	function saveQuestion(i,questId){

		var url="<?=$rootPath?>/tsurveytransaction/create.php";
	
		var score=-1;
		var answer="";
		if(parseInt($("#objQtype-"+i).val())==1){
			score=$("#obj_Q-"+questId).val();
			answer="";

		}else
		{
			score=-1;
			answer=$("#obj_Q-"+questId).val();
		}
		
		var jsonObj={
				ProjectCode:projectId,
				Score:score,
				QuestId:questId,
				StudentCode:$("#obj_stdId").val(),
				Answer:answer
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);

		return flag;
	}

	function saveIteration(){
		var i=0;
		var flag=true;
		while(!isUndefined($("#objId-"+i).val())){
			if(!isExist($("#objId-"+i).val(),$("#obj_stdId").val())){
				var f  =saveQuestion(i,$("#objId-"+i).val());
				flag =flag & f;
			}

			i++;
		}
		return flag;
	}

	function isSurvey(){
		var url="<?=$rootPath?>/tsurveytransaction/isSurvey.php?projectId="+projectId+"&studentCode="+$("#obj_stdId").val();
		data=queryData(url);
		return data.exist;

	}

	function createEvaHeader(){
		var url="<?=$rootPath?>/tevaluateheader/create.php";
		
		var jsonObj={
			"studentCode":$("#obj_stdId").val(),
			"projectGroup":projectId,
			"status":$("#obj_status").val(),
			"department":$("#obj_department").val()
		}

		var jsonData=JSON.stringify (jsonObj);
		console.log(jsonData);
		var flag=executeData(url,jsonObj,false);
		return flag;
	}

	$(document).ready(function(){
		
		//$('#modal-description').modal('toggle');
		listDepartment();
		listStatus();
		
		$("#obj_stdId").change(function(){

		});

		$(".close").click(function(){
			$('#modal-description').modal('hide');
		});

		$("#btnCloseDesc").click(function(){
			$('#modal-description').modal('hide');
		});

		$("#btnSaveSurvey").click(function(){
			if(!isSurvey()){
				createEvaHeader();
				if(saveIteration()==true){
				swal.fire({
					title: "บันทึกแบบสอบถามเรียบร้อยแล้ว",
					type: "success",
					buttons: [false, "ปิด"],
					dangerMode: true,
				});
			}
			else{
				swal.fire({
					title: "บันทึกแบบสอบถามผิดพลาด",
					type: "error",
					buttons: [false, "ปิด"],
					dangerMode: true,
				});
			}


			}else
			{
				swal.fire({
					title: "คุณได้ทำแบบสอบถามแล้ว",
					type: "success",
					buttons: [false, "ปิด"],
					dangerMode: true,
				});
			}

			
			//****************
		})
	});
</script>

