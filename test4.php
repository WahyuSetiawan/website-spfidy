<?php
	include "config/koneksi.php";
		echo"<form id=form  method=POST action='media.php?module=konsultasi' enctype='multipart/form-data'>
				<input type='hidden' size=25 maxlength=25 id='pasien' name='pasien' value='$pasien' readonly>	";
				//echo"<div>$tempo</div>";
				echo"<div align=center>
						Apakah Anda $rGejala[namaGK]?
						<div align=center>
							<input type='hidden' size=12 maxlength=12 id='idGU' name='idGU' value='$gejala' readonly>
							<input type='hidden' size=12 maxlength=12 id='temp' name='temp' value='$tempo' readonly>
							<input type='hidden' size=12 maxlength=12 id='data' name='data' value='$kode' readonly>
							<input type='hidden' size=12 maxlength=12 id='counter' name='counter' value='$x' readonly>
							<input type='hidden' size=12 maxlength=12 id='pasien' name='pasien' value='$pasien' readonly>
						</div>
					</div>
					<div align=center>
						<input type=radio id='idAnswer' name='idAnswer' value='Ya' checked>Ya
						<input type=radio id='idAnswer' name='idAnswer' value='Tidak'>Tidak
					</div>
					<div align=center>	
						<button type=submit class=positive><img src=admin/icon/add.png>LANJUT</button>
						<button type=button class=positive onclick=self.history.back()><img src=admin/icon/add.png>Kembali</button>
					</div>
					<div align=center>
						$rGejala[ketGK]
					</div>
				</div>
			</form>";
?>