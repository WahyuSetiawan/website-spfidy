<table border='0' align='center' cellpadding='0' cellspacing='0' width='100%'>
<?php
if ($_SESSION[leveluser]=='Administrator'){
	echo"	<tr>
				<td valign='top'>
					<div id='menu' >
						<ul class='menu'>
							<li><a href='media.php?module=home'><span>Beranda</span></a></li>
							<li><a href='media.php?module=pengguna'><span>Pengguna</span></a></li>
							<li><a href='media.php?module=gangguan'><span>Gangguan</span></a></li>
							<li><a href='media.php?module=gejala'><span>Gejala</span></a></li>
							<li><a href='media.php?module=detailgejala'><span>Detail Gejala</span></a></li>
							<li><a href='media.php?module=pencegahan'><span>Pencegahan</span></a></li>
							<li><a href='media.php?module=rule'><span>Rule</span></a></li>
						</ul>
					</div>
				</td>
				<td valign='top' align='right' width=80>
					<div id='menu'>
						<ul class='menu' >
							<li><a href='logout.php'><span>Keluar</span></a></li>
						</ul>
					</div>
				</td>
			</tr>";
}else{
	echo"	<tr>
				<td valign='top'>
					<div id='menu' >
						<ul class='menu'>
							<li><a href='media.php?module=home'><span>Beranda</span></a></li>
							<li><a href='media.php?module=gangguan'><span>Gangguan</span></a></li>
							<li><a href='media.php?module=gejala'><span>Gejala</span></a></li							<li><a href='media.php?module=pencegahan'><span>Pencegahan</span></a></li>
						</ul>
					</div>
				</td>
				<td valign='top' align='right' >
					<div id='menu'>
						<ul class='menu' >
							<li><a href='logout.php'><span>Keluar</span></a></li>
						</ul>
					</div>
				</td>
			</tr>";
}
?>
</table>