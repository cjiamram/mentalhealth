<style type="text/css">
.center {
  text-align: center;
}
</style>
<?php
	header("content-type:text/html;charset=UTF-8");

	$value=isset($_GET["successValue"])?$_GET["successValue"]:0;

   if($value>0&&$value<=31){
    echo "<div class='center'><h4 style='color:#30B32D'>ความสำเร็จส่วนบุคคลอยู่ในระดับสูง</h4></div>\n";


  }else
   if($value>31&&$value<=38){
        echo "<div class='center'><h4 style='color:#FFDD00'>ความสำเร็จส่วนบุคคลอยู่ในระดับปานกลาง</h4></div>\n";


   }else
   if($value>38&&$value<=56){
    //
              echo "<div class='center'><h4 style='color:#F03E3E'>ความสำเร็จส่วนบุคคลอยู่ในระดับต่ำ</h4></div>\n";

   }

?>

<script src="../dist/gauge.js"></script>
<div class="center">ระดับคะแนน <?= $value?></div>

<canvas id="cvSuccess" class="center"></canvas>

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
        labels: [31, 38],
        fractionDigits: 0
      },
      staticZones: [
      

         {strokeStyle: "#30B32D", min: 0, max: 31},
         {strokeStyle: "#FFDD00", min: 31, max: 38},
         {strokeStyle: "#F03E3E", min: 38, max: 56},
      ],
      limitMax: false,
      limitMin: false,
      highDpiSupport: true
};
var target = document.getElementById('cvSuccess'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
//gauge.setTextField(document.getElementById("dvSuccess"));
gauge.maxValue = 56; // set max gauge value
gauge.setMinValue(0);  // set min value
gauge.set(<?=$value?>); // set actual value
</script>