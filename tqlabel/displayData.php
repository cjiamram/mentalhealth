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
$projectId=isset($_GET["projectId"])?$_GET["projectId"]:0;
$path="tqlabel/getData.php?projectId=".$projectId;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			//echo "<th>".$objLbl->getLabel("t_qlabel","projectId","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_qlabel","choiceNo","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_qlabel","label","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_qlabel","weight","TH")."</th>";

			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if($data!=""){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			//echo '<td>'.$row["projectId"].'</td>';
			echo '<td>'.$row["choiceNo"].'</td>';
			echo '<td>'.$row["label"].'</td>';
			echo '<td>'.$row["weight"].'</td>';

			echo "<td>
			<button type='button' class='btn btn-info'
				onclick='readOneLabel(".$row['id'].")'>
				<span class='fa fa-edit'></span>
			</button>
			<button type='button'
				class='btn btn-danger'
				onclick='confirmLabelDelete(".$row['id'].")'>
				<span class='fa fa-trash'></span>
			</button></td>";
			echo "</tr>";
}
echo "</tbody>";
}
?>
