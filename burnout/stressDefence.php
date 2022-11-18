<style type="text/css">
.center {
  text-align: center;
}
</style>
<?php
	header("content-type:text/html;charset=UTF-8");

	$value=isset($_GET["stressDefenceValue"])?$_GET["stressDefenceValue"]:0;

  if($value>=1.00&&$value<=1.75){
        echo "<div class='center'><h4 style='color:#00B900'>นักศึกษาใช้วิธีเผชิญความเครียดนั้นต่ํา</h4></div>\n";
  }else
  if($value>1.75&&$value<=2.50){
        echo "<div class='center'><h4 style='color:#76B901'>นักศึกษาใช้วิธีเผชิญความเครียระดับปานกลาง</h4></div>\n";
  }else
  if($value>2.50&&$value<=3.25){
        echo "<div class='center'><h4 style='color:#FFDD00'>นักศึกษาใช้วิธีเผชิญความเครียระดับปานกลางถึงสูง</h4></div>\n";
  }else 
  if($value>3.25){
        echo "<div class='center'><h4 style='color:#F03E3E'>นักศึกษาใช้วิธีเผชิญความเครียดนั้นค่อนข้างสูง</h4></div>\n";
  }

?>

<script src="../dist/gauge.js"></script>
<div class="center">ระดับคะแนน <?= $value?></div>
<canvas id="cvStressDefence" class="center"></canvas>
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
        labels: [1.75,2.50,3.25],
        fractionDigits: 0
      },
      staticZones: [
         {strokeStyle: "#00B900", min: 0, max: 1.75},
         {strokeStyle: "#76B901", min: 1.75, max: 2.50},
         {strokeStyle: "#FFDD00", min: 2.50, max: 3.25},
         {strokeStyle: "#F03E3E", min: 3.26, max: 4.00},
      ],
      limitMax: false,
      limitMin: false,
      highDpiSupport: true
};
var target = document.getElementById('cvStressDefence'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 4.00; // set max gauge value
gauge.setMinValue(0);  // set min value
gauge.set(<?=$value?>); // set actual value
</script>