
<link href="menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type='text/javascript' src='js/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='js/jquery.dcmegamenu.1.2.js'></script>
<script type="text/javascript">
	$(document).ready(function($){
		$('#mega-menu-tut').dcMegaMenu({
			rowItems: '3',
			speed: 'fast'
		});
	});
</script>
	<style>
		/* Demo Styles */
		.wrap {width: 100%; margin: 0 auto;}
	</style>
<?php
echo"<div class='wrap'>
		<div class='dcjq-mega-menu'>
		<ul id='mega-menu-tut' class='menu'>
			<li><a href='media.php?module=home'><span>Beranda</span></a></li>
			<li><a href='media.php?module=konsul&act=awal' onclick='showLoginForm(); return false;'><span>Diagnosa</span></a></li>
			<li><a href='#' class='parent'><span>Login</span></a>
				<ul>
					<form method='post' align=right action='admin/login.php'>
						<li><a href='#' class='parent'><span>Username:<input type='text' id='usernamePengguna' name='usernamePengguna'  size=10></span></a></li>
						<li><a href='#' class='parent'><span>Password:<input type='password' id='passwordPengguna' name='passwordPengguna'   size=10></span></a></li>
						<li><a href='#' class='parent'><span><input name='Submit' type='submit' value='Login'></span></a></li>
					</form>
				</ul>
			</li>
		</div>";
?>
