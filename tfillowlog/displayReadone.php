<?php
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		header("Access-Control-Allow-Methods: POST");
		header("Access-Control-Max-Age: 3600");
		header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
		include_once "../config/database.php";
		include_once "../objects/tfillowlog.php";
		include_once "../objects/classLabel.php";
		include_once "../config/config.php";
		$cnf=new Config();
		$rootPath=$cnf->path;
		$database = new Database();
		$db = $database->getConnection();
		$objLbl = new ClassLabel($db);
		$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";

		$obj=new tfillowlog($db);
		$stmt=$obj->getData($userCode);
		if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			$isContactStatus=$isContact===true?"ติดต่อได้":"ติดต่อไม่ได้";
			$isAppointStatus=$isAppoint===true?"นัดหมายแล้วส":"ไม่ได้นัดหมาย";
		}


?>

<form role='form'>
<div class="box-body">
	
		<table border="1" width="100%">
			<tr>
				<td width="150px"><label ><?php echo $objLbl->getLabel("t_fillowlog","isContact","th").":" ?></label></td>
				<td><?=$isContactStatus?></td>
			</tr>
			<tr>
				<td><label ><?php echo $objLbl->getLabel("t_fillowlog","isContact","th").":" ?></label></td>
				<td><?=$isAppointStatus?></td>
			</tr>
			<tr>
				<td><label ><?php echo $objLbl->getLabel("t_fillowlog","helpDescription","th").":" ?></label></td>
				<td><?=$helpDescription?></td>
			</tr>
			<tr>
				<td><label ><?php echo $objLbl->getLabel("t_fillowlog","helpEffective","th").":" ?></label></td>
				<td><?=$isAppointStatus?></td>
			</tr>
		</table>

		<!--<div class='form-group'>
			<label class="col-sm-4"><?php echo $objLbl->getLabel("t_fillowlog","isContact","th").":" ?></label>
			<div class="col-sm-8">
			<?=$isContactStatus?>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-4"><?php echo $objLbl->getLabel("t_fillowlog","isAppoint","th").":" ?></label>
			<div class="col-sm-8">
			<?=$isAppointStatus?>
			</div>
		</div>
	
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_fillowlog","helpDescription","th").":" ?></label>
			<div class="col-sm-12">
				<?=$helpDescription?>
				
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_fillowlog","helpEffective","th").":" ?></label>
			<div class="col-sm-12">
		
				<?=$isAppointStatus?>
			</div>
		</div>-->
		
</div>
</form>

