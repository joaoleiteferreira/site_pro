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


  	<title>Performance</title>
  	<meta charset="utf-8">
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.7.1.min.js"></script><script src="js/script.js"></script>
    



<script type="text/javascript">
function graph(CONFIG,VERSION) {
  jQuery(document).ready(function() {
	var chart;
	var previous_ti;
        var lines;
        var items;
        var itemNo;
        var line;
	var lineNo;
        var options;
    graph_title = CONFIG + " version:" + VERSION;
    var options = {
      chart: {
              type: 'column',
        renderTo: 'container2',
      },
        legend: {
	    enabled: true,

             },
      title: {
        text: graph_title
      },	
	tooltip: {
		style: {
		width: '200px'
		},
	},
	xAxis:{
	categories: [],
	minPadding: 0.5,
        },
        yAxis:[{ // Secondary yAxis
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
      series: [{
		name: VERSION,
		data: []
	}],
    };
	var array_data =[];
	file2 = "/site_pro/mysql_query/by_config.php?CONFIG=" + CONFIG + "&VERSION=" + VERSION;
    jQuery.get(file2, function(data) {
       lines = data.split('<b>');
      jQuery.each(lines, function(lineNo, line) {
          items = line.split(',');
          jQuery.each(items, function(itemNo, item) {
            if (itemNo == 0) {
		item2 = parseInt(item);
		//item2 = 10;
		if (item2 > 0 ) {
		//options.series[0].data.push({y:item2 ,name: 'Point 1'});
		//options.series[0].data = [10,15];
		}
            } 
            if (itemNo == 1 && item2 > 0 ) {
               options.xAxis.categories.push(item);
            } 
            if (itemNo == 2 && item2 > 0 ) {
                limit_factor = 'Throughput limited by:' + item;
		if (item2 > 0 ) {
		options.series[0].data.push({y:item2 ,name: limit_factor});
		}
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
<?php include 'head.html'; ?>
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
			<div class="grid_24"><h2>Analyse Performance on specific Platform</h2>
			
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
	$ds->SelectCommand = "SELECT CONFIG,VERSION,count(DISTINCT MODEL) as HITS,TRAFFIC FROM resuts_performance WHERE RESULT='PASS' GROUP BY VERSION,TRAFFIC,CONFIG order by HITS desc";
 
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
	$column->HeaderText = "CONFIG";
	$column->DataField = "CONFIG";
	$column->Width = "100px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridBoundColumn();
	$column->HeaderText = "VERSION";
	$column->DataField = "VERSION";
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
	$column->HeaderText = "Number of platforms run";
	$column->DataField = "HITS";
	$column->Width = "90px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);


	$column = new GridCommandColumn();
     	$column->CommandText = "GRAPH";
	$column->OnClick = "graph(\"{CONFIG}\",\"{VERSION}\")";
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
