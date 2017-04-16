<?php
echo"	<table align='center' width=100%>
			<tr>
				<td valign='top' align='left'>
					<div id='menu' >
						<ul class='menu' >
							<li><a href='media.php?module=home'><span>Beranda</span></a></li>
							<li><a href='media.php?module=konsul&act=awal' onclick='showLoginForm(); return false;'><span>Diagnosa</span></a></li>
							<li><a href='media.php?module=about'><span>About</span></a></li>
							<li><a href='media.php?module=help'><span>Help</span></a></li>
						</ul>
					</div>
				</td>
				<td valign='top' width='220'>
					<div id='menu' align='right'>
						<ul class='menu' >
							<form id='myform' method='post' action='admin/login.php' >
							<li class='fm-req'><span><input type='text' id='usernamePengguna' name='usernamePengguna'  size=5/></span></li>
							<li class='fm-req'><span><input type='password' id='passwordPengguna' name='passwordPengguna'   size=5/></span></li>
							<li id='fm-submit' class='fm-req'><span><input name='Submit' type='submit' value='Login'/></span></li>
							</form>
						</ul>
					</div>
				</td>
			</tr>
		</table>";

?>