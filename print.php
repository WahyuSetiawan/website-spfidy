<?php
	include "config/koneksi.php";
	$gangguan=$_GET[gangguan];
	$hasil=$_GET[hasil];
	$pasien=$_GET[pasien];
	$dataPasien=explode(',',$pasien);
	
	echo"<table>
			<tr>
				<td><b>Nama</b><td>
				<td> : $dataPasien[0]<td>
			</tr>
			<tr>
				<td><b>Jenis Kelamin</b><td>
				<td> : $dataPasien[1]<td>
			</tr>
			<tr>
				<td><b>Umur</b><td>
				<td> : $dataPasien[2]<td>
			</tr>
			<tr>
				<td><b>Alamat</b><td>
				<td> : $dataPasien[3]<td>
			</tr>
		</table>";
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
?>