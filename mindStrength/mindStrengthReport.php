<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../config/config.php";
	include_once "../objects/tsurveytransaction.php";

	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
	$database=new Database();
	$db=$database->getConnection();
	$obj=new tsurveytransaction($db);
	$value=$obj->getSuccess($userCode);
	$cnf=new Config();
	$rootPath=$cnf->path;
	$emotionalLackValue=$obj->getMindStength($userCode);


?>
<style type="text/css">

</style>


<input type="hidden" id="obj_userCode">

	<div class="box box-warning">
	
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
			</div>
			<div class='col-sm-6'>
				<iframe id="dvStength" frameborder='0' scrolling="no" width='100%' height='150px' ></iframe>
			</div>
		</td>

		</tr>
		
	
		
	</table>
	</div>

	<script type="text/javascript">
		function setMindStrength(){
			var url="<?=$rootPath?>/mindStrength/mindStrength.php?mindStrength=<?=$emotionalLackValue?>";
			$("#dvElack").attr('src', url);
		}

		

		$(document).ready(function(){
			setElack();
			
		});	

	</script>	
