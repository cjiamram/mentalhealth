<head>
	<!-- Load plotly.js into the DOM -->
	<script src='https://cdn.plot.ly/plotly-2.12.1.min.js'></script>
</head>

<body>
	<div id='myDiv'><!-- Plotly chart will be drawn inside this DIV --></div>
</body>

<script>
var data = [
  {
    domain: { x: [0, 1], y: [0, 1] },
    value: 25,
    title: { text: "Speed" },
    type: "indicator",
    mode: "gauge+number",
    gauge: {
      axis: { range: [null, 30] },
      steps: [
        { range: [0, 16], color: "green" },
        { range: [16, 26], color: "yellow" },
        { range: [26, 30], color: "red" }
      ],
      threshold: {
        line: { color: "red", width: 4 },
        thickness: 0.75,
        value: 27
      }
    }
  }
];

var layout = { width: 600, height: 450, margin: { t: 0, b: 0 } };
Plotly.newPlot('myDiv', data, layout);


</script>