<?php
switch($_GET[act]){
  // Ubah Password
  default:
    $edit=mysql_query("SELECT * 
						FROM pengguna 
						WHERE idPengguna='$_SESSION[idUser]'");
    $r=mysql_fetch_array($edit);

    echo "	<form id='form' method=POST action=./aksi.php?module=ubahpassword&act=update name='form1' id='form1' onSubmit='return validasi();'>
				<input type=hidden name=id value='$r[idPengguna]'>
				<fieldset>
				<h2 align=Center>Ubah Password</h2>
				<table align='Center'>
					<tr>
						<td>Password Lama</td>     
						<td> : <input type=password id='passwordlama' name='passwordlama' size=30 maxlength=255 class='validate(required)'></td>
					</tr>
					<tr>
						<td>Password Baru</td> 
						<td> : <input type=password id='passwordbaru1' name='passwordbaru1' size=30 maxlength=255 class='validate(required)'></td>
					</tr>
					<tr>
						<td>Ulang Password</td>     
						<td> : <input type=password id='passwordbaru2' name='passwordbaru2' size=30 maxlength=255 class='validate(required, match(#passwordbaru1))'></td>
					</tr>
				</table>
				</fieldset>
				<div class='submit' align=center>
        			<input type=submit class='submit' value=Simpan>
        			<input type=button value=Batal onclick=self.history.back()>
        		</div>
			</form>";
    break;  
}
?>
