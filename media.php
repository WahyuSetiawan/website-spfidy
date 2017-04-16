<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Sistem Berbasis Pengetahuan untuk Diagnosa Awal Gangguan Kepribadian Menggunakan Teorema Bayes</title>
	<link type="text/css" href="menu1.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/jquerycssmenu.css"/>
	<link rel="stylesheet" type="text/css" href="css/tips-form.css">
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquerycssmenu.js"></script>

	<link type="text/css" href="css/style.css" rel="stylesheet" />
	<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.custom.css" rel="stylesheet" />
    <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/menu.js'></script>
	
	<script language="javascript" src="js/headline.js"></script>
 	<script type="text/javascript" src="js/jquery.js"></script>
  	<script type="text/javascript" src="js/menu.js"></script>
	
	<script type="text/javascript" src="js/jquery-1.4.js"></script>
	<script type="text/javascript" src="js/jquery.ketchup.js"></script>
    <script type="text/javascript" src="js/jquery.ketchup.messages.js"></script>
    <script type="text/javascript" src="js/jquery.ketchup.validations.basic.js"></script>
	
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.custom.min.js"></script>
	
	<script type="text/javascript">
		function showLoginForm(){
			$("#login-dialog").dialog({
				show:'bounce',
				hide: 'fold',
				buttons : {
					"Daftar" : function(){
						$("#form").submit();
					},
					"Batal" : function(){
						$(this).dialog('close');
					}
				}
			});
		}
		$(document).ready(function(){
			$('#form').ketchup();
		});	
	</script>
	
</head>
<body>
	<div id="login-dialog" title="Silahkan isi identitas anda!" style="display:none;">
		<form id="form" method="POST" action='media.php?module=konsul&act=awal'>
			<table>
				<tr>
					<td>Nama</td>
					<td>:<input type="text" id="namaPasien" name="namaPasien" class="validate(required)" size=20 max=255></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td>:
						<input type=radio id='jkPasien' name='jkPasien' value='Laki-Laki' checked>Laki-Laki
						<input type=radio id='jkPasien' name='jkPasien' value='Perempuan'>Perempuan
				</tr>				
				<tr>
					<td>Umur</td>
					<td>:<input type="text" id="umurPasien" name="umurPasien" class="validate(required)" size=12 max=15></td>
				</tr>		
				<tr>
					<td>Alamat</td>
					<td>:<input type="text" id="alamatPasien" name="alamatPasien" class="validate(required)" size=12 max=15></td>
				</tr>
			</table>
			<div> * Anda Harus mengisi identitas anda terlebih dahulu sebelum melakukan Diagnosa</div>
		</form>
	</div>
	<table width=80% bgcolor=white>
		<tr>
			<td colspan=2><img src='images/header.jpg' width=100% height=100></td>
		</tr>
		<tr>
			<td id=judul colspan=2>
				<marquee behaviour="alternate" scrollamount="6" width="100%" >
					<b> </b>
				</marquee>
			</td>
		</tr>
		<tr>
			<td valign='top' align=left width=20% bgcolor=grey>
				<?php include 'kiri.php'; ?>
			</td>
			<td valign='top' align=left>
				<?php include 'kanan.php'; ?>
			</td>
		</tr>
	</table>
	<div align='center'>Fidya@2012 </div>
</body>
</html>
