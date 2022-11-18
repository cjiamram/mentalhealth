<style type="text/css">
.center {
  text-align: center;
}
</style>
<?php
	header("content-type:text/html;charset=UTF-8");

  $value=isset($_GET["totalBurnOut"])?$_GET["totalBurnOut"]:0;


  
  if($value>0&&$value<=53){
    echo "<div class='center'><h4 style='color:#30B32D'>ความเหนื่อยหน่ายอยู่ในระดับต่ำ</h4></div>\n";


  }else
   if($value>53&&$value<=78){
        echo "<div class='center'><h4 style='color:#FFDD00'>ความเหนื่อยหน่ายอยู่ในระดับปานกลาง</h4></div>\n";


   }else
   if($value>78){
        echo "<div class='center'><h4 style='color:#F03E3E'>ความเหนื่อยหน่ายอยู่ในระดับสูง</h4></div>\n";

   }


?>


<script src="../dist/gauge.js"></script>

<div class="center">ระดับคะแนน <?=  $value?></div>
<canvas  id="cvTotal" class="center"></canvas>



<script>
  var opts = {
   angle: 0.25,
      lineWidth: 0.2,
      radiusScale:0.9,
      pointer: {
        length: 0.6,
        strokeWidth: 0.05,
        color: '#000000'
      },
      staticLabels: {
        font: "10px sans-serif",
        labels: [53,78],
        fractionDigits: 0
      },
      staticZones: [
         {strokeStyle: "#30B32D", min: 0, max: 53},
         {strokeStyle: "#FFDD00", min: 53, max: 78},
         {strokeStyle: "#F03E3E", min: 78, max: 132},
      ],
      limitMax: false,
      limitMin: false,
      highDpiSupport: true
};
var target = document.getElementById('cvTotal'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 132; // set max gauge value
gauge.setMinValue(0);  // set min value
gauge.set(<?=$value?>); // set actual value
</script>