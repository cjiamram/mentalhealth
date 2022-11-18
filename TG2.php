
  
  <canvas id="demo" style="width:600px"></canvas>

<script src="dist/gauge.js"></script>
<script>
  var opts = {
   angle: -0.25,
      lineWidth: 0.2,
      radiusScale:0.9,
      pointer: {
        length: 0.6,
        strokeWidth: 0.05,
        color: '#000000'
      },
      staticLabels: {
        font: "10px sans-serif",
        labels: [200, 500, 2100],
        fractionDigits: 0
      },
      staticZones: [
         {strokeStyle: "#F03E3E", min: 0, max: 200},
         {strokeStyle: "#FFDD00", min: 200, max: 500},
         {strokeStyle: "#30B32D", min: 500, max: 2100},
         
      ],
      limitMax: false,
      limitMin: false,
      highDpiSupport: true
};
var target = document.getElementById('demo'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
//document.getElementById("preview-textfield").className = "preview-textfield";
//gauge.setTextField(document.getElementById("preview-textfield"));
gauge.maxValue = 2100; // set max gauge value
gauge.setMinValue(0);  // set min value
gauge.set(500); // set actual value
</script>