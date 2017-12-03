<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script>
$(document).ready(function(){
	$.get('data.php', function (data) {
			values = data.split(",").map(Number);
			Highcharts.chart('container', {
			    chart: {
			        type: 'bar'
			    },
			    title: {
			        text: 'Module-wise Comparison'
			    },
			    xAxis: {
			        categories: [
			            'Arrays',
			            'Variables',
			            'Control and Decisions',
			            'Arithmetic and Expressions',
			            'Classes and Objects',
			            'Methods',
			            'Strings',
			            'Java',
			            'Input/Output',
			            'Primitive DataTypes and DataTypes',
			            'Operators',
			            'Loops'
			        ]
			    },
			    yAxis: [{
			      
			        title: {
			            text: ''
			        }
			    }, {
			    	 min: 0,
			     max: 100,
			     
			    	title: {
			            text: 'Score'
			        }
			    }],
			        
			    legend: {floating:true,
        align: 'center',
        verticalAlign: 'top',
        y: 20,
        layout: 'horizontal'
    },
			    tooltip: {
			        // shared: true
			    },
			    plotOptions: {
			        column: {
			            grouping: false,
			            shadow: false,
			            borderWidth: 0
			        }
			    },
			    series: [{
			        name: 'Proficiency(> Avg)',
			        color: 'Green',
			        minPointLength: 5,
			        data: [{y: values[12], color: getColor(values[12], values[12-12])},
			               {y: values[13], color: getColor(values[13], values[13-12])},
			               {y: values[14], color: getColor(values[14], values[14-12])},
			               {y: values[15], color: getColor(values[15], values[15-12])},
			               {y: values[16], color: getColor(values[16], values[16-12])},
			               {y: values[17], color: getColor(values[17], values[17-12])},
			               {y: values[18], color: getColor(values[18], values[18-12])},
			               {y: values[19], color: getColor(values[19], values[19-12])},
			               {y: values[20], color: getColor(values[20], values[20-12])},
			               {y: values[21], color: getColor(values[21], values[21-12])},
			               {y: values[22], color: getColor(values[22], values[22-12])},
			               {y: values[23], color: getColor(values[23], values[23-12])}
			               ],
			        tooltip: {
			            valuePrefix: '',
			            valueSuffix: ''
			        },
			        pointPadding: -.6,
			        pointPlacement: 0.0,
			        yAxis: 1
			    }, {

			        name: 'Avg Proficiency',
			        color: 'Blue',
			        data: [values[0], values[1], values[2], values[3], values[4], values[5],values[6],values[7],values[8],values[9],values[10],values[11]],
			        tooltip: {
			            valuePrefix: '',
			            valueSuffix: ''
			        },
			        pointPadding: -0.4,
			        pointPlacement: -.2,
			        yAxis: 1
			    },

			    {
			        name: 'Proficiency (< Avg)',
			        color: 'Red'}
			    ]
			});
});
});

function getColor(myValue, average) {
	if (myValue < average) return 'red';
	return 'green'
}
</script>
</head>
<body>
<div>
	<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
</div>	
</body>
</html>