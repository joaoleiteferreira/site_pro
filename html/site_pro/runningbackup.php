<!DOCTYPE html>
<html lang="en">
<head>




    <script src="cm.js"></script>
    <link rel="stylesheet" href="codemirror-3.1/lib/codemirror.css">
    <script src="codemirror-3.1/lib/codemirror.js"></script>
    <script src="codemirror-3.1/addon/hint/show-hint.js"></script>
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
  jQuery(document).ready(function() {
	var chart;
	var previous_ti;
        var lines;
        var items;
        var itemNo;
        var line;
	var lineNo;
        var options;

    var options = {
      chart: {
        renderTo: 'container2',
              zoomType: 'x',
              type: 'spline',
                events: {
                    load: function() {
    
                        // set up the updating of the chart each second
			
                        var series = this.series;
			//var chart = this.chart;
                        setInterval(function() {
				//chart.addSeries({name: 'go' , data: [3,3]});
				jQuery.get('/tmp/test_cvs_append', function(data) {
					lines = data.split('\n');
      					jQuery.each(lines, function(lineNo, line) {
						items = line.split(',');
						if (lineNo == 0) {
							jQuery.each(items, function(itemNo, item) {
							if (itemNo == 0 || itemNo == 1) {
								// Do nothing this is for time
							} else {
                                                                if ( series[itemNo - 2] == undefined  ) {
									if ( item.indexOf("CPU") !== -1 || item.indexOf("QFP") !== -1) {
										chart.addSeries = ({name: item ,type: 'column', data: [], tooltip: { valueSuffix: ' %'},visible: true });
									} else if ( item.indexOf("Upload") !== -1 || item.indexOf("Download") !== -1) {
										chart.addSeries = ({name: item , yAxis: 1, data: [], tooltip: { valueSuffix: ' mbps'}, visible: true });
									} else if ( item.indexOf("SYN_ACK") !== -1 ) {
										chart.addSeries = ({name: item ,yAxis: 2, data: [], tooltip: { valueSuffix: ' ms'},visible: false });
									} else {
										chart.addSeries = ({name: item ,yAxis: 3, data: [],visible: false });
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
							if ( time_ti > 0 && itemNo > 1) {
							item =parseFloat(item);
							if (item >= 0) series[itemNo -2].addPoint([time_ti,item]);
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
        text: 'Ewarespar Residuals'
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
                    style: {
                        color: '#4572A7'
                    }
                },
		min: 0,
                labels: {
                    formatter: function() {
                        return this.value +' mb/s';
                    },
                    style: {
                        color: '#4572A7'
                    }
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
                        color: '#4643'
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

    jQuery.get('/tmp/test_cvs', function(data) {
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
		if ( item.indexOf("CPU") !== -1  ) {
			options.series[itemNo -2] = ({name: item ,type: 'column', data: [], color: 'rgba(0,0,255, 0.5)', tooltip: { valueSuffix: ' %'},visible: true });
		} else if ( item.indexOf("QFP") !== -1) {
			options.series[itemNo -2] = ({name: item ,type: 'column', data: [], color: 'rgba(0,255,255, 0.5)', tooltip: { valueSuffix: ' %'},visible: true });
		} else if ( item.indexOf("Upload") !== -1 || item.indexOf("Download") !== -1) {
			options.series[itemNo -2] = ({name: item , yAxis: 1, data: [], tooltip: { valueSuffix: ' mbps'}, visible: true });
		} else if ( item.indexOf("SYN_ACK") !== -1 ) {
			options.series[itemNo -2] = ({name: item ,yAxis: 2, data: [], tooltip: { valueSuffix: ' ms'},visible: false });
		} else {
			options.series[itemNo -2] = ({name: item ,yAxis: 3, data: [],visible: false });
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
		if ( time_ti > 0 && itemNo > 1 ) {
		item =parseFloat(item);
		 if (item >= 0) options.series[itemNo - 2].data.push([time_ti,item]);
		}
            }
          });
        }

      });
	//options.series.push( name: 'SJ_2900:Download', data: [Date.UTC(1970,  9, 27),10]});
      chart = new Highcharts.Chart(options);
    });


  });
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
<div id="advanced"><span class="trigger"><strong></strong><em></em></span>
   <div class="bg_pro">
    <div class="pro_main"> <a href="" class="pro_logo"></a>
           <ul class="pro_menu">
            <li><a href="index.html"><img src="images/pro_home.png" alt=""></a></li>
            <li><a href="404.html">Tests<span></span></a>
                 <ul>	
                      <li><a href="performance.php">Performance</a></li>
                      <li><a href="">Scale</a></li>
                      <li><a href="">Stress</a></li>
                      <li><a href="">DE</a></li>
                      <li><a href="">Marketing</a></li>
                      <li><a href="">Sandbox</a></li>
                 </ul></li>
            <li><a href="">Submit<span></span></a>
                 <ul>	
                      <li><a href="performance_submit.php">Performance</a></li>
                      <li><a href="">Scale</a></li>
                      <li><a href="">Stress</a></li>
                      <li><a href="">DE</a></li>
                      <li><a href="">Marketing</a></li>
                      <li><a href="">Sandbox</a></li>
                 </ul></li>
            <li><a href="">Results<span></span></a>
                 <ul>	
                      <li><a href="">Performance</a></li>
                      <li><a href="">Scale</a></li>
                      <li><a href="">Stress</a></li>
                      <li><a href="">DE</a></li>
                      <li><a href="">Marketing</a></li>
                      <li><a href="">Sandbox</a></li>
                 </ul></li>
            <li><a href="">Analyse<span></span></a>
                <ul>
                    <li><a href="">Feature</a>
                      <ul>
                            <li><a href="">Overall Sanity</a></li>
                            <li><a href="">Release</a></li>
                            <li><a href="">Compare Releases</a></li>
                            <li><a href="">Feature-2-Feature</a></li>
                      </ul></li>
                   <li><a href="">Performance</a>
                       <ul>
                      <li><a href="">Release-2-Release</a></li>
                      <li><a href="">Platform-2-Platform</a></li>
                      <li><a href="">Feature-2-Feature</a></li>
                    </ul></li>
                </ul></li>
            <li><a href="">System<span></span></a>
                 <ul>	
                      <li><a href="running.php">Running</a></li>
                      <li><a href="queue.php">Queue</a></li>
                      <li><a href="">Reserve</a></li>
           </ul></li>
        </ul><div class="clear"></div></div></div><div class="bg_pro2"></div></div>
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
			<div class="grid_24"><h2>Queue</h2>
			
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
	$ds->SelectCommand = "select ID,XML_FILE,PRIORITY,DATE_SUBMITTED,RUN_PARAMETERS,USERNAME from queue order by PRIORITY asc,DATE_SUBMITTED asc";
 	$ds->UpdateCommand = "update queue set RUN_PARAMETERS='@RUN_PARAMETERS',PRIORITY='@PRIORITY'  WHERE ID='@ID' AND DATE_SUBMITTED='@DATE_SUBMITTED' AND USERNAME='$user'";
         $ds->DeleteCommand = "delete from queue where ID='@ID' AND DATE_SUBMITTED='@DATE_SUBMITTED' AND USERNAME='$user'";

	$grid = new KoolGrid("grid");
	$grid->scriptFolder = $KoolControlsFolder."../../KoolControls/KoolGrid";
        $grid->AjaxEnabled = true;
	$grid->styleFolder="default";
	$grid->DataSource = $ds;
	$grid->AjaxEnabled = true;
 	$grid->AllowEditing = true;
	$grid->AllowFiltering = true;
	$grid->AllowDeleting = true;
	//$grid->AllowResizing = true;
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
	$column->DataField = "RUN_PARAMETERS";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridBoundColumn();
	$column->HeaderText = "DATE_SUBMITTED";
	$column->DataField = "DATE_SUBMITTED";
	$column->ReadOnly = true;
        $column->AllowFiltering = false;
	$column->Width = "120px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridDropDownColumn();
	$column->HeaderText = "PRIORITY";
	$column->DataField = "PRIORITY";
        $column->AllowFiltering = false;
	$column->Width = "80px";
	$column->Align = "left";
	$column->AddItem("2");
	$column->AddItem("3");
	$column->AddItem("4");
	$column->AddItem("5");
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



</div></div>
<form id="form1" method="post">
	<?php echo $koolajax->Render();?>
	<?php echo $grid->Render();?>
</form>
<!-- Layouts Begin -->
<script src="http://www.highcharts.com/js/highstock.js"></script>
<script src="../../../Highcharts/js/modules/exporting.js"></script>	

<div id="container2" style="min-width: 400px; height: 400px; margin: 200 auto"></div>
</div>


</div>
</div>



</body>
</html> 