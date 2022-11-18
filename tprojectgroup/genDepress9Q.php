<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../config/config.php";
	include_once "../objects/tprojectgroup.php";
	include_once "../objects/tprojectgroupsub.php";
	include_once "../objects/classLabel.php";
	include_once "../objects/tqheader.php";
	include_once "../objects/tprojects.php";
	include_once "../objects/tqlabel.php";
	include_once "../objects/tquestionchoice.php";


	$cnf=new Config();
	$database=new Database();
	$db=$database->getConnection();
	$objLbl=new ClassLabel($db);
	$objLgd=new tqlabel($db);
	$obj=new tqheader($db);
	$objProject=new tprojects($db);
	$objProjectGroup =new tprojectgroup($db);
	$objQuestionChoice=new tquestionchoice($db);
	$rootPath=$cnf->path;
	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
	$userType=isset($_GET["userType"])?$_GET["userType"]:1;
?>
<h4 id='TFirst'><h4>

<input type="hidden" value="<?=$userCode?>" id='obj_userCode'>
<input type="hidden" value="<?=$userType?>" id='obj_userType'>

<section class="content-header">
<div class="box box-warning">
	<div class="box-header with-border">
      <h3 class="box-title"><b>
      	<?php 
      	echo $objLbl->getLabel("t_projectgroup","Question","th").":" 

      	?></b>
      </h3>
 	</div>
</div>
<div class="box box-primary">
	<?php
		function getQuestionairSub($projectId,$obj,$objProject,$objLgd,$objQuestionChoice,$i){
					$projectName=$objProject->getProjectName($projectId);


			/**********************/
					echo "<table class=\"table table-bordered\">\n";
					echo "<tr>\n";
					echo '<td><label style=\'color:blue;\'><h3>'.$projectName.'</h3></label></td>'."\n";
					echo "</tr>\n";
					echo "<tr>\n";
					echo "<td>\n";
					echo "<table width=\"100%\" class=\"table table-bordered\">\n";


					$stmt=$obj->getData($projectId);
					if($stmt->rowCount()>0){
						echo "<tr>";
						$stmt1=$objLgd->getData($projectId);
						$objLabels=array();
						$cnt=1;
						if($stmt1->rowCount()>0){
							while($row=$stmt1->fetch(PDO::FETCH_ASSOC)){
								$cnt++;
								extract($row);
								$objItem=array("label"=>$label,"weight"=>$weight);
								array_push($objLabels, $objItem);
							}
						}



						echo "</tr>";
						$nextT="";
						while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
							extract($row);

							echo "<input type='hidden' id='objId-". $i ."' value='".$id."' >";
							echo "<input type='hidden' id='objQtype-". $i ."' value='".$QtypeCode."' >";
							
							if($QtypeCode==1){

									echo "<tr>\n";
									echo "<td width=\"70px\" align=\"center\">\n";
									echo "<label><h4>".$QuestionNo."</h4></label>";
									echo "</td>\n";
									echo '<td><label><h4 id="'.$nextT.'">'.$HeaderCaption.'<input type=\'hidden\' id=\'obj_Q-'.$id.'\'><input type=\'hidden\' id=\'obj_Idx-'.$id.'\'></h4><h4 id="CT-'.$i.'"></h4></label></td>';
									echo "<input id='L-".$i."' type='hidden' value='".$QuestionNo."-".$HeaderCaption."'>";

									echo "</tr>\n"; 
									echo "<tr>\n";

									echo "<td colspan='2'>\n";
									echo "<table width='100%' class=\"table table-bordered  table-hover\">\n";
									echo "<tr>\n";
									if(intval($uniform)===1){
											foreach ($objLabels as $row) {
												echo "<tr>\n";
												echo "<td width='50px'>&nbsp;</td>\n";
												echo "<td width='50px' align='center'>\n";
												echo '<input type="radio" class="btn-check" name="obj_Q-'.$id.'"  onchange=\'setQuestValue("obj_Q-'.$id.'","obj_Idx-'.$id.'",'.$row["weight"].',"'."T-".$id.'")\'>&nbsp;';
												echo "</td>\n";
												echo "<td>\n";
													echo "<h5>".$row["label"]."</h5>";
												echo "</td>\n";
												echo "</tr>\n";
											}
									}else{
										$stmtQC=$objQuestionChoice->getData($id);
										while($rowq=$stmtQC->fetch(PDO::FETCH_ASSOC)){
											extract($rowq);
											echo "<tr>\n";
												echo "<td width='50px'>&nbsp;</td>\n";
												echo "<td width='50px' align='center'>\n";
												echo '<input type="radio" class="btn-check" name="obj_Q-'.$id.'"  onchange=\'setQuestValueIndex("obj_Q-'.$id.'","obj_Idx-'.$id.'",'.$indexNo.','.$weight.',"'."T-".$id.'")\'>&nbsp;';
												echo "</td>\n";
												echo "<td>\n";
													echo "<h5>".$caption."</h5>";
												echo "</td>\n";
												echo "</tr>\n";

										}

									}



									echo "</tr>\n";
									echo "</table>\n";
									echo "</td>\n";
									echo "</tr>\n";
									$nextT="T-".$id;
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
								$nextT="T-".$id;
							}
							$i++;
						}

						
					}

					echo "</table>\n";
					echo "</td>\n";
					echo "</tr>\n";
					echo "</table>\n";

			/**********************/
			return $i;
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
					$i=getQuestionairSub($ProjectId,$obj,$objProject,$objLgd,$objQuestionChoice,$i);
				echo "</td></tr>\n";
				//$i++;

			}
		}

		echo "<tr><td><div class=\"col-sm-12\">
		<button id=\"btnSaveSurvey\" value=\"send\"  class=\"btn btn-primary\"><i class=\"fa fa-envelope\"  aria-hidden=\"true\"></i>&nbsp;ส่งคำตอบ</button>
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
	
	var projectId='<?=$projectGroupId?>';
	function setQuestValue(objQuestion,objIndex,val,tag){
		$("#"+objQuestion).val(val);
		$("#"+objIndex).val(val);

	}

	function setQuestValueIndex(objQuestion,objIndex,index,val,tag){
		$("#"+objQuestion).val(val);
		$("#"+objIndex).val(index);


	}


	function isUndefined(x) { 
  			return typeof x == "undefined"; 
	} 

	
	function isExist(questId,studentCode){
		var url="<?=$rootPath?>/tsurveytransaction/isExist.php?questId="+questId+"&studentCode="+studentCode;
		data=queryData(url);
		return data.exist; 
	}

	function isAvailableSave(){
		var j=0;
		while(document.getElementById("objId-"+j)!==null){
			var qid=$("#objId-"+j).val();
			var cid=$("#obj_Q-"+qid).val();


			if(j!==3){
				if(cid==""){
					$("#objId-"+j)[0].scrollIntoView();
					var jsonData={
						index:j,
						flag:false

					}
					return jsonData;
				}
			}



			j++;
		}
		var jsonData={
					index:j,
					flag:true

			}
		return jsonData;
	}


	function saveQuestion(i,questId){

		var flag=true;
		var url="<?=$rootPath?>/tsurveytransaction/create.php";
		var score=-1;
		var answer="";
		var weightIndex=0;
		if(parseInt($("#objQtype-"+i).val())==1){
			score=$("#obj_Q-"+questId).val();
			weightIndex=$("#obj_Idx-"+questId).val();
			answer="";

		}else{
			score=-1;
			weightIndex=-1;
			answer=$("#obj_Q-"+questId).val();
		}

		var jsonObj={
				ProjectCode:projectId,
				Score:score,
				QuestId:questId,
				StudentCode:$("#obj_userCode").val(),
				Answer:answer,
				weightIndex:weightIndex
		}


		var jsonData=JSON.stringify (jsonObj);

		flag=  executeData(url,jsonObj,false);
	
		return flag;
	}

	function saveIteration(){
		var i=0;
		var flag=true;
		while(document.getElementById("objId-"+i)!==null){
			if(!isExist($("#objId-"+i).val(),$("#obj_userCode").val())){
				var f  =saveQuestion(i,$("#objId-"+i).val());
				flag =flag & f;
			}
			i++;
		}
		return flag;
	}


	function saveQuestionair(){
		i=0;
		while(document.getElementById("objId-"+i)!==null){
			var qId=$("#objId-"+i).val();
			var qType=$("#objQtype-"+i).val();

			i++;
		}

	}

	function isSurvey(){
		var url="<?=$rootPath?>/tsurveytransaction/isSurvey.php?projectId="+projectId+"&studentCode="+$("#obj_userCode").val();
		data=queryData(url);
		return data.exist;
	}


	function getDepress9Q(){
		var url="<?=$rootPath?>/burnout/getDepress9Q.php?userCode="+$("#obj_userCode").val();;
		var data=queryData(url);
		return data.depress;
	}


	function getDepress9Q_1(){
		var url="<?=$rootPath?>/burnout/getDepress9Q_1.php?userCode="+$("#obj_userCode").val();;
		var data=queryData(url);
		return data.depress;
	}


	

	$(document).ready(function(){
		$('#TFirst')[0].scrollIntoView();
		$(".close").click(function(){
			$('#modal-description').modal('hide');
		});

		$("#btnCloseDesc").click(function(){
			$('#modal-description').modal('hide');
		});

		$("#btnSaveSurvey").click(function(){

			if(!isSurvey()){
						avaiObj= isAvailableSave();
						if(avaiObj.flag==true){	
						
						if(saveIteration()==true){
						swal.fire({
							title: "บันทึกแบบสอบถามเรียบร้อยแล้ว",
							type: "success",
							buttons: [false, "ปิด"],
							dangerMode: true,
						}).then((result) => {
							if(getDepress9Q()>7||getDepress9Q_1()>1){
										var url="<?=$rootPath?>/tprojectgroup/genSuicide8Q.php?projectGroupId=9&userCode="+$("#obj_userCode").val()+"&userType=<?=$userType?>";;
										console.log(url);
										$("#dvContent").load(url);

							}else
							{
								var url="";
								var userType=<?=intval($userType)?>;


								if(userType!==1)
									url="<?=$rootPath?>/burnout/burnoutReport.php?userCode="+$("#obj_userCode").val();
								else
									url="<?=$rootPath?>/burnout/burnoutStudentReport.php?userCode="+$("#obj_userCode").val();
								//console.log(url);
								$("#dvContent").load(url);
							}
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
			}
			else
			{
				var lbl=$("#L-"+avaiObj.index).val();
				swal.fire({
							title: "กรุณากรอกข้อมูลให้ครบถ้วน ",
							text: lbl,
							type: "error",
							buttons: [false, "ปิด"],
							dangerMode: true,
						}).then((res)=>{
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
			
		});
		
	});
</script>

