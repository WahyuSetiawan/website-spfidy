
	<script type="text/javascript" src="js/simpletreemenu.js"></script>
	<link rel="stylesheet" type="text/css" href="css/simpletree.css" />
	
<?php
echo"<ul id='treemenu1' class='treeview'>
		<li>Beranda
			<ul>
				<li><a href='media.php?module=home'>Beranda</a></li>
			</ul>
		</li>
		<li>Diagnosa
			<ul>
				<li><a href='media.php?module=konsul&act=awal' onclick='showLoginForm(); return false;'>Diagnosa</a></li>
			</ul>
		</li>
		<li>About
			<ul>
				<li><a href='media.php?module=about'>About</a></li>
			</ul>
		</li>
		<li>Help
			<ul>
				<li><a href='media.php?module=help'>Help</a></li>
			</ul>
		</li>
	</ul>";
?>
	<script type="text/javascript">
		ddtreemenu.createTree("treemenu1", true)
		ddtreemenu.createTree("treemenu2", false)
	</script>

<?php
include "config/koneksi.php";
		
//Form Login
echo"<table width=100% bgcolor=white>
		<tr>
			<td id=judul colspan=2>
				LOGIN PAKAR
			</td>
		</tr>
		<tr>
			<td>	
				<form method=POST action='admin/login.php' >
						<tr>
							<td>Username</td>
							<td>: <input type=text name='usernamePengguna' id='usernamePengguna' size=15></td>
						</tr>
						<tr>
							<td>Password</td>
							<td>: <input type=password name='passwordPengguna' id='passwordPengguna' size=15></td>
						</tr>
						<tr>
							<td>&nbsp</td>
							<td align=right> <input type=submit value=Login width=20></td>
						</tr>
						<tr>
							<td>";
								if ($error == '1') {
									echo "<font size='2' color=#0000CC><center><img src='../gambar/allert_blue.png' /> Username/Password salahhhh! </center></font>";
								}
						echo"</td>
						</tr>
				</form>
				<hr color=#265180>
			</td>
		</tr>
	</table>";
?>
