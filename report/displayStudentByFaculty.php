<?php
	include_once "../config/config.php";
	$cnf=new Config();
	$rootPath=$cnf->path;
?>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="./jprogress/jquery.lineProgressbar.js"></script>
<link rel="stylesheet" href="<?=$rootPath?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script src="<?=$rootPath?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$rootPath?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<style>
body { font-family:'Roboto';}
.container {width:100%;}
</style>
<div class="jquery-script-ads"><script type="text/javascript"><!--
google_ad_client = "ca-pub-2783044520727903";
/* jQuery_demo */
google_ad_slot = "2780937993";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
</div>
 <div class="box box-warning">
      <div class="box-header with-border">
      <h3 class="box-title"><b>รายงานสรุปหัวข้อการประเมินผล</b></h3>
      </div>
<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";

	$cnf=new Config();
	$api=new ClassAPI();
	//$surveyDate=isset($_GET["surveyDate"])?$_GET["surveyDate"]:date("Y-m-d");
	
	$faculty=isset($_GET["faculty"])?$_GET["faculty"]:"";

	$url=$cnf->restURL."report/getStudentByFaculty.php?faculty=".$faculty;

	//print_r($url);

	$data=$api->getAPI($url);
	$bArr=array();
	$sArr=array();
	$dArr=array();
	$suArr=array();
	$stArr=array();
	$dfArr=array();

	echo "<div class=\"container\">";

	if(!isset($data["message"])){
		echo "<table id=\"tblDisplay\" class=\"table table-bordered table-hover\">\n";
		echo "<tr>\n";
		echo "<th>No.</th>\n";
		echo "<th>ชื่อ/สกุล.</th>\n";
		echo "<th>หน่วยงาน/คณะ.</th>\n";
		echo "<th>ความเครียด</th>\n";
		echo "<th>ภาวะความซึมเศร้า</th>\n";
		echo "<th>ภาวะการฆ่าตัวตาย</th>\n";
		echo "<th>ความเข้มแข็งทางใจ</th>\n";
		echo "<th>การเผชิญความเครียด</th>\n";
		echo "</tr>\n";
		echo "<tbody>\n";
		$i=1;
		foreach ($data as $row) {
			echo "<tr>\n";

			echo "<td align='center' width='50px'>".$i."</td>\n";
			echo "<td >".$row["fullName"]."</td>\n";
			echo "<td width='150px'>".$row["departmentName"]."</td>\n";
			

			
			array_push($sArr, $row["strengthDef"]);
			$strS="<h5>".$row["strengthDef"]["description"]."</h5>\n";
			$strS.="<div id='dS".$i."' style=\"text-align:left\"></div>";
			echo "<td width=\"12%\">".$strS."</td>\n";
		
			$strD="<h5>".$row["depressDef"]["description"]."</h5>\n";
			$strD.="<div id='dD".$i."'></div>";
			array_push($dArr, $row["depressDef"]);

			echo "<td width=\"12%\">".$strD."</td>\n";
			$strSU="<h5>".$row["suicideDef"]["description"]."</h5>\n";
			$strSU.="<div id='dSU".$i."'></div>";
			array_push($suArr, $row["suicideDef"]);
			
			echo "<td width=\"12%\">".$strSU."</td>\n";
			array_push($stArr, $row["strengthDef"]);
			$strST="<h5>".$row["strengthDef"]["description"]."</h5>\n";
			$strST.="<div id='dST".$i."'></div>";
			echo "<td width=\"12%\">".$strST."</td>\n";
			
			array_push($dfArr, $row["defenseStressDef"]);
			$strDF="<h5>".$row["defenseStressDef"]["description"]."</h5>\n";
			$strDF.="<div id='dDF".$i."'></div>";
			echo "<td width=\"12%\">".$strDF."</td>\n";
			echo "</tr>\n";

			$i++;
		}
		echo "</tbody>\n";
		echo "</table>\n";
	}
	echo "</div>\n";

	/*echo "<script>\n";
		$j=1;
		foreach ($bArr as $r) {
					echo "$('#dB".$j."').LineProgressbar({
					percentage:".$r["percentage"].",
					radius: '3px',
					height: '25px',
					fillBackgroundColor: '".$r["color"]."'

				});\n";
			$j++;
		}


		$j=1;
		foreach ($sArr as $r) {
					echo "$('#dS".$j."').LineProgressbar({
					percentage:".$r["percentage"].",
					radius: '3px',
					height: '25px',
					fillBackgroundColor: '".$r["color"]."'

				});\n";
			$j++;
		}


		$j=1;
		foreach ($dArr as $r) {
					echo "$('#dD".$j."').LineProgressbar({
					percentage:".$r["percentage"].",
					radius: '3px',
					height: '25px',
					fillBackgroundColor: '".$r["color"]."'

				});\n";
			$j++;
		}

		$j=1;
		foreach ($suArr as $r) {
					echo "$('#dSU".$j."').LineProgressbar({
					percentage:".$r["percentage"].",
					radius: '3px',
					height: '25px',
					fillBackgroundColor: '".$r["color"]."'

				});\n";
			$j++;
		}

		$j=1;
		foreach ($stArr as $r) {
					echo "$('#dST".$j."').LineProgressbar({
					percentage:".$r["percentage"].",
					radius: '3px',
					height: '25px',
					fillBackgroundColor: '".$r["color"]."'

				});\n";
			$j++;
		}


		$j=1;
		foreach ($dfArr as $r) {
					echo "$('#dDF".$j."').LineProgressbar({
					percentage:".$r["percentage"].",
					radius: '3px',
					height: '25px',
					fillBackgroundColor: '".$r["color"]."'

				});\n";
			$j++;
		}


	echo "</script>\n";*/


?>
</div>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

  setTablePage("#tblDisplay",50);


</script>