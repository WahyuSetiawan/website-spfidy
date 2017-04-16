<?php

session_start();
if (empty($_SESSION[namauser]) AND empty($_SESSION[passuser])){
	echo "<link href='../config/adminstyle.css' rel='stylesheet' type='text/css'>
		<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
?>

<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="../css/jquerycssmenu.css" />
	<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="../js/jquerycssmenu.js"></script>	
	
  	<link rel="stylesheet" href="../css/val.css" type="text/css" />  
	<link rel="stylesheet" type="text/css" media="screen" href="../css/reset.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/jquery.ketchup.css" />
	<link rel="stylesheet" type="text/css" href="../css/tips-form.css">
    <link type="text/css" href="../css/style.css" rel="stylesheet" />
	
	<link type="text/css" href="../development-bundle/themes/base/ui.all.css" rel="stylesheet" />   
    <script type="text/javascript" src="../development-bundle/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="../development-bundle/ui/ui.core.js"></script>
    <script type="text/javascript" src="../development-bundle/ui/ui.datepicker.js"></script>
    <script type="text/javascript" src="../development-bundle/ui/i18n/ui.datepicker-id.js"></script>
	
    <script type="text/javascript" src="../js/jquery.tools.min.js"></script>
  	<script type="text/javascript" src="../js/jquery.js"></script>
  	<script type="text/javascript" src="../js/menu.js"></script>
    
    <script type="text/javascript" src="../js/jquery-1.4.js"></script>
    <script type="text/javascript" src="../js/jquery.ketchup.js"></script>
    <script type="text/javascript" src="../js/jquery.ketchup.messages.js"></script>
    <script type="text/javascript" src="../js/jquery.ketchup.validations.basic.js"></script>
	
	<script type="text/javascript"> 
		$(document).ready(function(){
			$('#form').ketchup();
			$("#tanggal").datepicker({
				dateFormat      : "dd MM yy",        
				showOn          : "button",
				buttonImage     : "../development-bundle/demos/datepicker/images/calendar.gif",
				buttonImageOnly : true				
			});
		});	
    </script>
</head>
<body>
	<table width=80% align=center>
		<tr id="wraper">
			<td><img src='../images/header.jpg' width=100% height=100></td>
		</tr>		
		<tr>
			<td colspan=2>
				<?php 
					include "menuAtas.php";
				?>
			</td>
		</tr>
		<tr>
			<td id="wraper" valign=top>
				<?php include "content.php"; ?>
			</td>
		</tr>
	</table>
	<div align='center'>FIDY &copy:2012 </div>
</body>
</html>
<?php
}
?>

