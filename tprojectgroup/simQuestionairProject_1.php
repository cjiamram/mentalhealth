<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tprojectgroup.php";
	include_once "../objects/tprojectgroupsub.php";
	include_once "../objects/classLabel.php";
	include_once "../objects/tqheader.php";
	include_once "../objects/tprojects.php";
	include_once "../config/config.php";
	include_once "../objects/tqlabel.php";

	$cnf=new Config();
	$database=new Database();
	$db=$database->getConnection();
	$objLbl=new ClassLabel($db);
	$objLgd=new tqlabel($db);
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
		function getQuestionairSub($projectId,$obj,$objProject,$objLgd,&$i){
					$projectName=$objProject->getProjectName($projectId);

					$stmt1=$objLgd->getData($projectId);
						$objLabels=array();
						$cnt=$stmt1->rowCount();
						if($stmt1->rowCount()>0){
							while($row=$stmt1->fetch(PDO::FETCH_ASSOC)){
								extract($row);
								$objItem=array("label"=>$label,"weight"=>$weight);
								array_push($objLabels, $objItem);
							}
						}

					echo "<table width=\"600px\"><tr><td>\n";	
					echo "<table  class=\"table table-bordered\">\n";
					echo "<thead>\n";
					echo "<tr>\n";
					echo "<th width='50px'>No.</th>\n";
					echo "<th>คำอธิบาย</th>\n";
					echo "<th width='100px'>ถ่วงน้ำหนัก</th>\n";
					echo "</tr>\n";
					echo "</thead>\n";
					$i=1;
					foreach ($objLabels as $row) {
							echo "<tr>\n";
							echo "<td>".$i++."</td>\n";
							echo "<td>".$row["label"]."</td>\n";
							echo "<td>".$row["weight"]."</td>\n";
							echo "</tr>\n";
						}	
					echo "</table>\n";

					echo "</td></tr></table>\n";

					echo "<br>";

			/**********************/
					echo "<table class=\"table table-bordered\">\n";
					echo "<tr>\n";
					echo '<td><label style=\'color:blue;\'><h3>'.$projectName.'</h3></label></td>'."\n";
					echo "</tr>\n";
					echo "<tr>\n";
					echo "<td>\n";
					echo "<table width=\"100%\" class=\"table table-bordered table-hover\">\n";


					$stmt=$obj->getData($projectId);

					if($stmt->rowCount()>0){

						

						echo "<tr>";
						echo "<td><h4>No.</h4></td>";
						echo "<td><h4>หัวข้อ</h4></td>";
						for($i=1;$i<=$cnt;$i++){
							echo "<td align=\"center\" width='100px'><h5>".$i."</h5></td>\n";
						}

						echo "</tr>";

						while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
							extract($row);

							echo "<input type='hidden' id='objId-". $i ."' value='".$id."' >";
							echo "<input type='hidden' id='objQtype-". $i ."' value='".$QtypeCode."' >";
							
							if($QtypeCode==1){

									echo "<tr>\n";
									echo "<td width=\"70px\" align=\"center\">\n";
									echo "<h4>".$QuestionNo."</h4>";
									echo "</td>\n";
									echo '<td><h5>'.$HeaderCaption.'</h5><input type=\'hidden\' id=\'obj_Q-'.$id.'\'></td>';
									for($i=1;$i<=$cnt;$i++){
										$strObj="<input type=\"radio\" class=\"btn-check\" name=\"obj_Q-".$id."\"  onchange=\"setQuestValue('obj_Q-".$id."','".$i."')\">";
										echo "<td align=\"center\">".$strObj."</td>\n";
									}
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
		echo "<table width='100%' style='table table-bordered table-hover'>\n";
		$i=0;
		if($stmt->rowCount()>0){
			while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				echo "<tr><td>\n";
					getQuestionairSub($ProjectId,$obj,$objProject,$objLgd,$i);
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

