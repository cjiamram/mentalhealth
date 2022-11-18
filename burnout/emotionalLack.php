<style type="text/css">
.center {
  text-align: center;
}
</style>
<?php
	header("content-type:text/html;charset=UTF-8");

  $value=isset($_GET["emotionalLackValue"])?$_GET["emotionalLackValue"]:0;


  
  if($value>0&&$value<=16){
    echo "<div class='center'><h4 style='color:#30B32D'>ความอ่อนล้าทางอารมณ์อยู่ในระดับต่ำ</h4></div>\n";


  }else
   if($value>16&&$value<=27){
        echo "<div class='center'><h4 style='color:#FFDD00'>ความอ่อนล้าทางอารมณ์อยู่ในระดับปานกลาง</h4></div>\n";


   }else
   if($value>27&&$value<=63){
              echo "<div class='center'><h4 style='color:#F03E3E'>ความอ่อนล้าทางอารมณ์อยู่ในระดับสูง</h4></div>\n";

   }


?>


<script src="../dist/gauge.js"></script>

<div class="center">ระดับคะแนน <?=  $value?></div>
<canvas  id="cvEmotional" class="center"></canvas>



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
        labels: [16,27],
        fractionDigits: 0
      },
      staticZones: [
         {strokeStyle: "#30B32D", min: 0, max: 16},
         {strokeStyle: "#FFDD00", min: 16, max: 27},
         {strokeStyle: "#F03E3E", min: 27, max: 63},
      ],
      limitMax: false,
      limitMin: false,
      highDpiSupport: true
};
var target = document.getElementById('cvEmotional'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
//gauge.setTextField(document.getElementById("dvEmotional"));
gauge.maxValue = 63; // set max gauge value
gauge.setMinValue(0);  // set min value
gauge.set(<?=$value?>); // set actual value
</script>