<?php
	if($_POST[counter]==0){
		$pasien=$_GET[pasien];
		$idGejala=$_GET[idGejala];
	}else{
		$pasien=$_POST[pasien];
		$idGejala=$_POST[idGejala];
	}
	include "config/koneksi.php";
	if ($exit<>'HITUNG'){
		echo"<form id=form  method=POST action='media.php?module=konsul&act=diagnosa' enctype='multipart/form-data'>
				<div align=center>";
				//echo"<div>$tempo</div>";
				echo"<div>
						Apakah Anda $r[namaGK]?
						<input type='hidden' size=25 maxlength=25 id='idGejala' name='idGejala' value='$idGejala' readonly>
						<input type='hidden' size=25 maxlength=25 id='pasien' name='pasien' value='$pasien' readonly>
						<input type='hidden' size=12 maxlength=20 id='id' name='id' value='$gejalaumum' readonly>
						<input type='hidden' size=12 maxlength=20 id='temp' name='temp' value='$tempo' readonly>
						<input type='hidden' size=12 maxlength=20 id='data' name='data' value='$kode' readonly>
						<input type='hidden' size=12 maxlength=20 id='gangguan' name='gangguan' value='$gangguan' readonly>
						<input type='hidden' size=12 maxlength=20 id='counter' name='counter' value='$x' readonly>
					</div>
					<div>
						<input type=radio id='idAnswer' name='idAnswer' value='Ya' checked>Ya
						<input type=radio id='idAnswer' name='idAnswer' value='Tidak'>Tidak
					</div>
					<div>	
						<button type=submit class=positive><img src=admin/icon/add.png>LANJUT</button>
						<button type=button class=positive onclick=self.history.back()><img src=admin/icon/add.png>Kembali</button>
						<button type=button class=positive onclick=location.href='?module=home'><img src=admin/icon/add.png>Keluar</button>
					</div>
				</div>
				<div>
					$r[ketGK]	
				</div>
			</form>";
	}elseif ($exit=='HITUNG'){
		//Perhitungan Bayesian Evidence
		if($gangguan=='GANGGUAN0001'){
			$hasil=0.5*(0.4/0.6);
		}elseif($gangguan=='GANGGUAN0002'){
			$hasil=0.4*(0.7/0.3);
		}elseif($gangguan=='GANGGUAN0003'){
			$hasil=0.6*(0.4/0.4);
		}elseif($gangguan=='GANGGUAN0004'){
			$hasil=0.5*(0.5/0.4);
		}elseif($gangguan=='GANGGUAN0005'){
			$hasil=0.6*(0.4/0.4);
		}elseif($gangguan=='GANGGUAN0006'){
			$hasil=0.4*(0.3/0.5);
		}elseif($gangguan=='GANGGUAN0007'){
			$hasil=0.5*(0.5/0.4);
		}elseif($gangguan=='GANGGUAN0008'){
			$hasil=0.7*(0.5/0.4);
		}elseif($gangguan=='GANGGUAN0009'){
			$hasil=0.4*(0.5/0.5);
		}elseif($gangguan=='GANGGUAN0010'){
			$hasil=0.6*(0.6/0.5);
		}
		$tampilGejala = mysql_query("SELECT * FROM solusi, gangguan, pencegahan
									WHERE solusi.idGangguan='$gangguan' AND solusi.idGangguan=gangguan.idGangguan AND solusi.idpencegahan=pencegahan.idPencegahan
									ORDER BY nmPencegahan ASC");
		$rGangguan=mysql_fetch_array($tampilGejala);
		echo"<div>
				<h2>Hasil Kesimpulan</h2>
			</div>
			<div align=left>Anda didiagnosa mengalami gangguan <b>$rGangguan[nmGangguan]</b> dengan nilai evidence/akhir $hasil<div></br>";
			
		$tampilSolusi = mysql_query("SELECT * FROM solusi, gangguan, pencegahan
									WHERE solusi.idGangguan='$gangguan' AND solusi.idGangguan=gangguan.idGangguan AND solusi.idPencegahan=pencegahan.idPencegahan
									ORDER BY pencegahan.nmPencegahan ASC");	
		echo"<h2 align=left>Solusi yang harus dilakukan antara lain:</h2>";
		while ($r=mysql_fetch_array($tampilSolusi)){
			$hitunggg++;
			echo"<div align=left>$hitunggg $r[nmPencegahan]</div>";
		}
			
	echo"<div>
			<a target=_blank  href='print.php?evidence=$hasil&gangguan=$gangguan&pasien=$_POST[pasien]'>PRINT</a>
			<button type=button class=positive onclick=location.href='media.php?module=konsultasi&pasien=$_POST[pasien]&idGejala=$_POST[idGejala]&status=cari'>Kembali</button>
			<button type=button class=positive onclick=location.href='kanan.php?module=home'>Keluar</button>
		</div>";
		
	}
?>