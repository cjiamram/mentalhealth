<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/config.php"; 
	$cnf=new Config;
	$rootPath=$cnf->path;
	$departmentCode=isset($_GET["departmentCode"])?$_GET["departmentCode"]:"";
?>

<script>
var datasets=[];
function displaySuicidePie() {
 var url="<?=$rootPath?>/report/getStaffSuicide.php?departmentCode=<?=$departmentCode?>";
 var data=queryData(url);
 //console.log(data);

 if(data!==undefined){
         for(i=0;i<data.length;i++){
            datasets.push({"code":data[i].code,"color":data[i].color,"name": data[i].suicide,y: parseInt(data[i].cnt)});
         }
        var chart = new CanvasJS.Chart("pieStaffSuicide", {
          exportEnabled: true,
          animationEnabled: true,
          title:{
            text: "สัดส่วนความมีแนวโน้มการฆ่าตัวตาย",
            fontFamily:"tahoma",
            fontSize:16,
            fontWeight: "bold"
          },
          legend:{
            cursor: "pointer",
            itemclick: explodePie
          },
          data: [{
             click: function(e){
                renderSuicideGender(e.dataPoint.code,e.dataPoint.name);
            },
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
    displaySuicidePie();
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

<div id="pieStaffSuicide" style="height: 400px; max-width: 800px; margin: 0px auto;"></div>
