<style type="text/css">
.center {
  text-align: center;
}
</style>
<?php
  
  header("content-type:text/html;charset=UTF-8");

  $value=isset($_GET["personalLackValue"])?$_GET["personalLackValue"]:0;

   if($value>0&&$value<=6){
          echo "<div class='center'><h4 style='color:#30B32D'>การลดความเป็นบุคคลอยู่ในระดับต่ำ</h4></div>\n";


  }else
   if($value>6&&$value<=12){
        echo "<div class='center'><h4 style='color:#FFDD00'>การลดความเป็นบุคคลอยู่ในระดับปานกลาง</h4></div>\n";


   }else
   if($value>12&&$value<=35){
          echo "<div class='center'><h4 style='color:#F03E3E'>การลดความเป็นบุคคลอยู่ในระดับสูง</h4></div>\n";

   }


?>

<script src="../dist/gauge.js"></script>

<div class="center">ระดับคะแนน <?=  $value?></div>

<canvas id="cvPersonal" class="center"></canvas>
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
        labels: [6, 12],
        fractionDigits: 0
      },
      staticZones: [
         {strokeStyle: "#30B32D", min: 0, max: 6},
         {strokeStyle: "#FFDD00", min: 6, max: 12},
         {strokeStyle: "#F03E3E", min: 12, max: 35},
      ],
      limitMax: false,
      limitMin: false,
      highDpiSupport: true
};
var target = document.getElementById('cvPersonal'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
//document.getElementById("dvEmotional").className = "dvEmotional";
//gauge.setTextField(document.getElementById("dvEmotional"));
gauge.maxValue = 35; // set max gauge value
gauge.setMinValue(0);  // set min value
gauge.set(<?=$value?>); // set actual value
</script>