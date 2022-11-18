	<?php
		header("content-type:text/html;charset=UTF-8");
		include_once "../config/database.php";
		include_once "../config/config.php";
		include_once "../objects/tsurveytransaction.php";
		include_once "../objects/data.php";


		$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
		$database=new Database();
		$db=$database->getConnection();
		$obj=new tsurveytransaction($db);
		$objData=new Data($db);

		$value=$obj->getSuccess($userCode);
		$cnf=new Config();
		$rootPath=$cnf->path;
		
		$stressDefenceValue=$obj->getStressDefence($userCode);
		$mindStrengthValue=$obj->getMindStrength($userCode);
		$mindStressValue=$obj->getMindStress($userCode);
		$depress2QValue=$obj->getDepress2Q($userCode);
		$depress9QValue=$obj->getDepress9Q($userCode);
		$depress9Q_1Value=$obj->getDepress9Q_1($userCode);
		$suicideValue=$obj->getSuicide8Q($userCode);

	?>
	<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <script src="<?=$rootPath?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?=$rootPath?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


	<input type="hidden" id="obj_userCode">
	<input type='hidden' id='obj_toggle' value="0">
	<input type='hidden' id='obj_projectGroupId' value='7'>

	<div class="box box-success">
		<table class="table table-bordered  table-hover">
		<tr>
			<td  align="center" colspan="2">
				<h3 style='color:blue'>การสรุปผลการคัดกรองสุขภาพจิต</h3>
			</td>
		</tr>
		<?php
			$stmt=$objData->getData($userCode);
			if($stmt->rowCount()>0){
				$row=$stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				$facultyCode=$facultyCode;

				echo "<tr>\n";
				echo "<td width='150px'><h4>ชื่อ-สกุล :</h4></td>\n";
				echo "<td>".$fullName."</td>\n";
				echo "</tr>\n";

				echo "<tr>\n";
				echo "<td><h4>โทรศัพท์ :</h4></td>\n";
				echo "<td>".$telNo."</td>\n";
				echo "</tr>\n";


				echo "<tr>\n";
				echo "<td><h4>ผู้ติดต่อ :</h4></td>\n";
				echo "<td>".$contactPerson."</td>\n";
				echo "</tr>\n";

				echo "<tr>\n";

				echo "<td><h4>คณะ :</h4></td>\n";
				echo "<td>".$departmentName."</td>\n";

				echo "</tr>\n";
			}
			
		?>

	</table>
	

	</div>
	

	<div class="box box-warning">
	<table class="table table-bordered  table-hover">
		<tr>
			<td  align="center">
				<h3 style='color:blue'>วิธีเผชิญความเครียดของนักศึกษา</h3>
			</td>
		</tr>
		<tr><td>
			<div id="dvT" style="display:block">
			<div class='col-sm-6'>
				<h4>วิธีเผชิญความเครียด</h4>
				<a id="obj_defenceStressDetail" class="btn btn-danger"><i class="fa fa-info-circle"  aria-hidden="true"></i><label>&nbsp;คำแนะนำ</label></a>
				<a id="obj_defenceStressT" class="btn btn-success"><i class="fa fa-info-circle" aria-hidden="true"></i><label>&nbsp;คำตอบ</label></a>

			</div>
			<div class='col-sm-6'>
				<iframe id="dvStressDefence" frameborder='0' scrolling="no" width='100%' height='200px' ></iframe>
			</div>
			
			</div>
			

		</td></tr>
		
		
	</table>
	</div>

	<div class="box box-primary">
		<table class="table table-bordered  table-hover">
			<tr>
			<td  align="center">
				<h3 style='color:blue'>แบบประเมินความเข้มแข็งทางใจ</h3>
			</td>
			</tr>
			<tr>
		<td>
			<div class='col-sm-6'>
				<h4>ความเข้มแข็งทางใจ</h4> 
				<a id="obj_strengthDetail" class="btn btn-danger"><i class="fa fa-info-circle"  aria-hidden="true"></i><label>&nbsp;คำแนะนำ</label></a>

				<a id="obj_strengthT" class="btn btn-success"><i class="fa fa-info-circle" aria-hidden="true"></i><label>&nbsp;คำตอบ</label></a>

			</div>
			<div class='col-sm-6'>
				<iframe id="dvMindStrength" frameborder='0' scrolling="no" width='100%' height='200px' ></iframe>
			</div>
		</td>
		</tr>
		</table>
	</div>

	<div class="box box-success">
		<table class="table table-bordered  table-hover">
			<tr>
			<td  align="center">
				<h3 style='color:blue'>แบบประเมินความเครียด</h3>
			</td>
			</tr>
			<tr>
		<td>
			<div class='col-sm-6'><h4>ประเมินความเครียด</h4>
			 <a id="obj_stress" class="btn btn-danger"><i class="fa fa-info-circle" id="obj_tStress" aria-hidden="true"></i><label>&nbspคำแนะนำ</label></a>
 			 <a id="obj_stressT" class="btn btn-success"><i class="fa fa-info-circle" aria-hidden="true"></i><label>&nbsp;คำตอบ</label></a>

			</div>
			<div class='col-sm-6'>
				<iframe id="dvMindStress" frameborder='0' scrolling="no" width='100%' height='200px' ></iframe>
			</div>
		</td>
		</tr>
		</table>
	</div>

	<div class="box box-danger" id="dv2Q" style="display:block">
		<table class="table table-bordered  table-hover">
			<tr>
			<td  align="center">
				<h3 style='color:blue'>แบบคัดกรองภาวะซึมเศร้า</h3>
			</td>
			</tr>
			<tr>
		<td>
			<div class='col-sm-6'>
				<h4>ภาวะซึมเศร้า (2Q)</h4> 
			</div>
			<div class='col-sm-6'>
				<?php
					if($depress2QValue>0){
						echo "<h4 style='color:#F03E3E'>เป็นผู้มีความเสี่ยงหรือมีแนวโน้มที่จะเป็นโรคซึมเศร้า</h4>";
					}else{
						echo "<h4 style='color:#30B32D'>ไม่มีความเสี่ยงที่จะเป็นโรคซึมเศร้า</h4>";
					}
				?>
			</div>
		</td>
		</tr>
		</table>
	</div>


	<div class="box box-danger" id="dv9Q" style="display:none">
		<table class="table table-bordered  table-hover">
			<tr>
			<td  align="center">
				<h3 style='color:blue'>ประเมินภาวะซึมเศร้าด้วย (9Q)</h3>

			</td>
			</tr>
			<tr>
		<td>
			<div class='col-sm-6'><h4>ภาวะซึมเศร้า</h4>
				<a id="obj_dpress9Q" class="btn btn-danger"><i class="fa fa-info-circle" id="obj_tStress" aria-hidden="true"></i><label>&nbspคำแนะนำ</label></a>
 				<a id="obj_depressT" class="btn btn-success"><i class="fa fa-info-circle" aria-hidden="true"></i><label>&nbsp;คำตอบ</label></a>

			</div>
			<div class='col-sm-6'>
				<iframe id="dvDepress" frameborder='0' scrolling="no" width='100%' height='200px' ></iframe>

			</div>
		</td>
		</tr>
		</table>
	</div>


	<div class="box box-danger" id="dv8Q" style="display:none"  >
		<table class="table table-bordered  table-hover">
			<tr>
			<td  align="center">
				<h3 style='color:blue'>ประเมินการฆ่าตัวตาย (8Q)</h3>
			</td>
			</tr>
			<tr>
		<td>
			<div class='col-sm-6'>
				<h4>ภาวะการฆ่าตัวตาย </h4>
				<a id="obj_suicideT" class="btn btn-success"><i class="fa fa-info-circle" aria-hidden="true"></i><label>&nbsp;คำตอบ</label></a>
 
			</div>
			<div class='col-sm-6'>
				<iframe id="dvSuicide" frameborder='0' scrolling="no" width='100%' height='200px' ></iframe>

			</div>
		</td>
		</tr>
		</table>
	</div>


	   <div class="modal fade" id="modal-msg">
        <div class="modal-dialog" >
           <div class="modal-content">
            <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">คำแนะนำ</h4>
           </div>
           <div class="modal-body" id="dvSuggestion">
           
           </div>
        </div>
     </div>
   </div>



	   <div class="modal fade" id="modal-answer">
        <div class="modal-dialog" id="dvPopup" >
           <div class="modal-content">
            <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">คำตอบ</h4>
           </div>
           <div class="modal-body" >
           <table class="table table-bordered table-hover" id="tbRender">
           </table>
           </div>
        </div>
     </div>
   </div>

	<script type="text/javascript">

		function setEvaluation(){
			var url="<?=$rootPath?>/tevaluate/create.php";
			

			var mindStrengthRate='<?=$mindStrengthValue?>';
			var mindStrengthGrade="";
			if(mindStrengthRate>0&&mindStrengthRate<=16){
				mindStrengthGrade="01";
			}else
			if(mindStrengthRate>0&&mindStrengthRate<=16)
			{
				mindStrengthGrade="02";
			}else
			if(mindStrengthRate>16){
				mindStrengthGrade="03";

			}

			var mindStressRate='<?=$mindStressValue?>';
			var mindStressGrade="";
			if(mindStressRate>0&&mindStressRate<=4){
				mindStressGrade="01";
			}else
			if(mindStressRate>4&&mindStressRate<=7){
				mindStressGrade="02";
			}else
			if(mindStressRate>7&&mindStressRate<=9){
				mindStressGrade="02-1";
			}else
			if(mindStressRate>9){
				mindStressGrade="03";
			}

			var depressRate='<?=$depress9QValue?>';
			var depressGrade="";
			if(depressRate>=0&&depressRate<=12){
				 depressGrade="01";
			}else
			if(depressRate>12&&depressRate<=18){
				 depressGrade="02";
			}else
			if(depressRate>18&&depressRate<=19){
				 depressGrade="02-1";
			}
			else
			if(depressRate>19){
				 depressGrade="03";
			}


			var suicideRate='<?=$suicideValue?>';
			var suicideGrade="";
			if(suicideRate==0){
				 suicideGrade="01-1";
			}else
			if(suicideRate>1&&suicideRate<=7){
				 suicideGrade="01-2";
			}else
			if(suicideRate>7&&suicideRate<=12){
				 suicideGrade="01-3";
			}else
			if(suicideRate>12){
				 suicideGrade="01-4";
			}

			var defenceStressRate='<?=$stressDefenceValue?>';
			var defenceStressGrade="";
			if(defenceStressRate>=0&&defenceStressRate<=1.75){
				 defenceStressGrade="01";
			}else
			if(defenceStressRate>1.75&&defenceStressRate<=2.50){
				 defenceStressGrade="02";
			}else
			if(defenceStressRate>2.50&&defenceStressRate<=3.25){
				 defenceStressGrade="02-1";
			}
			else
			if(defenceStressRate>3.25){
				 defenceStressGrade="03";
			}

			var userCode='<?=$userCode?>';

			var jsonObj={
				userCode:userCode,
				burnouteRate:0,
				burnouteGrade:'',
				strengthRate:mindStrengthRate,
				strengthGrade:mindStrengthGrade,
				stressRate:mindStressRate,
				stressGrade:mindStressGrade,
				suicideRate:suicideRate,
				suicideGrade:suicideGrade,
				defenseStressRate:defenceStressRate,
				defenseStressGrade:defenceStressGrade,
				depressRate:depressRate,
				depressGrade:depressGrade
			}
			var jsonData=JSON.stringify(jsonObj);
			var urlExist="<?=$rootPath?>/tevaluate/isExist.php?userCode=<?=$userCode?>";
			var data=queryData(urlExist);
			if(data.flag==true)
				var url="<?=$rootPath?>/tevaluate/update.php";
			else
				var url="<?=$rootPath?>/tevaluate/create.php";
			var data=executeData(url,jsonObj,false);
		}
	

		

		function setMindStrength(){
			var url="<?=$rootPath?>/mindStrength/mindStrength.php?mindStrength=<?=$mindStrengthValue?>";
			//console.log(url);
			$("#dvMindStrength").attr('src', url);
		}

		function setMindStress(){
			var url="<?=$rootPath?>/mindStrength/mindStress.php?mindStress=<?=$mindStressValue?>";
			$("#dvMindStress").attr('src', url);
		}

		function setStressAnswer(){
			
			var url="<?=$rootPath?>/data/displayAnswerStress.php?userCode=<?=$userCode?>";
			$("#tbRender").load(url);
			$("#modal-answer").modal("toggle");
		}

		function setDepressAnswer(){
			
			var url="<?=$rootPath?>/data/displayAnswerDepress.php?userCode=<?=$userCode?>";
			$("#tbRender").load(url);
			$("#modal-answer").modal("toggle");
		}


		function setStrengthAnswer(){
			
			var url="<?=$rootPath?>/data/displayAnswerStrength.php?userCode=<?=$userCode?>";
			$("#tbRender").load(url);
			$("#modal-answer").modal("toggle");
		}


		function setDefenceStressAnswer(){
			
			var url="<?=$rootPath?>/data/displayAnswerDefenceStress.php?userCode=<?=$userCode?>";
			$("#tbRender").load(url);
			$("#modal-answer").modal("toggle");
		}


		function setSuicideAnswer(){
			
			var url="<?=$rootPath?>/data/displayAnswerSuicide.php?userCode=<?=$userCode?>";
			$("#tbRender").load(url);
			$("#modal-answer").modal("toggle");
		}


		function setSuggession(){

			var mindStressValue='<?=$mindStressValue?>';
			var url="<?=$rootPath?>/tsuggestion/getData.php?projectId=12&keyIndex=GREEN";
			if(mindStressValue>=0&&mindStressValue<=4){
				url="<?=$rootPath?>/tsuggestion/getData.php?projectId=12&keyIndex=GREEN";
			}else
			if(mindStressValue>4&&mindStressValue<=7){
				url="<?=$rootPath?>/tsuggestion/getData.php?projectId=12&keyIndex=YELLOW";
			}
			else
			if(mindStressValue>7&&mindStressValue<=9){
				url="<?=$rootPath?>/tsuggestion/getData.php?projectId=12&keyIndex=ORANGE";
			}
			else
			if(mindStressValue>9&&mindStressValue<=15){
				url="<?=$rootPath?>/tsuggestion/getData.php?projectId=12&keyIndex=RED";
			}
			data=queryData(url);
			$("#dvSuggestion").html(data.suggestion);
			$("#modal-msg").modal("toggle");

		}

		function setSuggestMindStrength(){
			var mindStrength='<?=$mindStrengthValue?>';

			if(mindStrength>=0&&mindStrength<=16){
				index="RED";
			}else
			if(mindStrength>16&&mindStrength<=27){
				index="YELLOW";
			}
			else
			if(mindStrength>27){
				index="GREEN";
			}

			var url="<?=$rootPath?>/tsuggestion/getData.php?projectId=11&keyIndex="+index;
			data=queryData(url);
			$("#dvSuggestion").html(data.suggestion);
			$("#modal-msg").modal("toggle");

		}

		function setSuggestDefenceStress(){
			

			var url="<?=$rootPath?>/tsuggestion/getData.php?projectId=16&keyIndex=ALL";
			data=queryData(url);
			$("#dvSuggestion").html(data.suggestion);
			$("#modal-msg").modal("toggle");

		}



		function setSuggestDepress9Q(){
			var depress9QValue='<?=$depress9QValue?>';
			var index="";
			if(depress9QValue>=0&&depress9QValue<=12){
				index="GREEN";
			}else
			if(depress9QValue>12&&depress9QValue<=18){
				index="YELLOW";
			}else
			if(depress9QValue>18&&depress9QValue<=19){
				index="ORANGE";
			}else
			if(depress9QValue>19){
				index="RED";
			}


			var url="<?=$rootPath?>/tsuggestion/getData.php?projectId=15&keyIndex="+index;
			data=queryData(url);
			$("#dvSuggestion").html(data.suggestion);
			$("#modal-msg").modal("toggle");

		}

			$("#obj_dpress9Q").click(function(){
				setSuggestDepress9Q();
			});


		function setStressDefence(){
			var url="<?=$rootPath?>/burnout/stressDefence.php?stressDefenceValue=<?=$stressDefenceValue?>";
			$("#dvStressDefence").attr('src', url);

		}

		function setDepress9Q(){
		   var depress2Q='<?=$depress2QValue?>';
		   if(depress2Q>0){
		   		var url="<?=$rootPath?>/burnout/depress9Q.php?depressValue=<?=$depress9QValue?>";
				$("#dvDepress").attr('src', url);
				$("#dv9Q").attr('style','display:block');
				$("#dv2Q").attr('style','display:none');
		   }
		
		}

		function setSuicide8Q(){
		   var depress9QValue='<?=$depress9QValue?>';
		   var depress9Q_1Value='<?=$depress9Q_1Value?>';

		   if(depress9QValue>7||depress9Q_1Value>0){
				var url="<?=$rootPath?>/burnout/suicide8Q.php?suicideValue=<?=$suicideValue?>";
				$("#dvSuicide").attr('src', url);
				$("#dv8Q").attr('style','display:block');
		   }

		  
		}


		function genMentalHealth(){
			var url="<?=$rootPath?>/tsurveytransaction/deleteByUserCode.php?userCode=<?=$userCode?>";
			data=executeGet(url);

			url="<?=$rootPath?>/tprojectgroup/genMentalHealth.php?projectGroupId="+$("#obj_projectGroupId").val()+"&userCode=<?=$userCode?>";
			$("#dvContent").load(url);
		}

		function saveIssend(){
			var url="<?=$rootPath?>/tsend/create.php";

			var jsonObj={
				userCode:'<?=$userCode?>',
				isSend:1
			}

			jsonData=JSON.stringify(jsonObj);

			executeData(url,jsonObj,false);
		}


		function askSendMail(){
			Swal.fire({
			  title: 'ต้องการส่งผลการทำแบบทดสอบหรือไม่?',
			  showDenyButton: true,
			  showCancelButton: true,
			  confirmButtonText: 'Yes',
			  denyButtonText: 'No'
			 
			}).then(

			(result) => {
			  if (result.isConfirmed) {
			  	saveIssend();
			    setEmailValidate();
			    Swal.fire('ส่งผลทดสอบให้กับผู้เชี่ยวชาญเรียบร้อยแล้ว', '', 'info')
			  } else if (result.isDenied) {
			    Swal.fire('ยังไม่ได้ส่งผลทดสอบให้ผู้เชี่ยวชาญ', '', 'info')
			  }
			});
			
		}



		function isSend(){
			var url="<?=$rootPath?>/tissend/isSend.php?userCode=<?=$userCode?>";
			var data=queryData(url);
			return data.flag;
		}

		function deleteIsSend(){
			var url="<?=$rootPath?>/tissend/delete.php?userCode='<?=$userCode?>'";
			executeGet(url);
		}





		$(document).ready(function(){
			setStressDefence();
			setMindStrength();
			setMindStress();
			setDepress9Q();
			setSuicide8Q();
			setEvaluation();

			if(isSend()==false){
				askSendMail();	
			}

			$("#obj_stress").click(function(){
				setSuggession();
			});

			$("#obj_defenceStressDetail").click(function(){
				setSuggestDefenceStress();
			});

			$("#obj_burnoutdetail").click(function(){
				setBurnout();
			});

			$("#obj_questionair").click(function(){
				genMentalHealth();
			});

			$("#obj_strengthDetail").click(function(){
				setSuggestMindStrength();
			});

			$("#obj_stressT").click(function(){
				//$("#tbBurnout").remove();
				setStressAnswer();
				
			});

			$("#obj_strengthT").click(function(){
				setStrengthAnswer();
			});

			$("#obj_suicideT").click(function(){
				setSuicideAnswer();
			});


			$("#obj_depressT").click(function(){
				//$("#tbBurnout").remove();
				setDepressAnswer();
				
			});




			$("#obj_defenceStressT").click(function(){
				//$("#tbBurnout").remove();
				setDefenceStressAnswer();
				
			});

			$("#obj_sendReport").click(function(){
				var url="<?=$rootPath?>/sendMail.php?userCode=<?=$userCode?>&userType=1";
				var data=executeGet(url);

				if(data.message==true){
					swal.fire({
				      title: "การส่งรายงานสำเร็จแล้ว",
				      type: "success",
				      buttons: [false, "ปิด"],
				      dangerMode: true,
				    });
				}
			});

			$("#obj_logout").click(function(){
				var url="<?=$rootPath?>/logoutMentalHealth.php";
				$(location).attr('href', url);

			});

			
		});	

	</script>	
