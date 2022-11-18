<?php
  	header("content-type:text/html;charset=UTF-8");
  	include_once "../config/config.php";
  	$cnf=new Config();
  	$rootPath=$cnf->path;
    $departmentCode=isset($_GET["departmentCode"])?$_GET["departmentCode"]:"";
    $levelCode=isset($_GET["levelCode"])?$_GET["levelCode"]:"";
    $levelName=isset($_GET["levelName"])?$_GET["levelName"]:"ทั้งหมด";
?>

<script>
var datasets=[];




function displaySuicideBar() {
 var url="<?=$rootPath?>/report/getStaffSuicideGender.php?departmentCode=<?=$departmentCode?>&levelCode=<?=$levelCode?>";

 var data=queryData(url);

 if(data!==undefined){

         for(i=0;i<data.length;i++){
            datasets.push({label: data[i].gender, y: parseInt(data[i].cnt)});
         }

        var chart = new CanvasJS.Chart("barSuicideGender", {
          exportEnabled: true,
          animationEnabled: true,
          theme: "light2", // "light1", "light2", "dark1", "dark2"
          title:{
            text: "สัดส่วนระดับความมีแนวโน้มการฆ่าตัวตาย <?=$levelName?>",
            fontFamily:"tahoma",
            fontSize:16,
            fontWeight: "bold"
          },

           axisY: {
              title: "สัดส่วนระดับความมีแนวโน้มการฆ่าตัวตายแยกตามเพศ"
        },
         
          data: [{

                   click: function(e){
                },
                type: "column",  
                showInLegend: true, 
                legendMarkerColor: "grey",
                legendText: "เพศ",
                dataPoints:datasets
          }]
        });
        chart.render();
    }
}

$( document ).ready(function() {
    displaySuicideBar();
});

</script>

<div id="barSuicideGender" style="height: 400px;max-width: 800px; margin: 0px auto;"></div>
