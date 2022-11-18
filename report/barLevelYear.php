<?php
  	header("content-type:text/html;charset=UTF-8");
  	include_once "../config/config.php";
  	$cnf=new Config();
  	$rootPath=$cnf->path;
  	$faculty=isset($_GET["faculty"])?$_GET["faculty"]:"";
?>

<script>
var datasets=[];




function displayBar() {
 var url="<?=$rootPath?>/report/getLevelYear.php?faculty=<?=$faculty?>";
 var data=queryData(url);

 if(data!==undefined){

         for(i=0;i<data.length;i++){
            datasets.push({label: data[i].LevelYear, y: parseInt(data[i].cnt)});
         }

        var chart = new CanvasJS.Chart("barLevelYear", {
          exportEnabled: true,
          animationEnabled: true,
          theme: "light2", // "light1", "light2", "dark1", "dark2"
          title:{
            text: "แผนภูมิการทำแบบทดสอบตามชั้นปี",
            fontFamily:"tahoma",
            fontSize:16,
            fontWeight: "bold"
          },

           axisY: {
              title: "จำนวนนักศึกษา"
        },
         
          data: [{

                   click: function(e){
                     setPieDepartmentByYear(e.dataPoint.label);
                     setPiePTypeByYear(e.dataPoint.label);
                },
                type: "column",  
                showInLegend: true, 
                legendMarkerColor: "grey",
                legendText: "ชั้นปี",
                dataPoints:datasets
          }]
        });
        chart.render();
    }
}

$( document ).ready(function() {
    displayBar();
});

</script>

<div id="barLevelYear" style="height: 400px;max-width: 800px; margin: 0px auto;"></div>
