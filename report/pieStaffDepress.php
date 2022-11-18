<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/config.php"; 
	$cnf=new Config;
	$rootPath=$cnf->path;
	$departmentCode=isset($_GET["departmentCode"])?$_GET["departmentCode"]:"";
?>

<script>
var datasets=[];
function displayDepressPie() {
 var url="<?=$rootPath?>/report/getStaffDepress.php?departmentCode=<?=$departmentCode?>";
 var data=queryData(url);

 if(data!==undefined){
         for(i=0;i<data.length;i++){
            datasets.push({"name": data[i].depress,"code":data[i].code,"color":data[i].color, y: parseInt(data[i].cnt)});
         }
        var chart = new CanvasJS.Chart("pieStaffDepress", {
          exportEnabled: true,
          animationEnabled: true,
          title:{ 
            text: "สัดส่วนระดับความซึมเศร้า",
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
                    renderDepressGender(e.dataPoint.code,e.dataPoint.name);
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
    displayDepressPie();
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

<div id="pieStaffDepress" style="height: 400px; max-width: 800px; margin: 0px auto;"></div>
