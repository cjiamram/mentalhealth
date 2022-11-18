<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/config.php"; 
	$cnf=new Config;
	$rootPath=$cnf->path;
	$departmentCode=isset($_GET["departmentCode"])?$_GET["departmentCode"]:"";
  $levelCode=isset($_GET["levelCode"])?$_GET["levelCode"]:"";
  $levelName=isset($_GET["levelName"])?$_GET["levelName"]:"";


?>

<script>
var datasets=[];
function displayDepressPieGender() {
 var url="<?=$rootPath?>/report/getStaffDepressGender.php?departmentCode=<?=$departmentCode?>&levelCode=<?=$levelCode?>&levelName=<?=$levelName?>";
 var data=queryData(url);
 console.log(data);

 if(data!==undefined){
         for(i=0;i<data.length;i++){
            datasets.push({"name": data[i].gender,"code":data[i].code, y: parseInt(data[i].cnt)});
         }
        var chart = new CanvasJS.Chart("pieStaffDepressGender", {
          exportEnabled: true,
          animationEnabled: true,
          title:{
            text: "สัดส่วนระดับความซึมเศร้า <?=$levelName?>",
            fontFamily:"tahoma",
            fontSize:16,
            fontWeight: "bold"
          },
          legend:{
            cursor: "pointer",
            itemclick: explodePie
          },
          data: [{
            
            
            type: "pie",
            showInLegend: true,
            indexLabel: "{name}:#percent%",
            toolTipContent: "{name}: <strong>{y} .</strong>",
            dataPoints:datasets
          }]
        });
        chart.render();
  }
}

$( document ).ready(function() {
    displayDepressPieGender();
});

function explodePie (e) {
  if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
    e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
  } else {
    e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
  }
  e.chart.render();

}
</script>

<div id="pieStaffDepressGender" style="height: 400px; max-width: 800px; margin: 0px auto;"></div>
