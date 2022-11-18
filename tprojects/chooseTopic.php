<?php
include_once "../config/config.php";
include_once "../lib/classAPI.php";
include_once "../config/database.php";
include_once "../objects/classLabel.php";
include_once "../objects/manage.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
$cnf=new Config();
$projectGroupId=isset($_GET["projectGroupId"])?$_GET["projectGroupId"]:0;
$path="tprojects/getDataWithoutSub.php?projectGroupId=".$projectGroupId;
$url=$cnf->restURL.$path;

//print_r($url);

$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_projects","ProjectName","TH")."</th>";
			echo "<th>เพิ่ม</th>";
		echo "</tr>";
echo "</thead>";
if(!isset($data["message"])){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["ProjectName"].'</td>';
			echo "<td>
			<button type='button' class='btn btn-info'
				data-toggle='modal' 
				onclick='chooseOne(".$row['id'].")'>
				<span class='fa fa-chevron-circle-right'></span>
			</button>
			</td>";
			echo "</tr>";
}
echo "</tbody>";
}
?>
