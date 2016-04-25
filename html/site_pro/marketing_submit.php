<!DOCTYPE html>
<html lang="en">
<head>

<?php

$screen_res = $_COOKIE["user_password"]; 

#if project does not exist display warning message

list($user, $password) = split("@", $screen_res);

if ( $user == "" || $password == "") {
    echo '<script type="text/javascript">'
    , 'writeCookie();'
    , 'function writeCookie()'
    , '{'
    , 'var the_date = new Date("December 31, 2023");'
    , 'var username = prompt("Please enter your narra username", "");'
    , 'var password = prompt("Please enter your narra password", "");'
    , 'var the_cookie_date = the_date.toGMTString();'
    , 'var the_cookie = "user_password="+ username +"@"+ password;'
    , 'var the_cookie = the_cookie + ";expires=" + the_cookie_date;'
    , 'document.cookie=the_cookie;'
    , '}'
    , '</script>';

    echo '<script type="text/javascript">'
   , 'window.open("http://joao-lnx/site_pro/performance_submit.php","_self");'
   , '</script>';
}

?>


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
			<div class="grid_24"><h2>Performance Submit</h2>
			
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
	$ds->SelectCommand = "select ID,TOPOLOGY,MODEL,XML_FILE,TIME_ADDED,NOTES,RUN_PARAMETERS from tests WHERE CLASS='MARKETING' order by XML_FILE asc";
 	$ds->UpdateCommand = "update tests set RUN_PARAMETERS='@RUN_PARAMETERS'  WHERE ID=@ID";
	$ds->DeleteCommand = "insert into queue (ID,XML_FILE,CLASS,PRIORITY,RUN_PARAMETERS,USERNAME,PASSWORD) values ('@ID','@XML_FILE','PERFORMANCE','3','@RUN_PARAMETERS','$user','$password')";


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
	$column->HeaderText = "TOPOLOGY";
	$column->DataField = "TOPOLOGY";
	$column->Width = "90px";
	$column->ReadOnly = true;
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);


	$column = new GridBoundColumn();
	$column->HeaderText = "MODEL";
	$column->DataField = "MODEL";
	$column->ReadOnly = true;
	$column->Width = "90px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);


	$column = new GridBoundColumn();
	$column->HeaderText = "RUN_PARAMETERS";
	$column->DataField = "RUN_PARAMETERS";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridEditDeleteColumn();
	$grid->ClientSettings->ClientMessages["DeleteConfirm"] = "Added to Queue";
	$column->DeleteButtonText = "Submit";
	$column->Align = "center";
	$column->Width = "100px";
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
	<div class="wrapper"><div class="grid_24"><h2 class="title"></h2></div></div>
	</div>

		<div class="tab-content">
			<div class="container_24">
<!-- Full-width Begin -->
		<div class="wrapper"><div class="grid_24">
<?php

$screen_res = $_COOKIE["user_password"]; 

#if project does not exist display warning message

list($user, $password) = split("@", $screen_res);
echo "<h5>This is your Narra username and password</h5><h6> Username:$user <br>Password:$password";
?>
		<div class="btn-indent">
		<form method="post" action="<?php echo $PHP_SELF;?>"> 
		<input type="submit" class="btn inf" name="Reset" value="Reset">
		</form>
		</div>
		</div>
</div>

<?php
if($_POST['Reset']) {
    echo '<script type="text/javascript">'
    , 'writeCookie();'
    , 'function writeCookie()'
    , '{'
    , 'var the_date = new Date("December 31, 2023");'
    , 'var username = prompt("Please enter your narra username", "");'
    , 'var password = prompt("Please enter your narra password", "");'
    , 'var the_cookie_date = the_date.toGMTString();'
    , 'var the_cookie = "user_password="+ username +"@"+ password;'
    , 'var the_cookie = the_cookie + ";expires=" + the_cookie_date;'
    , 'document.cookie=the_cookie;'
    , '}'
    , '</script>';

    echo '<script type="text/javascript">'
   , 'window.open("http://joao-lnx/site_pro/performance_submit.php","_self");'
   , '</script>';


}
?>
</div>
</div>



</body>
</html> 