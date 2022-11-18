
<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";
	$cnf=new Config();
	$api=new ClassAPI();
	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
	$url=$cnf->restURL."data/getAnswerStrength.php?userCode=".$userCode;
	$data=$api->getAPI($url);
	if(!isset($data["message"])){
		echo "<thead>\n";
		echo "<tr>\n";
		echo "<th>No.</th>\n";
		echo "<th>คำถาม</th>\n";
		echo "<th>คำตอบ</th>\n";
		echo "<th>คะแนน</th>\n";
		echo "</tr>\n";
		echo "</thead>\n";
		echo "<tbody>\n";
		foreach ($data as $row) {
					//print_r($row);

			echo "<tr>\n";
			echo "<td>".$row["QNo"]."</td>\n";
			echo "<td>".$row["Caption"]."</td>\n";
			echo "<td>".$row["Answer"]."</td>\n";
			echo "<td align='center'>".$row["Score"]."</td>\n";
			echo "</tr>\n";
		}
		echo "</tbody>\n";
	}

?>

<script>
					setTablePage("#tbRender",8);
					

</script>

