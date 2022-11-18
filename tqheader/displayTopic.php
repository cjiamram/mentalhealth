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
$ProjectCode=isset($_GET["ProjectCode"])?$_GET["ProjectCode"]:"";
$path="tqheader/getData.php?ProjectCode=".$ProjectCode;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);

//print_r($data["message"]);

echo "<thead>";
		echo "<tr>";
			echo "<th width='70px'>No.</th>";
			echo "<th width='80px'>".$objLbl->getLabel("t_qheader","QuestionNo","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_qheader","HeaderCaption","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_qheader","ProjectCode","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_qheader","Description","TH")."</th>";
			echo "<th width='150px'>".$objLbl->getLabel("t_qheader","Qtype","TH")."</th>";
			echo "<th width='150px'>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if(isset($data["message"])==false){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td><input type=\'text\' class="form-control" value='.$row["QuestionNo"].'></td>';
			echo '<td>'.$row["HeaderCaption"].'</td>';
			echo '<td>'.$row["ProjectCode"].'</td>';
			echo '<td>'.$row["Description"].'</td>';
			echo '<td>'.$row["Qtype"].'</td>';
			echo "<td>
			<button type='button' class='btn btn-info'
				data-toggle='modal' data-target='#modal-input'
				onclick='readOne(".$row['id'].")'>
				<span class='fa fa-edit'></span>
			</button>
			<button type='button'
				class='btn btn-danger'
				onclick='confirmDelete(".$row['id'].")'>
				<span class='fa fa-trash'></span>
			</button></td>";
			echo "</tr>";
}
echo "</tbody>";
}
?>
