<!DOCTYPE html>
<html lang="en">
<head>
<style>
	.jred
	{
		background-color:#FF6633;
	}
	.jblue
	{
		background-color:#33CCFF;
	}
</style>


    <script src="cm.js"></script>
    <link rel="stylesheet" href="codemirror-3.1/lib/codemirror.css">
    <script src="codemirror-3.1/lib/codemirror.js"></script>
    <script src="codemirror-3.1/addon/hint/show-hint.js"></script>
    <script src="codemirror-3.1/mode/xml/xml.js"></script>
    <link rel="stylesheet" href="codemirror-3.1/addon/hint/show-hint.css">
    <script src="codemirror-3.1/addon/hint/javascript-hint.js"></script>
    <script src="codemirror-3.1/mode/javascript/javascript.js"></script>
    <script src="codemirror-3.1/addon/fold/foldcode.js"></script>


  	<title>SandBox</title>
  	<meta charset="utf-8">
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.7.1.min.js"></script><script src="js/script.js"></script>
    


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>


<script type="text/javascript">
function Usage()
{
  jQuery(document).ready(function() {
	var chart;
	var previous_ti;
        var lines;
        var items;
        var itemNo;
        var line;
	var lineNo;
        var options;
    graph_title = "Tests ran per day";
    var options = {
      chart: {
              type: 'column',
	      zoomType: 'x',
              renderTo: 'container2',
      },
        legend: {
	    enabled: true,
             },
      title: {
        text: graph_title
      },
            tooltip: {
                shared: true
            },	
	scrollbar: {
	enabled: true
	},
      xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { 
    		day:"%b %e",
    		week:"%b %e, %Y",
    		month:"%B %Y",
    		year:"%Y"
                }
           
      },
        yAxis:[{ // Secondary yAxis
                gridLineWidth: 1,
                title: {
                    text: 'Tests Ran per day',
                },
            }],
      series: [{
		name: 'All users',
                type: 'column',
		dataGrouping: { 
			enabled: true, 
			groupPixelWidth: 40,
			approximation: "average",
		},
		tooltip: { valueDecimals: 1 },
		data: []
	},{
		name: 'Passed',
                type: 'column',
		dataGrouping: { 
			enabled: true, 
			groupPixelWidth: 40,
			approximation: "average",
		},
		tooltip: { valueDecimals: 1 },
		data: []
	},{
		name: 'Development',
                type: 'column',
		dataGrouping: { 
			enabled: true, 
			groupPixelWidth: 40,
			approximation: "average",
		},
		tooltip: { valueDecimals: 1 },
		data: []
	}],
    };
	var array_data =[];
	file2 = "http://joao-lnx/site_pro/mysql_query/by_submittion.php";
    jQuery.get(file2, function(data) {
       lines = data.split('<b>');
      jQuery.each(lines, function(lineNo, line) {
          items = line.split(',');
          jQuery.each(items, function(itemNo, item) {
	    if (itemNo == 0) {
                item =parseInt(item); 
		if ( item > 0  ) {
             	   time_ti = item * 1000;
		} else {
			time_ti = 0 ;
		}
            }

            if (itemNo == 1) {
                item =parseInt(item); 
		if (item >= 0 && time_ti > 0 ) options.series[0].data.push([time_ti,item]);
            }  
            if (itemNo == 2) {
                item2 =parseInt(item); 
		if (item2 >= 0 && time_ti > 0 ) options.series[1].data.push([time_ti,item2]);
            } 
            if (itemNo == 3) {
                item3 =parseInt(item); 
		if (item3 >= 0 && time_ti > 0 ) options.series[2].data.push([time_ti,item3]);
            } 
          });
        });
     
	//options.series.push( name: 'SJ_2900:Download', data: [Date.UTC(1970,  9, 27),10]});
      //chart = new Highcharts.Chart(op2);
	chart = new Highcharts.Chart(options);
    });
  });
}
</script> 


<script type="text/javascript">
function Usage_total()
{
  jQuery(document).ready(function() {
	var chart;
	var previous_ti;
        var lines;
        var items;
        var itemNo;
        var line;
	var lineNo;
        var options;
    graph_title = "Total number of Tests";
    var options = {
      chart: {
              type: 'column',
	      zoomType: 'x',
              renderTo: 'container3',
      },
        legend: {
	    enabled: true,
             },
      title: {
        text: graph_title
      },
            tooltip: {
                shared: true
            },	
	scrollbar: {
	enabled: true
	},
      xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { 
    		day:"%b %e",
    		week:"%b %e, %Y",
    		month:"%B %Y",
    		year:"%Y"
                }
           
      },
        yAxis:[{ // Secondary yAxis
                gridLineWidth: 1,
                title: {
                    text: 'Tests Ran',
                },
            }],
      series: [{
		name: 'All users',
                type: 'column',
		dataGrouping: { 
			enabled: true, 
			groupPixelWidth: 40,
			approximation: "average",
		},
		tooltip: { valueDecimals: 0 },
		data: []
	},{
		name: 'Passed',
                type: 'column',
		dataGrouping: { 
			enabled: true, 
			groupPixelWidth: 40,
			approximation: "average",
		},
		tooltip: { valueDecimals: 0 },
		data: []
	},{
		name: 'Development',
                type: 'column',
		dataGrouping: { 
			enabled: true, 
			groupPixelWidth: 40,
			approximation: "average",
		},
		tooltip: { valueDecimals: 0 },
		data: []
	}],
    };
	var array_data =[];
	file2 = "http://joao-lnx/site_pro/mysql_query/by_submittion_total.php";
    jQuery.get(file2, function(data) {
       lines = data.split('<b>');
      jQuery.each(lines, function(lineNo, line) {
          items = line.split(',');
          jQuery.each(items, function(itemNo, item) {
	    if (itemNo == 0) {
                item =parseInt(item); 
		if ( item > 0  ) {
             	   time_ti = item * 1000;
		} else {
			time_ti = 0 ;
		}
            }

            if (itemNo == 1) {
                item =parseInt(item); 
		if (item >= 0 && time_ti > 0 ) options.series[0].data.push([time_ti,item]);
            }  
            if (itemNo == 2) {
                item2 =parseInt(item); 
		if (item2 >= 0 && time_ti > 0 ) options.series[1].data.push([time_ti,item2]);
            } 
            if (itemNo == 3) {
                item3 =parseInt(item); 
		if (item3 >= 0 && time_ti > 0 ) options.series[2].data.push([time_ti,item3]);
            } 
          });
        });
     
	//options.series.push( name: 'SJ_2900:Download', data: [Date.UTC(1970,  9, 27),10]});
      //chart = new Highcharts.Chart(op2);
	chart = new Highcharts.Chart(options);
    });
  });
}
</script> 

<!--[if lt IE 8]>
   <div style=' clear: both; text-align:center; position: relative;'>
     <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
       <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
    </a>
  </div>
<![endif]-->
<!--[if lt IE 9]>
	<script src="js/html5.js"></script>
	<link rel="stylesheet" href="css/ie.css"> 
<![endif]-->
</head>
<body>

<!-- PRO Framework Panel Begin -->
<?php include 'head.html'; ?>
<!-- PRO Framework Panel End -->
<div class="bg-main">
<!--==============================header=================================-->
<!--==============================header=================================-->
	<header>
		<div class="container_24">
			<div class="wrapper">
			</div>
		</div>
	</header>
<!--==============================section=================================-->
<!--==============================section=================================-->
	<section class="padsection7">
	<div class="container_24">
<!-- Structure Begin -->
		<div class="wrapper"></div>


<!-- Layouts Begin -->
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/stock/exporting.js"></script>	
<script type="text/javascript">
Usage();
Usage_total();
</script>
<div id="container2" style="min-width: 950px; height: 600px; margin: 200 auto">
</div>

<div id="container3" style="min-width: 950px; height: 600px; margin: 200 auto">
</div>
</div>
</div>
</div>


</body>
</html> 