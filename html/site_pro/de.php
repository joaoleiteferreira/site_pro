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
    


<script>
function loadXMLDoc(file)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("code").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",file,true);
xmlhttp.send();
}
</script>

<script>
function putXMLDoc(file)
{
var text = "blablabla";
var xmlDoc;

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlDoc=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlDoc=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlDoc.open("PUT", "XML/test.html", false);
xmlDoc.onload = function (oEvent) {
  // Uploaded.
};
xmlDoc.send("calculate this sum: 5+6");
}
</script>


<script>
function file_exists(file)
{
var result = 0;
$.ajax({
  type: "GET",
  url: file,
  success: function()
  {
  alert("File already exists, we don't allow to over write tests");
  },
  error: function(){
   putXMLDoc(file);
  }
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
			<div class="grid_24"><h2>Performance Tests</h2>
			
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
	$ds->SelectCommand = "select ID,TOPOLOGY,MODEL,XML_FILE,TIME_ADDED,NOTES,TRAFFIC,CONFIG from tests WHERE CLASS='DE' order by XML_FILE asc";
 	$ds->UpdateCommand = "update Testsconfig set Name='@Name', Notes='@Notes', Platform='@Platform',  File='@File', Class='@Class', ExecServer='@ExecServer',Testbed='@Testbed', Date='@Date', Priority='@Priority',Time='@Time',tree='@tree' WHERE ID=@ID";
	$ds->DeleteCommand = "delete from Testsconfig where ID=@ID";
	$ds->InsertCommand = "insert into Testsconfig (Name,File,Class,Notes,Platform,ExecServer,Testbed,Date,Priority,Project,Time,tree) values ('@Name','@File','@Class','@Notes','@Platform','@ExecServer','@Testbed','@Date','@Priority','$project','@Time','@tree')";
 

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
     	$column->CommandText = "Use as template";
	$column->OnClick = "myPopup2(\"{XML_FILE}\")";
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
	<div class="wrapper"><div class="grid_24"><h2 class="title">Edit Area</h2></div></div>
	</div>

		<div class="tab-content">
			<div class="container_24">
<!-- Full-width Begin -->
		<div class="wrapper"><div class="grid_24">
		  <form action="<?=$PHP_SELF?>" method="POST"> 
		<textarea id="code" name="code">
<?php
$filename = $var = $_GET['XML'];

$filename = "XML/$filename";
if (file_exists($filename)) {
    $file_open = fopen($filename,"r"); //fopen("something.txt","a+"); to add the contents to file
    $theData = fread($file_open, filesize($filename));
	$theData = htmlspecialchars( $theData );
    echo $theData;
    fclose($file_open);
} 

?>
		</textarea><br>
		<div class="btn-indent">
		XML File Name<input type="text" name="file_name">
		<input type="submit" class="btn inf" name="Save as" value="Save">
                </form><br>

<?php
if($_POST['code']){

$filename = $_REQUEST["file_name"];
$filename = strtolower ( $filename );
$needle   = '.xml';
$pos      = strripos($filename, $needle);
if ($pos === false) {
    $filename = "$filename.xml";
} 

if (preg_match('/[\'^£$%&*()}{@#~?><>,|= +¬-]/', $filename) || $filename == ".xml")
{
    echo '<script type="text/javascript">'
    , 'alert("You need to provide a name, also dont use special charaters or spaces");'
    , '</script>';
} else {


$filename = "XML/$filename";

if (file_exists($filename)) {
    echo '<script type="text/javascript">'
    , 'alert("The file already exists, can\'t overide");'
    , '</script>';
} else {
    echo '<script type="text/javascript">'
    , 'alert("Saving Please wait...Page will reload and you should be able to find your test");'
    , '</script>';
    $file_open = fopen($filename,"w+"); //fopen("something.txt","a+"); to add the contents to file
    fwrite($file_open, $_POST['code']);
    fclose($file_open);
    sleep(15);
    echo '<script type="text/javascript">'
   , 'window.open("http://joao-lnx/site_pro/performance.php","_self");'
   , '</script>';
/*
    $xml = new XMLReader();
    $valid = $xml->open("$filename");

 
	if ($valid == TRUE) {
		echo "<FONT COLOR=\"336633\">Saved to $filename, please wait 1 minute for tables to create test</FONT>";
		$xml->close("$filename");
	} else {
		unlink($filename);
		echo "<FONT COLOR=\"#990033\">This XML is not well formed, not saving it</FONT>";
	}
*/
}
}

}
?>
		</div>
		</div>
</div>
</div>
</div>
<script type="text/javascript">
	CodeMirror.commands.autocomplete = function(cm) {
		CodeMirror.showHint(cm, CodeMirror.javascriptHint);
	}
		var foldFunc = CodeMirror.newFoldFunction(CodeMirror.tagRangeFinder);
		window.editor = CodeMirror.fromTextArea(document.getElementById("code"), {
		mode: "xml",
		lineNumbers: true,
		lineWrapping: true,
		htmlMode: true,
		extraKeys: {"Ctrl-Q": function(cm){foldFunc(cm, cm.getCursor().line);}}
		});
		editor.on("gutterClick", foldFunc);
		foldFunc(editor, 9);
</script>
<script type="text/javascript">
		function myPopup2(test) {
		var test2 = "http://joao-lnx/site_pro/performance.php?XML=";
		var test = test2 + test;
		window.open(test,"_self");
}


</script>

</body>
</html> 
