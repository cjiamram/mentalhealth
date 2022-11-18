<?php
	include_once "../config/config.php";
	$cnf=new Config();
	$rootPath=$cnf->path;
?>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<style>
body { font-family:'Roboto';}
.container {width:100%;}
</style>
<div class="jquery-script-ads"><script type="text/javascript"><!--

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
	$faculty=isset($_GET["faculty"])?$_GET["faculty"]:"";
	$url=$cnf->restURL."report/getStudentByFaculty.php?faculty=".$faculty;
	$data=$api->getAPI($url);
	$bArr=array();
	$sArr=array();
	$dArr=array();
	$suArr=array();
	$stArr=array();
	$dfArr=array();

	echo "<div class=\"container\">";

	if(!isset($data["message"])){
		echo "<table id=\"tblExport\" class=\"table table-bordered table-hover\">\n";
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

	


?>
</div>

<script type="text/javascript">

function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
exportTableToExcel('tblExport','STD');


</script>

