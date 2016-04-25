<!DOCTYPE html>
<html lang="en">
<head>
   
  
    
    <script src="js/jquery-1.7.1.min.js"></script>
    <script src="js/script.js"></script>
    <meta charset="utf-8">
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <link rel="stylesheet" href="css/style.css">




  	<title>Queue</title>
  
    


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
	$ds->SelectCommand = "select QUEUE_ID,XML_FILE,PRIORITY,DATE_SUBMITTED,RUN_PARAMETERS,USERNAME,STATUS from queue order by PRIORITY asc,DATE_SUBMITTED asc";
 	$ds->UpdateCommand = "update queue set RUN_PARAMETERS='@RUN_PARAMETERS',PRIORITY='@PRIORITY'  WHERE QUEUE_ID='@QUEUE_ID' AND DATE_SUBMITTED='@DATE_SUBMITTED' AND USERNAME='$user'";
         $ds->DeleteCommand = "delete from queue where ( QUEUE_ID='@QUEUE_ID' AND USERNAME='$user') or (QUEUE_ID='@QUEUE_ID' AND USERNAME='none')";

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
	$grid->Width = "950px";
	$grid->Height = "600px";

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
	$column->Width = "70px";
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

	$column = new GridBoundColumn();
	$column->HeaderText = "STATUS";
	$column->DataField = "STATUS";
	$column->ReadOnly = true;
        $column->AllowFiltering = false;
	$column->Width = "120px";
	$column->Align = "left";
	$grid->MasterTable->AddColumn($column);

	$column = new GridDropDownColumn();
	$column->HeaderText = "PRIORITY";
	$column->DataField = "PRIORITY";
        $column->AllowFiltering = false;
	$column->Width = "70px";
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



<form id="form1" method="post">
	<?php echo $koolajax->Render();?>
	<?php echo $grid->Render();?>
</form>
</div></div>

<!-- Layouts Begin -->

</div>


</div>
</div>



</body>
</html> 