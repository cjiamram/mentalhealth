<?php
  	header("content-type:text/html;charset=UTF-8");
  	include_once "../config/config.php";
  	$cnf=new Config();
  	$rootPath=$cnf->path;
  	$departmentCode=isset($_GET["departmentCode"])?$_GET["departmentCode"]:"";
?>

<script>
var datasets=[];




function displayBar() {
 var url="<?=$rootPath?>/report/getStaffAgeRange.php?departmentCode=<?=$departmentCode?>";
 var data=queryData(url);

 if(data!==undefined){

         for(i=0;i<data.length;i++){
            datasets.push({label: data[i].ageRange, y: parseInt(data[i].cnt)});
         }

        var chart = new CanvasJS.Chart("barAgeRange", {
          exportEnabled: true,
          animationEnabled: true,
          theme: "light2", // "light1", "light2", "dark1", "dark2"
          title:{
            text: "แผนภูมิการทำแบบทดสอบตามช่วงอายุ",
            fontFamily:"tahoma",
            fontSize:16,
            fontWeight: "bold"
          },

           axisY: {
              title: "จำนวนนักศึกษา"
        },
         
          data: [{

                   click: function(e){
                     //setPieDepartmentByYear(e.dataPoint.label);
                     //setPiePTypeByYear(e.dataPoint.label);
                },
                type: "column",  
                showInLegend: true, 
                legendMarkerColor: "grey",
                legendText: "ช่วงอายุ",
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

<div id="barAgeRange" style="height: 400px;max-width: 800px; margin: 0px auto;"></div>
