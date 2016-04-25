<!DOCTYPE html>
<html lang="en">
<head>

<script language="javascript">
<!--
writeCookie();
function writeCookie()
{
var today = new Date();
var the_date = new Date("December 31, 2023");
var the_cookie_date = the_date.toGMTString();
var the_cookie = "users_resolution="+ screen.width +"x"+ screen.height;
var the_cookie = the_cookie + ";expires=" + the_cookie_date;
document.cookie=the_cookie
}


//-->
</script>

    <script src="cm.js"></script>
    <link rel="stylesheet" href="codemirror-3.1/lib/codemirror.css">
    <script src="codemirror-3.1/lib/codemirror.js"></script>
    <script src="codemirror-3.1/addon/hint/show-hint.js"></script>
    <script src="codemirror-3.1/mode/xml/xml.js"></script>
    <link rel="stylesheet" href="codemirror-3.1/addon/hint/show-hint.css">
    <script src="codemirror-3.1/addon/hint/javascript-hint.js"></script>
    <script src="codemirror-3.1/mode/javascript/javascript.js"></script>
    <script src="codemirror-3.1/addon/fold/foldcode.js"></script>


  	<title>Sandbox</title>
  	<meta charset="utf-8">
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.7.1.min.js"></script><script src="js/script.js"></script>
    



<script type="text/javascript">
function graph(ID) {
  jQuery(document).ready(function() {
	var chart;
	var previous_ti;
        var lines;
        var items;
        var itemNo;
        var line;
	var lineNo;
        var options;
    var op2 = {
			title : {
				text : 'AAPL Stock Price'
			},
			
			series : [{
				name : 'AAPL Stock Price',
				shadow : true,
				tooltip : {
					valueDecimals : 2
				}
			}]
		};
    var options = {

   chart: {
              zoomType: 'x',
              type: 'spline',
        },
  rangeSelector: {
    buttons: [{
      type: 'day',
      count: 1,
      text: '1d'
    }, {
      type: 'week',
      count: 1,
      text: '1w'
    }, {
      type: 'month',
      count: 1,
      text: '1m'
    }, {
      type: 'all',
      text: 'All'
    }],
    selected: 1
  },
        legend: {
	    enabled: true,

             },
      title: {
        text: 'Timeline'
      },
	navigator : {
		enabled : false
	},
	
			tooltip: {
				style: {
					width: '200px'
				},
			},
	xAxis:{
	minPadding: 40,
},
           xAxis: {
                type: 'datetime',
		ordinal: false,
            },
      yAxis:[{ // Secondary yAxis
		min: 0,
                gridLineWidth: 1,
                title: {
                    text: 'Bandwitdh mb/s',
                },
                labels: {
                    formatter: function() {
                        return this.value +' mb/s';
                    },
                }
    	
            }],
      series: []
    };
	options.series[0] = ({name: 'Bandwidth', type: 'spline' ,data: [], id : 'dataseries', color: 'rgba(0,0,255, 0.5)', tooltip: {valueDecimals: 0 ,  valueSuffix: ' mbps'},visible: true ,marker : { enabled : true, radius : 3, fillColor: 'rgba(255,100,100, 0.9)'}, dataGrouping: {enabled: true, groupPixelWidth: 100 , approximation: "average"}});
	options.series[1] = ({name: 'PASS', type : 'flags', data: [],	onSeries : 'dataseries', shape : 'squarepin', width : 10 ,visible: false });
	options.series[2] = ({name: 'FAIL', type : 'flags', data: [],	onSeries : 'dataseries', shape : 'squarepin', width : 10 ,color: 'rgba(255,0,0, 1)' });
	options.series[3] = ({name: 'INFO', type : 'flags', data: [],	onSeries : 'dataseries', shape : 'squarepin',visible: false  });
	options.series[4] = ({name: 'Degradation', type : 'flags', data: [], shape : 'squarepin' ,color: 'rgba(255,0,0, 1)'  });
	options.series[5] = ({name: 'Improvement', type : 'flags', data: [], shape : 'squarepin' });
	append = "/site_pro/mysql_query/by_id.php?ID="
	file2 = append.concat(ID);
    jQuery.get(file2, function(data) {
      // Split the lines
	 time_ti = "";
       lines = data.split('<b>');
      pre_bandwidth = 0;
      jQuery.each(lines, function(lineNo, line) {
          items = line.split(',');
          jQuery.each(items, function(itemNo, item) {
            if (itemNo == 0) {
                time = item * 1000;
            } 
            if (itemNo == 1) {
                item2 = parseInt(item); 
		bandwidth = parseInt(item);
		options.series[0].data.push([time,item2]);
            } 
            if (itemNo == 2) {
		if (item == 'PASS') {
			PASS = 'TRUE';
			options.series[1].data.push({ x:time,title: 'P' ,text:item, color: 'rgba(0,0,255, 0.5)'});
		} else {
			PASS = 'FALSE';
			options.series[2].data.push({ x:time,title: 'F' ,text:item });
		}
            } 
            if (itemNo == 3) {
		limit_factor = item;
            } 
            if (itemNo == 4) {
		notes = item;
            } 
            if (itemNo == 5) {
		text_to_add = "BANDWIDTH:" + bandwidth + " VERSION:" + item +" LIMIT_FACTOR:" + limit_factor + " NOTES:" + notes;
		options.series[3].data.push({ x:time,title: "I" ,text:text_to_add });
		if (pre_bandwidth != 0 ) {
	   	 if ( (pre_bandwidth * 0.98) > bandwidth ) {
		  text_to_add = "Degradation from" + pre_bandwidth + " to " + bandwidth;
		  options.series[4].data.push({ x:time,title: 'Bad' ,text:text_to_add});
		 }
	   	 if ( (pre_bandwidth * 1.02) < bandwidth ) {
		  text_to_add = "Improvement from" + pre_bandwidth + " to " + bandwidth;
		  options.series[5].data.push({ x:time,title: 'Good' ,text:text_to_add});
		 }
                }
                 pre_bandwidth = bandwidth;
            }
          });
        });
     
	//options.series.push( name: 'SJ_2900:Download', data: [Date.UTC(1970,  9, 27),10]});
      //chart = new Highcharts.Chart(op2);
	$('#container2').highcharts('StockChart', options);
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
			<div class="grid_24"><h2>Anaylse on single test</h2>
			
<?php

$screen_res = $_COOKIE["users_resolution"]; 

#if project does not exist display warning message

list($width, $height) = split("x", $screen_res);
$height = (int)$height;
$width = (int)$width;
$height = $height * 0.40;
$width = $width * 0.75;

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
	$ds->SelectCommand = "select ID,TOPOLOGY,MODEL,XML_FILE,TIME_ADDED,NOTES,TRAFFIC,CONFIG from tests WHERE CLASS='SANDBOX' order by XML_FILE asc";
 

	$grid = new KoolGrid("grid");
	$grid->scriptFolder = $KoolControlsFolder."../../KoolControls/KoolGrid";
        $grid->AjaxEnabled = true;
	$grid->styleFolder="default";
	$grid->DataSource = $ds;
	$grid->AjaxEnabled = true;
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
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridBoundColumn();
	$column->HeaderText = "TOPOLOGY";
	$column->DataField = "TOPOLOGY";
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
	$column->HeaderText = "TRAFFIC";
	$column->DataField = "TRAFFIC";
	$column->Width = "90px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridBoundColumn();
	$column->HeaderText = "CONFIG";
	$column->DataField = "CONFIG";
	$column->Width = "90px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridBoundColumn();
	$column->HeaderText = "NOTES";
	$column->DataField = "NOTES";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridCommandColumn();
     	$column->CommandText = "Timeline";
	$column->OnClick = "graph(\"{ID}\")";
        $column->CssClass = "button_css";
	$column->Width = "100px";
	$column->Align = "center";
	$grid->MasterTable->AddColumn($column);


	
	$grid->MasterTable->EditSettings->Mode = "Inline";//"Inline" is default value;
        $grid->MasterTable->ShowFunctionPanel = true;


	$grid->MasterTable->Pager = new GridPrevNextAndNumericPager();	
	$grid->Process();
	
?>



<form id="form1" method="post">
	<?php echo $koolajax->Render();?>
	<?php echo $grid->Render();?>
</form>
</div></div>

<!-- Layouts Begin -->
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/stock/exporting.js"></script>	

<div id="container2" style="min-width: 950px; height: 600px; margin: 200 auto"></div>
</div>


		</div>
		</div>
</div>
</div>
</div>



</script>

</body>
</html> 
