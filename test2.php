<?php
	include "config/koneksi.php";
	$jmldata = mysql_num_rows(mysql_query("	SELECT * FROM gejalaumum"));
	$temp=$temp.$tempo;
	
	if($_GET[module]=='konsul' AND $_GET[act]=='awal'){
		$namaPasien	= $_POST[namaPasien];
		$jkPasien	= $_POST[jkPasien];
		$umurPasien	= $_POST[umurPasien];
		$alamatPasien	= $_POST[alamatPasien];
		
		if($namaPasien=='' OR $alamatPasien=='' OR $umurPasien=='' OR $jkPasien==''){
			echo "<script>alert('Silahkan isi identitas anda dengan lengkap !!!'); document.location='media.php?module=home'</script>";
			exit;
		}else{
			
		echo"<form id=form method=POST action='media.php?module=konsul&act=start' >
				<fieldset align=center>
					<div>
						<input type='hidden' size=25 maxlength=25 id='pasien' name='pasien' value='$namaPasien,$jkPasien,$umurPasien,$alamatPasien,' readonly>
						<h2>$namaPasien, Apa Kabar Anda hari ini ?</h2>
						<div>&nbsp</div>
						Apakah Anda ingin mendiagnosa gangguan kepribadian anda ?</br>
						Silahkan klik MULAI untuk memulainya !
					</div>
				</fieldset>
				<div align=center>
					<button type=submit class=positive ><img src=admin/icon/add.png>MULAI</button>
					<button type=button class=positive onclick=self.history.back()><img src=admin/icon/add.png>Kembali</button>
				</div>
			</form>";
		}
	}elseif ($_GET[module]=='konsul' AND $_GET[act]=='start'){
		$pasien=$_POST[pasien];
		echo"<form id=form  method=POST action='media.php?module=konsul&act=hitung' enctype='multipart/form-data'>
				<div align=center>	
					<input type='hidden' size=25 maxlength=25 id='pasien' name='pasien' value='$pasien' readonly>
					<div>$pertama $tempo</div>";
				echo"<div>
						Apakah Anda sering merasa cemas yang berlebihan ketika melakukan suatu kegiatan yang tidak biasa anda lakukan ?
					</div>
					<div>
						<input type=radio id='idAnswer' name='idAnswer' value='Ya' checked>Ya
						<input type=radio id='idAnswer' name='idAnswer' value='Tidak'>Tidak
					</div>
					<div>	
						<button type=submit class=positive><img src=admin/icon/add.png>LANJUT</button>
					<button type=button class=positive onclick=self.history.back()><img src=admin/icon/add.png>Kembali</button>
					</div>
				</div>
				<div> * Ini adalah pertanyaan awal untuk memulai diagnosa. Pertanyaan cemas diajukan karena merupakan gejalaumum yang dimiliki oleh semua gangguan</div>
			</form>";
	}
	
	elseif ($_GET[module]=='konsul' AND $_GET[act]=='hitung'){
		$pasien=$_POST[pasien];
		$cari=='cari1';
		if($_POST[idAnswer]=='Tidak'){
			echo"Anda dalam keadaan sehat";
		}else{
		echo"<form id=form method=POST action='media.php?module=konsultasi' enctype='multipart/form-data'>
					<fieldset>
					<input type='hidden' size=25 maxlength=25 id='pasien' name='pasien' value='$pasien' readonly>	";
						$tampilGejala = mysql_query("SELECT * FROM gejalaumum
													ORDER BY idGU DESC");
						while ($rGejala=mysql_fetch_array($tampilGejala)){
							echo"<div align=left><input type=radio id='idGU' name='idGU' value='$rGejala[idGU]'/>$rGejala[namaGU]</div>";
						}
				echo"</fieldset>
						<div>	
							<button type=submit class=positive><img src=admin/icon/add.png>LANJUT</button>
							<button type=button class=positive onclick=self.history.back()><img src=admin/icon/add.png>Kembali</button>
						</div>
						<div> * Pilihlah salah satu dari tiga rasa cemas yang ada di atas yang sering Anda rasakan</div>
				</form>";
		}
	}
	
	elseif ($_GET[module]=='konsul' AND $_GET[act]=='diagnosa'){
		echo"<fieldset>	";
						$tampilGejala = mysql_query("SELECT * FROM inferensi
													WHERE inferensi.idGK='$_GET[id]'
													ORDER BY idInferensi DESC");
						while ($rGejala=mysql_fetch_array($tampilGejala)){
							$gejalaumum=$gejalaumum.$rGejala[idGK].',';
						}
						//echo"$gejalaumum $_POST[counter]";
						$x=$_POST[counter]+1;
						$y=$x-1;
						$dtgejala=explode(',',$gejalaumum);
						if($x==1){
							$kode='GK00001';
							$gangguan=$_POST[idGU];
						}else{
							$y++;
							//$gejalaumum=$_POST[id];
							//$dtgejala=explode(',',$gejalaumum);
							$kode=$_POST[data];
							$gangguan=$_POST[gangguan];
							echo"$gangguan";
						}
						$tampil = mysql_query("SELECT * FROM inferensi, gejalakhusus
												WHERE 	inferensi.idGK='$kode' AND gejalakhusus.idGK=inferensi.idGK");
						$r=mysql_fetch_array($tampil);
						
						if($_POST[idAnswer]=='Ya'){
							$tempo=$_POST[temp].$_POST[data].',';
						}elseif($_POST[idAnswer]=='Tidak'){
							$tempo=$_POST[temp];
						}
						
						if($kode==''){
							$exit='HITUNG';
						}
						
						include 'test4.php';
					
				echo"</fieldset>";
	}elseif ($exit<>'exit' AND $kosong<>'SEHAT'){
		while ($r=mysql_fetch_array($tampil)){
			echo"<form id=form  method=POST action='media.php?module=konsul' enctype='multipart/form-data'>
					<div align=center>	
						<div>$pertama $tempo</div>";
					echo"<div>
							Apakah Anda mengalami $r[idGU]
							<input type='text' size=12 maxlength=12 id='temp' name='temp' value='$temp' readonly>
							<input type='text' size=12 maxlength=12 id='counter' name='counter' value='$i' readonly>
						</div>
						<div>
							<input type=radio id='idAnswer' name='idAnswer' value='$r[idGU]' checked>Ya
							<input type=radio id='idAnswer' name='idAnswer' value='$r[idGU],'>Tidak
						</div>
						<div>	
							<input type=submit class='submit' value=Simpan>
							<button type=button class=positive onclick=self.history.back()><img src=admin/icon/add.png>Kembali</button>
						</div>
					</div>
				</form>";
		}
	}elseif($exit=='exit' AND $kosong=='SEHAT' AND $_POST[counter]==1){

		echo"<div>
				<b>Anda dalam keadaan SEHAT</b>
			</div>";
		echo"<input type=button value='Kembali' onclick=location.href='?module=home'>";
		
	}elseif($exit=='exit' AND $hitung='HITUNG'){
		echo "semua $tempo";
		echo"<div>
				Silahkan Hitung
			</div>";
		echo"<input type=button value='Tambah' onclick=location.href='?module=konsultasi&act=analisa&id=$temp'>";
	}
?>