<!DOCTYPE html>
<html lang="en">
<head>




    <script src="cm.js"></script>
    <link rel="stylesheet" href="codemirror-3.1/lib/codemirror.css">
    <script src="codemirror-3.1/lib/codemirror.js"></script>
    <script src="codemirror-3.1/addon/hint/show-hint.js"></script>
    <script src="codemirror-3.1/addon/search/search.js"></script>
    <script src="codemirror-3.1/addon/search/searchcursor.js"></script>
    <script src="codemirror-3.1/mode/xml/xml.js"></script>
    <link rel="stylesheet" href="codemirror-3.1/addon/hint/show-hint.css">
    <script src="codemirror-3.1/addon/hint/javascript-hint.js"></script>
    <script src="codemirror-3.1/mode/javascript/javascript.js"></script>
    <script src="codemirror-3.1/addon/fold/foldcode.js"></script>


  	<title>Performance</title>
  	<meta charset="utf-8">
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.7.1.min.js"></script><script src="js/script.js"></script>
    


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>


<script type="text/javascript">
function graph(file) {
  jQuery(document).ready(function() {
	var chart;
	var previous_ti;
        var lines;
        var items;
        var itemNo;
        var line;
	var lineNo;
        var options;
Highcharts.setOptions({
	global: {
		useUTC: false
	}
});


    var options = {
      chart: {
              zoomType: 'x',
              type: 'spline',
        renderTo: 'container2',
                events: {
                    load: function() {
    
                        // set up the updating of the chart each second
			
                        var series = this.series;
			//var chart = this.chart;
                        setInterval(function() {
				//chart.addSeries({name: 'go' , data: [3,3]});
				append = "_append"
				file2 = file.concat(append)
				jQuery.get(file2, function(data) {
					lines = data.split('\n');
      					jQuery.each(lines, function(lineNo, line) {
						items = line.split(',');
						if (lineNo == 0) {
							jQuery.each(items, function(itemNo, item) {
							if (itemNo == 0 || itemNo == 1) {
								// Do nothing this is for time
							} else {
                                                                if ( series[itemNo - 2] == undefined  ) {
									if ( item.indexOf("uut:CPU") !== -1  ) {
										chart.addSeries[itemNo -2] = ({name: item ,type: 'column', data: [], color: 'rgba(0,0,255, 0.5)', tooltip: { valueSuffix: ' %'},visible: true ,dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"}});
									} else if ( item.indexOf("uut:QFP") !== -1) {
										chart.addSeries[itemNo -2] = ({name: item ,type: 'column', data: [], color: 'rgba(100,10,100, 0.5)', tooltip: { valueSuffix: ' %'},visible: true ,dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"}});
									} else if ( item.indexOf("uut:iCPU") !== -1) {
										chart.addSeries[itemNo -2] = ({name: item ,type: 'column', data: [], color: 'rgba(100,100,255, 0.5)', tooltip: { valueSuffix: ' %'},visible: true ,dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"}});
									} else if ( item.indexOf("CPU") !== -1) {
										chart.addSeries[itemNo -2] = ({name: item ,type: 'column', data: [], tooltip: { valueSuffix: ' %'},visible: false ,dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"}});
									} else if ( item.indexOf("QFP") !== -1) {
										chart.addSeries[itemNo -2] = ({name: item ,type: 'column', data: [], tooltip: { valueSuffix: ' %'},visible: false ,dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"}});
									} else if ( item.indexOf("Upload") !== -1 || item.indexOf("Download") !== -1) {
										options.series[itemNo -2] = ({name: item , yAxis: 1, data: [], tooltip: { valueSuffix: ' mbps'}, visible: true ,dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"} });
									} else if ( item.indexOf("SYN_ACK") !== -1 || item.indexOf("response_time") !== -1) {
										chart.addSeries [itemNo -2] = ({name: item ,yAxis: 2, data: [], tooltip: { valueSuffix: ' ms'},visible: false ,dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"}});
									} else {
										chart.addSeries [itemNo -2] = ({name: item ,yAxis: 3, data: [],visible: false, dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"}});
									}
								}
							}
							//chart.addSeries({name: 'go' , data: [3,3]});
							});
					
						} else {
							jQuery.each(items, function(itemNo, item) {
						if (itemNo == 0) {
							item =parseInt(item); 
							if ( item > 0 ) {
							time_ti = item * 1000;
							} else {
								time_ti = 0 ;
							}
						} else {
							if ( time_ti > 0 && itemNo > 1 ) {
							item2 =parseFloat(item);
							
							if ( item.indexOf("#") !== -1 ) { 
									series[itemNo - 2].addPoint({ x: time_ti, title: 'F', text: item},true,false);
							} else {
								if (item2 >= 0) series[itemNo - 2].addPoint([time_ti,item2]);
							}
							}
						}
						});
						}
					});

				});
			}, 10000);
                    }
                }

      },

      title: {
        text: 'Running Stats'
      },
	scrollbar: {
	enabled: true
	},
      xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { 
  		second : '%H:%M:%S',
                minute : '%H:%M',
                hour : '%H:%M',
                day : '%e',
                week : '%e',
                month : '%e',
                year : '%e'
                }
           
      },
      yAxis:[{ // Primary yAxis
                labels: {
                    formatter: function() {
                        return this.value +' %';
                    },
                    style: {
                        color: '#89A54E'
                    }
                },
		min: 0,
		max: 100,
                title: {
                    text: 'Percentage',
                    style: {
                        color: '#89A54E'
                    }
                },
                opposite: true
    
            }, { // Secondary yAxis
                gridLineWidth: 0,
                title: {
                    text: 'Bandwitdh mb/s',
                },
		min: 0,
                labels: {
                    formatter: function() {
                        return this.value +' mb/s';
                    },
                }
    
            },{ // Secondary yAxis
                gridLineWidth: 0,
                title: {
                    text: 'Time milliseconds',
                    style: {
                        color: '#4572A7'
                    }
                },
		min: 0,
                labels: {
                    formatter: function() {
                        return this.value +' ms';
                    },
                    style: {
                        color: '#AA4643'
                    }
                }
    
            }, { // Tertiary yAxis
                gridLineWidth: 0,
                title: {
                    text: 'Other',
                    style: {
                        color: '#BB72A7'
                    }
                },
                labels: {
                    formatter: function() {
                        return this.value;
                    },
                    style: {
                        color: '#AA4643'
                    }
                },
            }],
            tooltip: {
                shared: true
            },
      series: []
    };

    jQuery.get(file, function(data) {
      // Split the lines

	 time_ti = "";
       lines = data.split('\n');
      jQuery.each(lines, function(lineNo, line) {
         items = line.split(',');
        // header line containes Names
        if (lineNo == 0) {
          jQuery.each(items, function(itemNo, item) {
            if (itemNo == 0 || itemNo == 1 ) {
		// Do nothing this is for time
            } else {
		if ( item.indexOf("uut:CPU") !== -1  ) {
			options.series[itemNo -2] = ({name: item ,type: 'column', data: [], color: 'rgba(0,0,255, 0.5)', tooltip: {valueDecimals: 0 ,  valueSuffix: ' %'},visible: true ,dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"}});
		} else if ( item.indexOf("uut:QFP") !== -1) {
			options.series[itemNo -2] = ({name: item ,type: 'column', data: [], color: 'rgba(100,10,100, 0.5)', tooltip: { valueDecimals: 0 ,  valueSuffix: ' %'},visible: true ,dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"}});
		} else if ( item.indexOf("flags") !== -1) {
			options.series[itemNo -2] = ({name: item ,type: 'flags', data: [], shape: 'squarepin'});
		}else if ( item.indexOf("uut:iCPU") !== -1) {
			options.series[itemNo -2] = ({name: item ,type: 'column', data: [], color: 'rgba(100,100,255, 0.5)', tooltip: { valueDecimals: 0 , valueSuffix: ' %'},visible: true ,dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"}});
		} else if ( item.indexOf("CPU") !== -1) {
			options.series[itemNo -2] = ({name: item ,type: 'column', data: [], tooltip: {valueDecimals: 0 ,  valueSuffix: ' %'},visible: false ,dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"}});
		} else if ( item.indexOf("QFP") !== -1) {
			options.series[itemNo -2] = ({name: item ,type: 'column', data: [], tooltip: { valueDecimals: 0 , valueSuffix: ' %'},visible: false ,dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"}});
		} else if ( item.indexOf("Upload") !== -1 || item.indexOf("Download") !== -1 || item.indexOf("Bandwitdh") !== -1) {
			options.series[itemNo -2] = ({name: item , yAxis: 1, data: [], tooltip: { valueDecimals: 2 ,  valueSuffix: ' mbps'}, visible: true ,dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"} });
		} else if ( item.indexOf("SYN_ACK") !== -1 || item.indexOf("response_time") !== -1) {
			options.series[itemNo -2] = ({name: item ,yAxis: 2, data: [], tooltip: { valueDecimals: 2 , valueSuffix: ' ms'},visible: false ,dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"}});
		} else {
			options.series[itemNo -2] = ({name: item ,yAxis: 3, data: [],visible: false, dataGrouping: {enabled: true, groupPixelWidth: 50 , approximation: "average"}});
		}
            }

          });

        } else {
          jQuery.each(items, function(itemNo, item) {
            if (itemNo == 0) {
                item =parseInt(item); 
		if ( item > 0  ) {
             	   time_ti = item * 1000;
		} else {
			time_ti = 0 ;
		}
            } else {
		if ( time_ti > 0 && itemNo > 1 && options.series[itemNo - 2] != undefined ) {
		item2 =parseFloat(item);
							if ( item.indexOf("#") !== -1 ) { 
								options.series[itemNo - 2].data.push({ x: time_ti, title: 'F', text: item});
							} else {
								if (item2 >= 0) options.series[itemNo - 2].data.push([time_ti,item2]);
							}


		 //if (item2 >= 0) options.series[itemNo - 2].data.push([time_ti,item2]);
		 //if ( item.indexOf("i") !== -1 ) { 
		//		options.series[itemNo - 2].data.push({x: time_ti,title: 'F', text: item});
		//	}
		}
            }
          });
        }

      });
	//options.series.push( name: 'SJ_2900:Download', data: [Date.UTC(1970,  9, 27),10]});
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
		<div class="wrapper">
			<div class="grid_24"><h2>Running</h2>
			
<?php

$screen_res = $_COOKIE["users_resolution"]; 

#if project does not exist display warning message

list($width, $height) = split("@", $screen_res);
$height = (int)$height;
$width = (int)$width;
$height = $height * 0.40;
$width = $width * 0.75;
$screen_res = $_COOKIE["user_password"]; 

#if project does not exist display warning message

list($user, $password) = split("@", $screen_res);
if ( $height < 400 ) {
	$height = 400;
}
if ( $width  < 800 ) {
	$width = 800;
}
	require $KoolControlsFolder."../KoolControls/KoolAjax/koolajax.php";
	$koolajax->scriptFolder = $KoolControlsFolder."../KoolControls/KoolAjax";

//         require $KoolControlsFolder."../../KoolCalendar/koolcalendar.php";
	require $KoolControlsFolder."../KoolControls/KoolGrid/koolgrid.php";
	$db_con = mysql_connect("localhost","root","devtest-");
        mysql_select_db("880");
	$ds = new MySQLDataSource($db_con);//This $db_con link has been created inside KoolPHPSuite/Resources/runexample.php
	$ds->SelectCommand = "select ID,PID,XML_FILE,DATE_SUBMITTED,RUN_PARAMETERS,USERNAME,DATE_STARTED,RUNNING_LOG,RUNNING_STATS from running order by DATE_STARTED asc";
 	$ds->UpdateCommand = "update running set RUN_PARAMETERS='@RUN_PARAMETERS',PRIORITY='@PRIORITY'  WHERE PID='@PID'USERNAME='$user'";
        $ds->DeleteCommand = "delete from running where PID='@PID' and USERNAME='$user'";

	$grid = new KoolGrid("grid");
	$grid->scriptFolder = $KoolControlsFolder."../../KoolControls/KoolGrid";
        $grid->AjaxEnabled = true;
	$grid->styleFolder="default";
	$grid->DataSource = $ds;
	$grid->AjaxEnabled = true;
 	$grid->AllowEditing = true;
	$grid->AllowFiltering = true;
	$grid->AllowDeleting = true;
	$grid->AllowResizing = true;
        $grid->ColumnWrap = true;
	$grid->Width = 100;
	$grid->Height = "400px";
	$grid->PageSize = 400;
	$grid->RowAlternative = true;
	$grid->AllowScrolling = true;
         $grid->AllowSelecting = true;
         $grid->AllowInserting = true;
	$grid->ColumnWrap = true;

// 	$grid->MasterTable->ColumnWidth = "200px";
//  	$col = new GridBoundColumn();//GridBoundColumn is inherited from GridColumn
// 	$col->Width = "50px";
// 	$grid->MasterTable->AddColumn($col);

	#$grid->AutoGenerateColumns = true;
	

	$column = new GridBoundColumn();
	$column->HeaderText = "XML_FILE";
	$column->DataField = "XML_FILE";
	$column->Width = "280px";
	$column->ReadOnly = true;
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);


	$column = new GridBoundColumn();
	$column->HeaderText = "USERNAME";
	$column->DataField = "USERNAME";
	$column->ReadOnly = true;
	$column->Width = "90px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);


	$column = new GridBoundColumn();
	$column->HeaderText = "RUN_PARAMETERS";
	$column->Width = "200px";
	$column->DataField = "RUN_PARAMETERS";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridBoundColumn();
	$column->HeaderText = "DATE_STARTED";
	$column->DataField = "DATE_STARTED";
	$column->ReadOnly = true;
        $column->AllowFiltering = false;
	$column->Width = "120px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);


	$column = new GridCommandColumn();
     	$column->CommandText = "debug";
	$column->OnClick = "debug(\"{RUNNING_LOG}\",\"{RUNNING_STATS}\")";
        $column->CssClass = "button_css";
	$column->Width = "70px";
	$column->Align = "center";
	$grid->MasterTable->AddColumn($column);
	$column = new GridEditDeleteColumn();
	$grid->ClientSettings->ClientMessages["DeleteConfirm"] = "Confirm delete, your boss will be notarized";
	$column->DeleteButtonText = "Delete";
	$column->Align = "center";
	$column->Width = "100px";
	$grid->MasterTable->AddColumn($column);

	
	$grid->MasterTable->EditSettings->Mode = "Inline";//"Inline" is default value;
        $grid->MasterTable->ShowFunctionPanel = true;


	$grid->MasterTable->Pager = new GridPrevNextAndNumericPager();	
	$grid->Process();
	
?>


</script>



</div>
<form id="form1" method="post">
	<?php echo $koolajax->Render();?>
	<?php echo $grid->Render();?>
</form>


	<div class="wrapper"><div class="grid_24"><h2 class="title">Debug Area</h2></div></div>
	</div>

		<div class="tab-content">
			<div class="container_24">
<!-- Full-width Begin -->
		<div class="wrapper"><div class="grid_24">
<textarea id="code" name="code">
</textarea><br>
</div>
</div>
<!-- Layouts Begin -->
<script src="http://code.highcharts.com/stock/1.3.0/highstock.js"></script>
<script src="http://code.highcharts.com/stock/1.3.0/modules/exporting.js"></script>	

<div id="container2" style="min-width: 950px; height: 600px; margin: 200 auto"></div>
</div>
<script type='text/javascript'>
function debug(log_file,graph_file) {
 graph(graph_file);
 gofile(log_file);
}
</script>

<script type='text/javascript'>
var doInterval;
function getfile2(log_file) {
window.alert(log_file);
append = "/auto/stg-devtest/joaofer/"
log_file = log_file.replace(append, '/STATS/');
window.alert(log_file);
  $.ajax({
    url: log_file,
    complete: function(request){
	       code.open("GET", log_file, true);
        code.send();
      $("#code").html(request.responseText);
    }
  });
}
</script>

<script>
 var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
    lineNumbers: true,
    enableSearchTools: true
});
function gofile(log_file) {
//window.alert(log_file);
append = "/auto/stg-devtest/joaofer/"
log_file = log_file.replace(append, '/STATS/');
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.overrideMimeType('text/plain');


xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    xmlhttp.overrideMimeType('text/plain');
    var str = xmlhttp.responseText;
	//window.alert("got here");
   var regex = /[0-9]+: joao-lnx: [0-9T:-]+: [%A-Z0-9-]+: [\[\]=/\._%A-Za-z0-9-]+: /gi;
   str = str.replace(regex, '');
   document.getElementById("code").value = str;
   //window.alert("got here");
	editor.setValue(str);
    }
  }
xmlhttp.open("GET",log_file,true);
xmlhttp.send();
editor.refresh();
}
</script>



</div>
</div>


</div>
</body>
</html> 