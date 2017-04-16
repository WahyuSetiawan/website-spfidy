
<table width="100%" >
<?php
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
include "config/library.php";
include "config/class_paging.php";



// Bagian Home
if ($_GET[module]=='home'){
	echo "	<tr>
				<td class=Judul_head align=center colspan=2><h2>$judul</h2></br></td>
			</tr>
			<tr>
				<td> 
					<h3 align=center>
						Selamat datang di Sistem Diagnosa Gangguan Kepribadian</br>
						Aplikasi ini adalah aplikasi untuk mendiagnosa awal gangguan kepribadian seseorang.</br>
						Disarankan untuk pengguna aplikasi ini adalah seseorang yang benar-benar telah mengalami gejala-gejala dari pertanyaan yang diajukan 
						setidaknya 6 bulan dan berusia remaja hingga dewasa.
					</h3>
				</td>
			</tr>";
			
}

// Bagian About
elseif ($_GET[module]=='about'){
	echo "	<tr>
				<td class=Judul_head align=center colspan=2><h2>About</h2></br></td>
			</tr>
			<tr>
				<td> 
				<div>
						Gangguan kepribadian (personality disorder) adalah pola perilaku atau cara berhubungan dengan orang lain yang benar-benar kaku. Sikap-sikap kepribadian yang terganggu menjadi jelas di masa remaja atau awal masa dewasa dan terus berlanjut di sepanjang kehidupan dewasa, semakin mendalam dan mengakar sehingga semakin sulit untuk diubah. Orang dengan gangguan kepribadian pada umumnya tidak merasa perlu untuk berubah. Orang dengan gangguan kepribadian cenderung menganggap sikap-sikap mereka adalah hal yang alami pada diri mereka. Akibatnya, orang dengan gangguan kepribadian lebih cenderung dibawa ke ahli kesehatan mental oleh orang lain daripada oleh diri mereka sendiri.
					</div>
					
					<h3>
						Gangguan kepribadian tersebut adalah sebagai berikut:
					</h3>
					<table align=left width=100%>
						<tr>
							<th width=5>No</th>
							<th width=150>Nama Gangguan</th>
							<th>Keterangan</th>
						</tr>";
					$tampil = mysql_query("	SELECT * FROM Gangguan
											ORDER BY nmGangguan ASC");
					$no=1;
					while ($r=mysql_fetch_array($tampil)){
						echo"
							<tr>
								<td align=center>$no</td>
								<td>$r[nmGangguan]</td>
								<td>$r[ketGangguan]</td>
							</tr>
						";
					$no++;
					}
			echo"
				</table>
				</td>
			</tr>";
			
}
// Konsultasi
elseif ($_GET[module]=='konsul'){
	echo"<tr align=center>
		<td align=center>";
	
	include 'test2.php';
	echo"</td>
		</tr>";
}

// Konsultasi
elseif ($_GET[module]=='konsultasi'){

		$gejala=$_POST[idGU];
		$pasien=$_POST[pasien];
	
	if($_POST[counter]==0){
		$status='cari';
		$kode='GK00001';
		//echo"test $kode";
		$tampilDiagnosa = mysql_query("	SELECT * FROM diagnosa
							WHERE diagnosa.idGU='$gejala'
							ORDER BY idDiagnosa DESC");
		$no=1;
		echo"<table border=1 bordercolor=black class='pesan'>
			<tr>
				<th>Nama Gangguan</th>
				<th>Bobot Gangguan</th>
				<th>Bobot Gangguan/Gejala</th>
				<th>Total</th>
			</tr>";
		while ($rDiagnosa=mysql_fetch_array($tampilDiagnosa)){
			$tampilData = mysql_query("	SELECT * FROM gangguan
								WHERE gangguan.idGangguan='$rDiagnosa[idGangguan]' LIMIT 1");
			$rData=mysql_fetch_array($tampilData);
		
			//===============================BAYES CODE============================================================
			$diagnosa=$diagnosa.$rDiagnosa[idGangguan].',';	
			$data[$no]=$rData[bobotGangguan]*$rDiagnosa[bobotDiagnosa];
			echo"<tr>
					<td>$rData[nmGangguan]</td>
					<td>$rData[bobotGangguan]</td>
					<td>$rDiagnosa[bobotDiagnosa]</td>
					<td>$data[$no]</td>
				</tr>";
			//echo"$no. $data[$no] = $rData[nmGangguan] $rData[bobotGangguan] * $rDiagnosa[bobotDiagnosa]</br>";
			$total=$total+$data[$no];
			$no++;
		}
		echo"</table>";
		$dataPenyakit=explode(',',$diagnosa);
		//echo"semua: $total";
		for ($i=0; $i<=count($dataPenyakit)-2; $i++){
			$hasil[$i]=($data[$i+1]/$total).$i;
		}
		echo"</br>";
		//pengurutan besar -> kecil
		$hasilnya=$hasil;
		rsort($hasilnya);
		
		
		echo"<h2>Anda didiagnosa mengalami gangguan kepribadian: </h2> ";
		for($i=0; $i<=count($hasil)-1; $i++){
			for($j=0; $j<=2; $j++){
				if($hasilnya[$j]==$hasil[$i]){
					$nume++;
					//pembulatan 3 decimal
					$bulat=round($hasil[$i],3);
					$persen=$bulat*100;
					$tampilHasil = mysql_query("SELECT * FROM gangguan
												WHERE gangguan.idGangguan='$dataPenyakit[$i]' LIMIT 1");
					$rHasil=mysql_fetch_array($tampilHasil);
					//$nume. $rHasil[nmGangguan] = $bulat / $persen % ($data[1] / $total)</br>
					echo"<div>
							$nume. $rHasil[nmGangguan] = $persen %</br>
						</div>";
				}
			}
		}
		echo"<div>
				<button type=button class=flip >Detail Perhitungan</button>
			</div>";
	}else{
		$status='cari';
		//$kode=$_POST[data];
		
		if($_POST[counter] == 1){
			$status='cari';
			$kode='GK00001';
		}else{
			$kode=$_POST[data];
		}
	}

		if($_POST[idAnswer]=='Ya'){
			$tempo=$_POST[temp].$_POST[data].',';
			
			$tampilGK = mysql_query("SELECT * FROM rule
									WHERE rule.idGK='$kode'");
			$rGK=mysql_fetch_array($tampilGK);					
			$kode=$rGK[yaRule];
		}elseif($_POST[idAnswer]=='Tidak'){
			$tempo=$_POST[temp];
			$tampilGK = mysql_query("SELECT * FROM rule
									WHERE rule.idGK='$kode'");
			$rGK=mysql_fetch_array($tampilGK);
			$kode=$rGK[tidakRule];
		}
		
		if($kode<>'-'){
			$x=$_POST[counter]+1;
			//$tempo=$_POST[temp].$_POST[data].',';
			//$x=$y;

			$tampilGejala = mysql_query("SELECT * FROM gejalakhusus
										WHERE gejalakhusus.idGK='$kode'");
			$rGejala=mysql_fetch_array($tampilGejala);					
			if($x > 1){
				include "test4.php";
			}else{
				echo"<form id=form  method=POST action='media.php?module=konsultasi' enctype='multipart/form-data'>
				<input type='hidden' size=25 maxlength=25 id='pasien' name='pasien' value='$pasien' readonly>	";
				//echo"<div>$tempo</div>";
				echo"<div align=center>
						<div align=center>
							<input type='hidden' size=12 maxlength=12 id='idGU' name='idGU' value='$gejala' readonly>
							<input type='hidden' size=12 maxlength=12 id='counter' name='counter' value='$x' readonly>
							<input type='hidden' size=12 maxlength=12 id='pasien' name='pasien' value='$pasien' readonly>
						</div>
					</div>
					<div align=center>	
						<button type=submit class=positive><img src=admin/icon/add.png>LANJUT</button>
						<button type=button class=positive onclick=self.history.back()><img src=admin/icon/add.png>Kembali</button>
					</div>
				</div>
			</form>";
			}
		}else{
			//=============================EVIDENCE CODE =============================================================================
			if($_POST[data]=='GK00003'){
				$hasil=0.7*(0.6/0.5);
			}elseif($_POST[data]=='GK00004'){
				$hasil=0.4*(0.7/0.3);
			}elseif($_POST[data]=='GK00021'){
				$hasil=0.6*(0.4/0.4);
			}elseif($_POST[data]=='GK00041'){
				$hasil=0.5*(0.5/0.4);
			}elseif($_POST[data]=='GK00027'){
				$hasil=0.6*(0.4/0.4);
			}elseif($_POST[data]=='GK00039'){
				$hasil=0.6*(0.5/0.4);
			}elseif($_POST[data]=='GK00045'){
				$hasil=0.5*(0.5/0.4);
			}elseif($_POST[data]=='GK00018'){
				$hasil=0.7*(0.5/0.4);
			}elseif($_POST[data]=='GK00034'){
				$hasil=0.7*(0.5/0.5);
			}elseif($_POST[data]=='GK00066'){
				$hasil=0.6*(0.6/0.5);
			}
			
			$tampilGejala = mysql_query("SELECT * FROM inferensi, gangguan
										WHERE inferensi.idGK='$_POST[data]' AND inferensi.idGangguan=gangguan.idGangguan");
			$rGangguan=mysql_fetch_array($tampilGejala);
			
			
			$tampilDiagnosa = mysql_query("SELECT * FROM diagnosa, gangguan, gejalaumum
											WHERE diagnosa.idGU='$gejala' AND gejalaumum.idGU='$gejala' AND gangguan.idGangguan='$rGangguan[idGangguan]'");
			$rDiagnosa=mysql_fetch_array($tampilDiagnosa);
			while ($rDiagnosa2=mysql_fetch_array($tampilDiagnosa)){
				$total=$rDiagnosa2[bobotGangguan]*$rDiagnosa2[bobotDiagnosa];
				$subtotal=$subtotal+$total;
			}
			
			$GTotal=$rDiagnosa[bobotGangguan]*$rDiagnosa[bobotDiagnosa]/$subtotal;
			$GTotal=round($GTotal,3);
			$GTotal=$GTotal*100;
			$pas=explode(',',$pasien);
			echo"<div>
					<h3 align=center>Hasil Kesimpulan</h3>
					<table align=left width=100%>
						<tr>
							<td width=10%>Nama </td>
							<td>: <b>$pas[0]</b></td>
						</tr>
						<tr>
							<td>Jenis Kelamin </td>
							<td>: <b>$pas[1]</b></td>
						</tr>
						<tr>
							<td>Umur </td>
							<td>: <b>$pas[2]</b></td>
						</tr>
						<tr>
							<td>Alamat </td>
							<td>: <b>$pas[3]</b></td>
						</tr>
					</table></br>
				</div>
				<div>&nbsp</div>
				<div align=left>Anda didiagnosa mengalami gangguan <b>$rGangguan[nmGangguan] </b> dengan nilai kemungkinan $hasil<div></br>";
				
			$tampilSolusi = mysql_query("SELECT * FROM solusi, gangguan, pencegahan
										WHERE solusi.idGangguan='$rGangguan[idGangguan]' AND solusi.idGangguan=gangguan.idGangguan 
										AND solusi.idPencegahan=pencegahan.idPencegahan
										ORDER BY pencegahan.nmPencegahan ASC");	
			echo"<h2 align=left>Solusi yang harus dilakukan antara lain:</h2>";
			while ($r=mysql_fetch_array($tampilSolusi)){
				$hitunggg++;
				echo"<div align=left>$hitunggg $r[nmPencegahan]</div>";
			}
			
			
			
		}
	
	?>
	<script type="text/javascript" src="jquery-1.4.min.js"></script>
    <script type="text/javascript"> 
      $(document).ready(function(){
        $(".flip").click(function(){
          $(".pesan").slideToggle("slow");
        });
      });
    </script>
    <style type="text/css"> 
      table.pesan {
        height:120px;
        display:none;
      }
      div.pesan, p.flip {
        margin: 0px;
        padding: 5px;
        text-align: center;
        background: lightgreen;
        border: 1px solid black;
        cursor: pointer;
      }
    </style>
	
	<?php
	/*
	
		$tampilDiagnosa = mysql_query("	SELECT * FROM diagnosa
							WHERE diagnosa.idGU='$gejala'
							ORDER BY idDiagnosa DESC");
		$no=1;
		echo"<table border=1 bordercolor=black class='pesan'>		
					<tr align=center><td colspan=5>Tabel Perbandingan Gejala/Gangguan</td></tr>
					
					<tr>
						<th>Nama Gangguan</th>
						<th>Bobot Gangguan</th>
						<th>Bobot Gangguan/Gejala</th>
						<th>Total</th>
					</tr>";
				while ($rDiagnosa=mysql_fetch_array($tampilDiagnosa)){
					$tampilData = mysql_query("	SELECT * FROM gangguan
										WHERE gangguan.idGangguan='$rDiagnosa[idGangguan]' LIMIT 1");
					$rData=mysql_fetch_array($tampilData);
				
					$diagnosa=$diagnosa.$rDiagnosa[idGangguan].',';	
					$data[$no]=$rData[bobotGangguan]*$rDiagnosa[bobotDiagnosa];
					echo"<tr>
							<td>$rData[nmGangguan]</td>
							<td>$rData[bobotGangguan]</td>
							<td>$rDiagnosa[bobotDiagnosa]</td>
							<td>$data[$no]</td>
						</tr>";
					//echo"$no. $data[$no] = $rData[nmGangguan] $rData[bobotGangguan] * $rDiagnosa[bobotDiagnosa]</br>";
					$total=$total+$data[$no];
					$no++;
				}
				echo"</table>";
		$dataPenyakit=explode(',',$diagnosa);
		//echo"semua: $total";
		for ($i=0; $i<=count($dataPenyakit)-2; $i++){
			$hasil[$i]=($data[$i+1]/$total).$i;
			//echo"$i $hasil[$i]</br>";
		}
		echo"</br>";
		$hasilnya=$hasil;
		rsort($hasilnya);
		//Perhtungan Bayes I (Pilihan)
		echo"<div>
				<h2>Anda didiagnosa mengalami gangguan kepribadian :</br> </h2>
			</div>";
			$hit=0;
		for($i=0; $i<=count($hasil)-1; $i++){
			for($j=0; $j<=2; $j++){
				if($hasilnya[$j]==$hasil[$i]){
					$bulat=round($hasil[$i],3);
					$persen=$bulat*100;
					$tampilHasil = mysql_query("SELECT * FROM gangguan
												WHERE gangguan.idGangguan='$dataPenyakit[$i]' LIMIT 1");
					$rHasil=mysql_fetch_array($tampilHasil);
					$hit++;
					echo"<div>
							<h2>$hit. <a href=?module=konsul&act=diagnosa&idGejala=$gejala&id=$rHasil[idGangguan]&pasien=$pasien> $rHasil[nmGangguan] </a> = $persen %</br></h2>
						</div>";
				}
			}
		}
	echo"<div>
			Pilihlah salah satu gangguan diatas yang ingin anda telusuri lebih lanjut. 
		<div>
		<div>
			<button type=button class=flip >Detail Perhitungan</button>
		</div>";
	}
	*/
	
}

//Bagian Help
elseif ($_GET[module]=='help'){
	echo "	</br>
			<div>
				<div class='Judul_head' align=center><b> Bantuan </b></div>
			</div>
			<div align=left>
				Berikut ini adalah cara untuk menggunakan sistem, yaitu:</br>
				1. Pasien wajib mengisi data identitas pasien.</br>
				2. Pasien menjawab pertanyaan yang diberikan sistem dengan pilihan Ya/Tidak.</br>
				3. Pasien dapat mencetak hasil diagnosa yang dilakuan.</br>
			</div>"; 
}
//Bagian About
elseif ($_GET[module]=='about'){
	echo "	<div>
				<div class=Judul_head align=center>Tentang Kami</div>
			</div></br>
			<div align=center>
				Halaman Ini berisi tentang pembuat sistem
			</div>"; 
}
?>
</table>
