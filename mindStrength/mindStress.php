<style type="text/css">
.center {
  text-align: center;
}
</style>

<script src="../dist/gauge.js"></script>
<?php
	header("content-type:text/html;charset=UTF-8");

	$value=isset($_GET["mindStress"])?$_GET["mindStress"]:0;



?>
<div class="center">
<?php
  if($value>=0&&$value<=4){
        echo "<h4 style='color:#30B32D'>มีความเครียดน้อย</h4>\n";
  }else
  if($value>4&&$value<=7){
        echo "<h4 style='color:#FFDD00'>มีความเครียดปานกลาง</h4>\n";
  }else
  if($value>7&&$value<=9){
        echo "<h4 style='color:#ea7437'>มีความเครียดปานกลางถึงสูง</h4>\n";
  }else
  if($value>9&&$value<=15){
        echo "<h4 style='color:#F03E3E'>มีความเครียดสูง</h4>\n";
  }

?>
</div>
<div class="center">ระดับคะแนน <?= $value?></div>

<canvas id="cvMindStrength" class="center"></canvas>

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
        labels: [4, 7, 9],
        fractionDigits: 0
      },
      staticZones: [
      

         {strokeStyle: "#30B32D", min: 0, max: 4},
         {strokeStyle: "#FFDD00", min: 4, max: 7},
         {strokeStyle: "#ea7437", min: 7, max: 9},
         {strokeStyle: "#F03E3E", min: 9, max: 15},
      ],
      limitMax: false,
      limitMin: false,
      highDpiSupport: true
};
var target = document.getElementById('cvMindStrength'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 15; // set max gauge value
gauge.setMinValue(0);  // set min value
gauge.set(<?=$value?>); // set actual value
</script>