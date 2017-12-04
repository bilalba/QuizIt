<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 420px; max-width: 600px; height: 400px; margin: 0 auto"></div>

	<?php 
	require 'windRose.php';
	session_start();

$wind = getWindRose(getUserObject($_SESSION['username']));

?>
<div style="display:none">
    <!-- Source: http://or.water.usgs.gov/cgi-bin/grapher/graph_windrose.pl -->
    <table id="freq" border="0" cellspacing="0" cellpadding="0">
        <tr nowrap bgcolor="#CCCCFF">
            <th colspan="9" class="hdr">Table of Frequencies (percent)</th>
        </tr>
        <tr nowrap bgcolor="#CCCCFF">
            <th class="freq" >Direction</th>
            <th class="freq" >Not Started</th>
            <th class="freq">Easy</th>
            <th class="freq">Medium</th>
            <th class="freq">Hard</th>
        </tr>
        <tr nowrap>
            <td class="dir">Arrays</td>
            <td class="data">0.2</td>
            <td class="data"><?php echo $wind[0][1] ?></td>
            <td class="data"><?php echo $wind[0][2] ?></td>
            <td class="data"><?php echo $wind[0][3] ?></td>
           </tr>        
        <tr nowrap bgcolor="#DDDDDD">
            <td class="dir">Variables</td>
            <td class="data">0.2</td>
            <td class="data"><?php echo $wind[1][1] ?></td>
            <td class="data"><?php echo $wind[1][2] ?></td>
            <td class="data"><?php echo $wind[1][3] ?></td>
        </tr>
        <tr nowrap>
            <td class="dir">Control and Decisions</td>
            <td class="data">0.2</td>
            <td class="data"><?php echo $wind[2][1] ?></td>
            <td class="data"><?php echo $wind[2][2] ?></td>
            <td class="data"><?php echo $wind[2][3] ?></td>
            </tr>
        <tr nowrap>
            <td class="dir">Arithmetic and Expressions</td>
            <td class="data">0.2</td>
            <td class="data"><?php echo $wind[3][1] ?></td>
            <td class="data"><?php echo $wind[3][2] ?></td>
            <td class="data"><?php echo $wind[3][3] ?></td>
        </tr>
        <tr nowrap bgcolor="#DDDDDD">
            <td class="dir">Classes and Objects</td>
            <td class="data">0.2</td>
            <td class="data"><?php echo $wind[4][1] ?></td>
            <td class="data"><?php echo $wind[4][2] ?></td>
            <td class="data"><?php echo $wind[4][3] ?></td>
        </tr>
        <tr nowrap>
            <td class="dir">Methods</td>
            <td class="data">0.2</td>
            <td class="data"><?php echo $wind[5][1] ?></td>
            <td class="data"><?php echo $wind[5][2] ?></td>
            <td class="data"><?php echo $wind[5][3] ?></td>
        </tr>
        <tr nowrap bgcolor="#DDDDDD">
            <td class="dir">Strings</td>
            <td class="data">0.2</td>
            <td class="data"><?php echo $wind[6][1] ?></td>
            <td class="data"><?php echo $wind[6][2] ?></td>
            <td class="data"><?php echo $wind[6][3] ?></td>
        </tr>
        <tr nowrap>
            <td class="dir">Java</td>
            <td class="data">0.2</td>
            <td class="data"><?php echo $wind[7][1] ?></td>
            <td class="data"><?php echo $wind[7][2] ?></td>
            <td class="data"><?php echo $wind[7][3] ?></td>
        </tr>
        <tr nowrap bgcolor="#DDDDDD">
            <td class="dir">Input/Output</td>
            <td class="data">0.2</td>
            <td class="data"><?php echo $wind[8][1] ?></td>
            <td class="data"><?php echo $wind[8][2] ?></td>
            <td class="data"><?php echo $wind[8][3] ?></td>
        </tr>
        <tr nowrap>
            <td class="dir">Primitive DataType and DataType</td>
            <td class="data">0.2</td>
            <td class="data"><?php echo $wind[9][1] ?></td>
            <td class="data"><?php echo $wind[9][2] ?></td>
            <td class="data"><?php echo $wind[9][3] ?></td>
        </tr>
        <tr nowrap bgcolor="#DDDDDD">
            <td class="dir">Operators</td>
            <td class="data">0.2</td>
            <td class="data"><?php echo $wind[10][1] ?></td>
            <td class="data"><?php echo $wind[10][2] ?></td>
            <td class="data"><?php echo $wind[10][3] ?></td>
        </tr>
        <tr nowrap>
            <td class="dir">Loops</td>
            <td class="data">0.2</td>
            <td class="data"><?php echo $wind[11][1] ?></td>
            <td class="data"><?php echo $wind[11][2] ?></td>
            <td class="data"><?php echo $wind[11][3] ?></td>
        </tr>        
    
    </table>
</div>

<script>
// Parse the data from an inline table using the Highcharts Data plugin
Highcharts.chart('container', {
    data: {
        table: 'freq',
        startRow: 1,
        endRow: 13,
        endColumn: 4
    },

    chart: {
        polar: true,
        type: 'column'
        ,
         marginTop: 50
    },
    colors:['Red','Orange','Yellow','Green'],

    title: {
        text: 'Progress Chart',
    },

    pane: {
        size: '85%'
    },

    legend: {
    	floating:true,
        align: 'center',
        verticalAlign: 'top',
        y: 20,
        layout: 'horizontal'
    },

    xAxis: {
    
        tickmarkPlacement: 'on'
    },

    yAxis: {
            gridLineColor: 'transparent',
        min: 0,
        max:3.2,
        endOnTick: false,
        showLastLabel: true,
        labels: {
            formatter: function () {
                return '';
            }
        },
        reversedStacks:false
    },

    tooltip: {
        enabled:false
    },

    plotOptions: {
        series: {
            stacking: 'normal',
            shadow: false,
            groupPadding: 0,
            pointPlacement: 'off'
        }
    }
});

</script>
