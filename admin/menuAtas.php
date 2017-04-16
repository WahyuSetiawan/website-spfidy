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
			<li><a href='#' class='parent'><span>Master</span></a>
				<ul>
					<li><a href='media.php?module=pengguna'><span>Pengguna</span></a></li>
					<li><a href='media.php?module=gejalaumum'><span>Gejala Umum</span></a></li>
					<li><a href='media.php?module=gejalakhusus'><span>Gejala Khusus</span></a></li>
					<li><a href='media.php?module=gangguan'><span>Gangguan</span></a></li>
					<li><a href='media.php?module=pencegahan'><span>Pencegahan</span></a></li>
				</ul>
			</li>
			<li><a href='#' class='parent'><span>Rule</span></a>
				<ul>
					<li><a href='media.php?module=rule'><span>Rule</span></a></li>
				</ul>
			</li>
			<li ><a href='logout.php' ><span>Keluar</span></a></li>
		</div>";
?>
