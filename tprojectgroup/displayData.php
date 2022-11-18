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
$keyword=isset($_GET["keyWord"])?$_GET["keyWord"]:"";
$path="tprojectgroup/getData.php?keyWord=".$keyword;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_projectgroup","ProjectGroup","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_projectgroup","Owner","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_projectgroup","Objective","TH")."</th>";
			echo "<th width='150px'>".$objLbl->getLabel("t_projectgroup","CreateDate","TH")."</th>";
			echo "<th width='150px'>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if(!isset($data["message"])){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["ProjectGroup"].'</td>';
			echo '<td>'.$row["Owner"].'</td>';
			echo '<td>'.$row["Objective"].'</td>';
			echo '<td>'.Format::getTextDate($row["CreateDate"]).'</td>';
			echo "<td>
			<button type='button' class='btn btn-success'
				data-toggle='modal' data-target='#modal-groupSub'
				onclick='chooseTopic(".$row['id'].")'>
				<span class='fa fa-list-ol'></span>
			</button>
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
