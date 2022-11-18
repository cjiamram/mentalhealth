<style type="text/css">
.center {
  text-align: center;
}
</style>
<?php
	header("content-type:text/html;charset=UTF-8");
	$value=isset($_GET["mindStrength"])?$_GET["mindStrength"]:0;

  //print_r($value);

  if($value>0&&$value<=16){
    //
          echo "<div class='center' style='color:#F03E3E'><h4 >ระดับต่ำ หมายถึง ต่ำกว่าคนส่วนใหญ่ ควรพัฒนาให้ดีขึ้น</h4></div>\n";

  }else
   if($value>16&&$value<=27){
        echo "<div class='center'><h4 style='color:#FFDD00'>ระดับปานกลาง หมายถึง ระดับเดียวกับคนส่วนใหญ่</h4></div>\n";


   }else
   if($value>27&&$value<=30){
          echo "<div class='center' style='color:#30B32D'><h4 >ระดับสูง หมายถึง ดีกว่าคนส่วนใหญควรได้รับการสนับสนุนให้คงรักษาไว้</h4></div>\n";

   }

?>

<script src="../dist/gauge.js"></script>
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
        labels: [16, 27],
        fractionDigits: 0
      },
      staticZones: [
      

         {strokeStyle: "#F03E3E", min: 0, max: 16},
         {strokeStyle: "#FFDD00", min: 16, max: 27},
         {strokeStyle: "#30B32D", min: 27, max: 30},
      ],
      limitMax: false,
      limitMin: false,
      highDpiSupport: true
};
var target = document.getElementById('cvMindStrength'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 30; // set max gauge value
gauge.setMinValue(0);  // set min value
gauge.set(<?=$value?>); // set actual value
</script>