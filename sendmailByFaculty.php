<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	include_once "vendor/autoload.php"; //important


	use PHPMailer\PHPMailer\PHPMailer; //important, on php files with more php stuff move it to the top
	use PHPMailer\PHPMailer\SMTP; //important, on php files with more php stuff move it to the top
	date_default_timezone_set('Etc/UTC');

	include_once "objects/tconsult.php";
	include_once "config/database.php";
	include_once "config/config.php";
	include_once "objects/tfullname.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tconsult($db);

	$cnf=new Config();
	$restURL=$cnf->restURL;




	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"6340122126";
	$userType=isset($_GET["userType"])?$_GET["userType"]:1;
	$faculty=isset($_GET["faculty"])?$_GET["faculty"]:"";
	$stmt=$obj->getDataByFaculty($faculty);

	if($userType!=1)
		$url=$restURL."/indexReport.php?userCode=".$userCode;
	else
		$url=$restURL."/indexStudentReport.php?userCode=".$userCode;


	$objT=new tfullname($db);
	$stmtT=$objT->getFullName($userCode);

	$mail = new PHPMailer(true); //important
	$mail->CharSet = 'UTF-8';  //not important
	$mail->isSMTP(); //important
	$mail->Host = 'smtp.office365.com'; //important
	$mail->Port       = 587; //important
	$mail->SMTPSecure = 'tls'; //important
	$mail->SMTPAuth   = true; //important, your IP get banned if not using this
	$mail->IsHTML(true);  

	$mail->Username = 'NRRUBot@nrru.ac.th';
	$mail->Password = 'Nrru2021';

	$mail->SetFrom('NRRUBot@nrru.ac.th', 'รายงานผลการคุดกรองสุขภาพจิต'); //you need "send to" permission on that account, if dont use yourname@mail.org


	if($stmt->rowCount()>0){
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$mail->addAddress($email, $description);
		}
	}

	//$mail->addAddress("chatchai.j@nrru.ac.th", "Paticipants");
	$mail->Subject = 'รายงานผลการคุดกรองสุขภาพจิต';

	$strT= "<table width='500px' border='1'>\n";
	if($stmtT->rowCount()>0){
		$row=$stmtT->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$strT.= "<tr><td colspan='2'><h2 style='color:blue'>ผลการคัดกรองสุขภาพจิต</h2></td></tr>\n";
		$strT.= "<tr><td width='150px'><h3>ชื่อ-สกุล</h3></td><td>".$fullName."</td></tr>\n";
		$strT.= "<tr><td width='150px'><h3>หน่วยงาน</h3></td><td>".$departmentName."</td></tr>\n";
		$strLink="<a href='".$url."'><h2 style='color:green'>รายการการคัดครองสุขภาพจิต</h2></a>";
		$strT.= "<tr><td colspan='2'>".$strLink."</td></tr>\n";

	}
	$strT.= "</table>\n";



	$mail->Body=$strT;

	if (!$mail->send()){
		echo json_encode(array("message"=>false,"errInfo"=> $mail->ErrorInfo));
	} else{
		echo json_encode(array("message"=>true));
	}

?>