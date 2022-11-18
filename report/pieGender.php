<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/config.php"; 
	$cnf=new Config;
	$rootPath=$cnf->path;
	$faculty=isset($_GET["faculty"])?$_GET["faculty"]:"";
?>

<script>
var datasets=[];
function displayGenderPie() {
 var url="<?=$rootPath?>/report/getStudentGender.php?faculty=<?=$faculty?>";
 var data=queryData(url);
 console.log(data);

 if(data!==undefined){
         for(i=0;i<data.length;i++){
            datasets.push({"name": data[i].gender+":"+data[i].cnt+"-คน", y: parseInt(data[i].cnt)});
         }
        var chart = new CanvasJS.Chart("pieGender", {
          exportEnabled: true,
          animationEnabled: true,
          title:{
            text: "สัดส่วนนักศึกษาแยกตามเพศ",
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
    displayGenderPie();
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

<div id="pieGender" style="height: 400px; max-width: 800px; margin: 0px auto;"></div>
