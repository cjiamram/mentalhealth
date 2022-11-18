<?php
include_once "../config/config.php";
include_once "../lib/classAPI.php";
include_once "../config/database.php";
include_once "../objects/classLabel.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
$cnf=new Config();
$questionId=isset($_GET["questionId"])?$_GET["questionId"]:0;
$path="tquestionchoice/getData.php?questionId=".$questionId;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_questionchoice","questionId","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_questionchoice","caption","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_questionchoice","weight","TH")."</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if($data!=""){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["indexNo"].'</td>';
			echo '<td>'.$row["caption"].'</td>';
			echo '<td>'.$row["weight"].'</td>';
			echo "<td>
			<button type='button' class='btn btn-info'
				data-toggle='modal' data-target='#modal-input'
				onclick='readOneChoice(".$row['id'].")'>
				<span class='fa fa-edit'></span>
			</button>
			<button type='button'
				class='btn btn-danger'
				onclick='confirmDeleteChoice(".$row['id'].")'>
				<span class='fa fa-trash'></span>
			</button></td>";
			echo "</tr>";
}
echo "</tbody>";
}
?>
