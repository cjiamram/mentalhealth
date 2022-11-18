<style type="text/css">
.center {
  text-align: center;
}
</style>
<?php
	header("content-type:text/html;charset=UTF-8");

	$value=isset($_GET["suicideValue"])?$_GET["suicideValue"]:0;

  if($value==0){
            echo "<div class='center'><h4 style='color:#00B900'>ไม่มีแนวโน้มการฆ่าตัวตาย</h4></div>\n";
  }
  else
  if($value>0&&$value<=7){
        echo "<div class='center'><h4 style='color:#00B900'>มีแนวโน้มจะฆ่าตัวตายในปัจจุบันในระดับน้อย</h4></div>\n";
  }else
  if($value>7&&$value<=12){
        echo "<div class='center'><h4 style='color:#FFDD00'>มีแนวโน้มจะฆ่าตัวตายในปัจจุบันในระดับปานกลาง</h4></div>\n";
  }else
  if($value>12&&$value<=18){
        echo "<div class='center'><h4 style='color:#F03E3E'>มีแนวโน้มจะฆ่าตัวตายในปัจจุบันในระดับรุนแรง</h4></div>\n";
  } 
  

?>

<script src="../dist/gauge.js"></script>
<div class="center">ระดับคะแนน <?= $value?></div>
<canvas id="cvSuicide9Q" class="center"></canvas>
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
        labels: [7,16],
        fractionDigits: 0
      },
      staticZones: [
         {strokeStyle: "#00B900", min: 0, max: 8},
         {strokeStyle: "#FFDD00", min: 8, max: 16},
         {strokeStyle: "#F03E3E", min: 16, max: 52},
      ],
      limitMax: false,
      limitMin: false,
      highDpiSupport: true
};
var target = document.getElementById('cvSuicide9Q'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 52; // set max gauge value
gauge.setMinValue(0);  // set min value
gauge.set(<?=$value?>); // set actual value
</script>