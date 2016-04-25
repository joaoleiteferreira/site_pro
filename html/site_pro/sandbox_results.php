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
	append = "/STATS/"
	file2 = append.concat(file)
    jQuery.get(file2, function(data) {
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
			<div class="grid_24"><h2>Sandbox Results</h2>
			
<?php
	$screen_res = $_COOKIE["user_password"]; 
	list($user, $password) = split("@", $screen_res);
	require $KoolControlsFolder."../KoolControls/KoolAjax/koolajax.php";
	$koolajax->scriptFolder = $KoolControlsFolder."../KoolControls/KoolAjax";

//         require $KoolControlsFolder."../../KoolCalendar/koolcalendar.php";
	require $KoolControlsFolder."../KoolControls/KoolGrid/koolgrid.php";
	$db_con = mysql_connect("localhost","root","devtest-");
        mysql_select_db("880");
	$ds = new MySQLDataSource($db_con);//This $db_con link has been created inside KoolPHPSuite/Resources/runexample.php
	$ds->SelectCommand = "select ID,RESULT,MODEL,RUN_PARAMETERS,SUBMITTER,BANDWIDTH,XML_FILE,TIME_FINISH,DURATION,NOTES,TRAFFIC,CONFIG,VERSION,LIMIT_FACTOR,LOG,STATS from resuts_performance WHERE CLASS='SANDBOX' order by TIME_FINISH desc";
 	$ds->UpdateCommand = "update Testsconfig set Name='@Name', Notes='@Notes', Platform='@Platform',  File='@File', Class='@Class', ExecServer='@ExecServer',Testbed='@Testbed', Date='@Date', Priority='@Priority',Time='@Time',tree='@tree' WHERE ID=@ID";
	$ds->DeleteCommand = "delete from resuts_performance where ID='@ID' AND SUBMITTER='$user' AND TIME_FINISH='@TIME_FINISH' AND RESULT='@RESULT' AND LOG='@LOG'";
	$ds->InsertCommand = "";
 

	$grid = new KoolGrid("grid");
	$grid->scriptFolder = $KoolControlsFolder."../../KoolControls/KoolGrid";
        $grid->AjaxEnabled = true;

	$grid->AllowMultiSelecting = true;// Allow multi row selecting


	$grid->styleFolder="default";
	$grid->DataSource = $ds;
	$grid->AjaxEnabled = true;
	$grid->AllowFiltering = true;
 	$grid->AllowEditing = true;
	$grid->AllowDeleting = true;
	$grid->AllowResizing = true;
	//$grid->Width = "50px";
	$grid->PageSize = 300;
	$grid->RowAlternative = false;
	$grid->AllowScrolling = true;
        $grid->MasterTable->Width = "960px";
	$grid->MasterTable->Height = "500px";
       // $grid->MasterTable->FrozenColumnsCount = 2;
	$grid->ColumnWrap = true;

// 	$grid->MasterTable->ColumnWidth = "200px";
//  	$col = new GridBoundColumn();//GridBoundColumn is inherited from GridColumn
// 	$col->Width = "50px";
// 	$grid->MasterTable->AddColumn($col);

	//$grid->AutoGenerateColumns = true;
	

	$column = new GridBoundColumn();
	$column->HeaderText = "XML_FILE";
	$column->DataField = "XML_FILE";
	$column->Width = "280px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridBoundColumn();
	$column->HeaderText = "RESULT";
	$column->DataField = "RESULT";
	$column->Width = "90px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridBoundColumn();
	$column->HeaderText = "MODEL";
	$column->DataField = "MODEL";
	$column->Width = "90px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);


	$column = new GridBoundColumn();
	$column->HeaderText = "SUBMITTER";
	$column->DataField = "SUBMITTER";
	$column->Width = "90px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridBoundColumn();
	$column->HeaderText = "RUN_PARAMETERS";
	$column->DataField = "RUN_PARAMETERS";
	$column->Width = "300px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridBoundColumn();
	$column->HeaderText = "VERSION";
	$column->DataField = "VERSION";
	$column->Width = "150px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridBoundColumn();
	$column->HeaderText = "BANDWIDTH";
	$column->DataField = "BANDWIDTH";
	$column->Width = "90px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridBoundColumn();
	$column->HeaderText = "LIMIT_FACTOR";
	$column->DataField = "LIMIT_FACTOR";
	$column->Width = "180px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridBoundColumn();
	$column->HeaderText = "NOTES";
	$column->DataField = "NOTES";
	$column->Width = "180px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridBoundColumn();
	$column->HeaderText = "TIME_FINISH";
	$column->DataField = "TIME_FINISH";
	$column->Width = "120px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridBoundColumn();
	$column->HeaderText = "DURATION";
	$column->DataField = "DURATION";
	$column->Width = "90px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridCommandColumn();
     	$column->CommandText = "LOG";
	$column->OnClick = "window.open(\"{LOG}\")"; 
        //$column->CssClass = "button_css";
	$column->Width = "50px";
	$column->Align = "center";
	$grid->MasterTable->AddColumn($column);

	$column = new GridCommandColumn();
     	$column->CommandText = "GRAPH";
	$column->OnClick = "graph(\"{STATS}\")";
        //$column->CssClass = "button_css";
	$column->Width = "50px";
	$column->Align = "center";
	$grid->MasterTable->AddColumn($column);

	$column = new GridEditDeleteColumn();
	$grid->ClientSettings->ClientMessages["DeleteConfirm"] = "Confirm delete, your boss will be notarized";
	$column->DeleteButtonText = "Delete";
	$column->ShowEditButton = false;
	$column->Align = "center";
	$column->Width = "50px";
	$grid->MasterTable->AddColumn($column);
	
	$grid->MasterTable->EditSettings->Mode = "Inline";//"Inline" is default value;


	$grid->MasterTable->Pager = new GridPrevNextAndNumericPager();	
	class MyGridEventHandler extends GridEventHandler
	{
		function OnRowPreRender($row)
		{
		
			if($row->DataItem["RESULT"] == 'FAIL') {
				$row->CssClass = "jred"; // Make the row in blue color.
			} 
			if($row->DataItem["RESULT"] == 'PASS') {
				$row->CssClass = "jblue"; // Make the row in blue color.
			} 
		}
	}

	$grid->Process();

	// Process the class MyGridEventHandler
	$grid->EventHandler = new MyGridEventHandler(); // event render
	$_rows = $grid->GetInstanceMasterTable()->GetInstanceRows();
	foreach ($_rows as $_row) {
	$grid->EventHandler->OnRowPreRender($_row, '');
	} 

	if(isset($_POST["IgnorePaging"]))
	{
		$grid->ExportSettings->IgnorePaging = true;
	}
	if(isset($_POST["ExportToExcel"]))
	{
		ob_end_clean();
		$grid->GetInstanceMasterTable()->ExportToExcel();
	}	
	if(isset($_POST["ExportToWord"]))
	{
		ob_end_clean();
		$grid->GetInstanceMasterTable()->ExportToWord();
	}	
	if(isset($_POST["ExportToCSV"]))
	{
		ob_end_clean();
		$grid->GetInstanceMasterTable()->ExportToCSV();
	}
	if(isset($_POST["ExportToPDF"]))
	{
		ob_end_clean();
		$grid->GetInstanceMasterTable()->ExportToPDF();
	}
?>




</div></div>

<form id="form1" method="post">
	<?php echo $koolajax->Render();?>
	<?php echo $grid->Render();?>
	<div style="margin-bottom:2px;padding:10px;width:635px">
		<input type="submit" name="ExportToWord" value = "Table format" />
	</div>
</form>
<!-- Layouts Begin -->
<script src="highstock.js"></script>
<script src="http://code.highcharts.com/stock/1.3.0/exporting.js"></script>	

<div id="container2" style="min-width: 950px; height: 600px; margin: 200 auto"></div>
</div>


</div>
</div>


</body>
</html> 
