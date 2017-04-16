<?php
session_start();
include "../config/koneksi.php";
include "../config/library.php";

$module=$_GET[module];
$act=$_GET[act];

// Input Pengguna
if ($module=='pengguna' AND $act=='Add'){
  $pass = md5($_POST[passwordPengguna]);
  mysql_query("INSERT INTO pengguna	(
									idPengguna,
									nmPengguna,
									usernamePengguna,
									passwordPengguna,
									jkPengguna,
									alamatPengguna,
									nohpPengguna,
									emailPengguna												
									) 
							VALUES	(
									'$_POST[idPengguna]',
									'$_POST[nmPengguna]',
									'$_POST[usernamePengguna]',
									'$pass',
									'$_POST[jkPengguna]',
									'$_POST[alamatPengguna]',
									'$_POST[nohpPengguna]',
									'$_POST[emailPengguna]'
									)");
  header('location:media.php?module='.$module);
}

// Update pengguna
elseif ($module=='pengguna' AND $act=='Update'){
  // Apabila password tidak diubah
  if (empty($_POST[passwordPengguna])) {
    mysql_query("UPDATE pengguna SET 	nmPengguna		= '$_POST[nmPengguna]',
										usernamePengguna= '$_POST[usernamePengguna]',
										jkPengguna		= '$_POST[jkPengguna]',
										alamatPengguna	= '$_POST[alamatPengguna]',
										nohpPengguna	= '$_POST[nohpPengguna]',
										emailPengguna	= '$_POST[emailPengguna]'
								WHERE idPengguna      	= '$_POST[idPengguna]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST[passwordPengguna]);
    mysql_query("UPDATE pengguna SET 	nmPengguna		= '$_POST[nmPengguna]',
										usernamePengguna= '$_POST[usernamePengguna]',
                  						passwordPengguna= '$pass',
										jkPengguna		= '$_POST[jkPengguna]',
										alamatPengguna	= '$_POST[alamatPengguna]',
										nohpPengguna	= '$_POST[nohpPengguna]',
										emailPengguna	= '$_POST[emailPengguna]'
                                  WHERE idPengguna		= '$_POST[idPengguna]'");
  }
  header('location:media.php?module='.$module);
}

//Hapus Pengguna
elseif ($module=='pengguna' AND $act=='hapus'){
	IF ('$_GET[id]'<>''){
		mysql_query("DELETE FROM pengguna WHERE idPengguna = '$_GET[id]'");
	}
	
	$n = $_POST['jmlbaris'];
	for ($i=1; $i<=$n-1; $i++){
		if (isset($_POST['idPengguna'.$i])){
			$idPengguna = $_POST['idPengguna'.$i]; 
			$query = "DELETE FROM pengguna WHERE idPengguna = '$idPengguna'";
			mysql_query($query);
		}
	}
  header('location:media.php?module='.$module);
}

// Ubah Password
elseif ($module=='ubahpassword' AND $act=='update'){
	$pass=md5($_SESSION[passuser]);
	$passlama=md5($_POST[passwordlama]);
	$passbaru1=md5($_POST[passwordbaru1]);
	$passbaru2=md5($_POST[passwordbaru2]);
	
// Apabila password diubah
	mysql_query("UPDATE pengguna 	SET 	passwordPengguna = '$passbaru2'
									WHERE 	usernamePengguna	= '$_SESSION[namauser]'");
  header('location:media.php?module=beranda');
}

// Input Gejala
elseif ($module=='gejalaumum' AND $act=='Add'){
	mysql_query("INSERT INTO gejalaumum(
									idGU,
									namaGU,
									ketGU
                                ) 
	                       VALUES(
                                	'$_POST[idGU]',
									'$_POST[namaGU]',
									'$_POST[ketGU]'
								)");
	
	$result = mysql_query("SELECT * FROM gejalaumum"); 
	$get_pages=mysql_num_rows($result);
	$ulang=0;
	$bobot=1;
	$nilai=1;
	$no=0;
	$urut=0;
	
	while ($ulang<$get_pages){
		$ulang++;
		if (isset($_POST['gp'.$ulang])) {
			$no++;
			$gp[$no]= $_POST['gp'.$ulang];
			$bd[$no]= $_POST['bd'.$ulang];
			//echo "$gp[$no]</br>";
			$tampil = mysql_query("	SELECT * FROM diagnosa ORDER BY idDiagnosa DESC LIMIT 1");
			$data=mysql_fetch_array($tampil);
			
			$kd = substr("$data[idDiagnosa]", 2, 4); 
			$kdbaru= $kd + 1;
			$idDiagnosa="GP".sprintf("%04s",$kdbaru);
			mysql_query("INSERT INTO diagnosa(
									idDiagnosa,
									idGU,
									idGangguan,
									bobotDiagnosa
                                ) 
	                       VALUES(
                                	'$idDiagnosa',
									'$_POST[idGU]',
									'$gp[$no]',
									'$bd[$no]'
								)");
			
			
		}
	}
	header('location:media.php?module='.$module);
}

// Update Gejala
elseif ($module=='gejalaumum' AND $act=='Update'){
	mysql_query("DELETE FROM diagnosa WHERE idGU = '$_POST[idGU]'");
	
	mysql_query("UPDATE gejalaumum 	SET namaGU	= '$_POST[namaGU]',
									ketGU		= '$_POST[ketGU]'
								WHERE 	idGU = '$_POST[idGU]'");
		
	$result = mysql_query("SELECT * FROM gangguan"); 
	$get_pages=mysql_num_rows($result);
	$ulang=0;
	$bobot=1;
	$nilai=1;
	$no=0;
	$urut=0;
	while ($ulang<$get_pages){
		$ulang++;
		if (isset($_POST['gp'.$ulang])) {
			$no++;
			$gp[$no]= $_POST['gp'.$ulang];
			$bd[$no]= $_POST['bd'.$ulang];
			//echo "$gp[$no]</br>";
			$tampil = mysql_query("	SELECT * FROM diagnosa ORDER BY idDiagnosa DESC LIMIT 1");
			$data=mysql_fetch_array($tampil);
			
			$kd = substr("$data[idDiagnosa]", 2, 4); 
			$kdbaru= $kd + 1;
			$idDiagnosa="GP".sprintf("%04s",$kdbaru);
			mysql_query("INSERT INTO diagnosa(
									idDiagnosa,
									idGU,
									idGangguan,
									bobotDiagnosa
                                ) 
	                       VALUES(
                                	'$idDiagnosa',
									'$_POST[idGU]',
									'$gp[$no]',
									'$bd[$no]'
								)");
		}
	}
	header('location:media.php?module='.$module);
}


//Hapus Gejala
elseif ($module=='gejalaumum' AND $act=='hapus'){
	IF ('$_GET[id]'<>''){
		mysql_query("DELETE FROM gejalaumum WHERE idGU = '$_GET[id]'");
		mysql_query("DELETE FROM diagnosa WHERE idGU = '$_GET[id]'");
	}
	
	$n = $_POST['jmlbaris'];
	for ($i=1; $i<=$n-1; $i++){
		if (isset($_POST['idGU'.$i])){
			$idGU = $_POST['idGU'.$i]; 
			$query = "DELETE FROM gejala WHERE idGU = '$idGU'";
			mysql_query($query);
			mysql_query("DELETE FROM diagnosa WHERE idGU = '$idGU'");
		}
	}
  header('location:media.php?module='.$module);
}



// Input Gejala Khusus
elseif ($module=='gejalakhusus' AND $act=='Add'){
	mysql_query("INSERT INTO gejalakhusus(
									idGK,
									namaGK,
									ketGK
                                ) 
	                       VALUES(
                                	'$_POST[idGK]',
									'$_POST[namaGK]',
									'$_POST[ketGK]'
								)");
	
	header('location:media.php?module='.$module);
}

// Update Gejala Khusus
elseif ($module=='gejalakhusus' AND $act=='Update'){
	mysql_query("UPDATE gejalakhusus SET	namaGK		= '$_POST[namaGK]',
											ketGK		= '$_POST[ketGK]'
									WHERE idGK		= '$_POST[idGK]'");
	header('location:media.php?module='.$module);
}

//Hapus Gejala Khusus
elseif ($module=='gejalakhusus' AND $act=='hapus'){
	IF ('$_GET[id]'<>''){
		mysql_query("DELETE FROM gejalakhusus WHERE idGK = '$_GET[id]'");
	}
	
	$n = $_POST['jmlbaris'];
	for ($i=1; $i<=$n-1; $i++){
		if (isset($_POST['idGK'.$i])){
			$idGK = $_POST['idGK'.$i]; 
			mysql_query("DELETE FROM gejalakhusus WHERE idGK = '$idDG'");
		}
	}
  header('location:media.php?module='.$module);
}


// Input Gangguan
elseif ($module=='gangguan' AND $act=='Add'){

  mysql_query("INSERT INTO gangguan(
									idGangguan,
									nmGangguan,
									ketGangguan,
									bobotGangguan
                                	) 
	                       	VALUES(
                                	'$_POST[idGangguan]',
									'$_POST[nmGangguan]',
									'$_POST[ketGangguan]',
									'$_POST[bobotGangguan]'
									)");
  
	$result = mysql_query("SELECT * FROM gejalaumum"); 
	$get_pages=mysql_num_rows($result);
	$ulang=0;
	$bobot=1;
	$nilai=1;
	$no=0;
	$urut=0;
	
	while ($ulang<$get_pages){
		$ulang++;
		if (isset($_POST['gp'.$ulang])) {
			$no++;
			$gp[$no]= $_POST['gp'.$ulang];
			$bd[$no]= $_POST['bd'.$ulang];
			$tampil = mysql_query("	SELECT * FROM diagnosa ORDER BY idDiagnosa DESC LIMIT 1");
			$data=mysql_fetch_array($tampil);
			
			$kd = substr("$data[idDiagnosa]", 2, 4); 
			$kdbaru= $kd + 1;
			$idDiagnosa="GP".sprintf("%04s",$kdbaru);
			mysql_query("INSERT INTO diagnosa(
											idDiagnosa,
											idGU,
											idGangguan,
											bobotDiagnosa
											) 
									VALUES(
											'$idDiagnosa',
											'$gp[$no]',
											'$_POST[idGangguan]',
											'$bd[$no]'
										)");		
		}
	}
	
	$result = mysql_query("SELECT * FROM gejalakhusus"); 
	$get_pages=mysql_num_rows($result);
	$ulang=0;
	$bobot=1;
	$nilai=1;
	$no=0;
	$urut=0;
	
	while ($ulang<$get_pages){
		$ulang++;
		if (isset($_POST['dg'.$ulang])) {
			$no++;
			$dg[$no]= $_POST['dg'.$ulang];
			$tampil = mysql_query("	SELECT * FROM inferensi ORDER BY idInferensi DESC LIMIT 1");
			$data=mysql_fetch_array($tampil);
			
			$kd = substr("$data[idInferensi]", 10, 4); 
			$kdbaru= $kd + 1;
			$idInferensi="INFERENSI".sprintf("%04s",$kdbaru);
			mysql_query("INSERT INTO inferensi(
											idInferensi,
											idGK,
											idGangguan
											) 
									VALUES(
											'$idInferensi',
											'$dg[$no]',
											'$_POST[idGangguan]'
										)");		
		}
	}
	
	//mysql_query("DELETE FROM solusi WHERE idGangguan = '$_POST[idGangguan]'");
	$result = mysql_query("SELECT * FROM gangguan"); 
	$get_pages=mysql_num_rows($result);
	$ulang=0;
	$bobot=1;
	$nilai=1;
	$no=0;
	$urut=0;
	
	$idPencegahan= $_POST['idPencegahan'];
	while ($ulang<$get_pages){
		$ulang++;
		if (isset($_POST['idPencegahan'.$ulang])){
			$no++;
			$idPencegahan[$no]= $_POST['idPencegahan'.$ulang];
			//echo "$idPencegahan[$no]</br>";
			$tampil = mysql_query("	SELECT * FROM solusi ORDER BY idSolusi DESC LIMIT 1");
			$data=mysql_fetch_array($tampil);
			
			$kd = substr("$data[idSolusi]", 8, 4); 
			$kdbaru= $kd + 1;
			$idSolusi="SOLUSI".sprintf("%04s",$kdbaru);
			mysql_query("INSERT INTO solusi(
									idSolusi,
									idGangguan,
									idPencegahan
                                ) 
	                       VALUES(
                                	'$idSolusi',
									'$_POST[idGangguan]',
									'$idPencegahan[$no]'
								)");
			
			
		}
	}
	header('location:media.php?module='.$module);
}

// Update Gangguan
elseif ($module=='gangguan' AND $act=='Update'){
	mysql_query("UPDATE gangguan SET 	nmGangguan		= '$_POST[nmGangguan]',
									ketGangguan		= '$_POST[ketGangguan]',
									bobotGangguan	= '$_POST[bobotGangguan]'
							WHERE 	idGangguan   	= '$_POST[idGangguan]'");
	
	
	
	mysql_query("DELETE FROM diagnosa WHERE idGangguan = '$_POST[idGangguan]'");
		
	$result = mysql_query("SELECT * FROM gejalaumum"); 
	$get_pages=mysql_num_rows($result);
	$ulang=0;
	$bobot=1;
	$nilai=1;
	$no=0;
	$urut=0;
	
	while ($ulang<$get_pages){
		$ulang++;
		if (isset($_POST['gp'.$ulang])) {
			$no++;
			$gp[$no]= $_POST['gp'.$ulang];
			$bd[$no]= $_POST['bd'.$ulang];
			$tampil = mysql_query("	SELECT * FROM diagnosa ORDER BY idDiagnosa DESC LIMIT 1");
			$data=mysql_fetch_array($tampil);
			
			$kd = substr("$data[idDiagnosa]", 2, 4); 
			$kdbaru= $kd + 1;
			$idDiagnosa="GP".sprintf("%04s",$kdbaru);
			mysql_query("INSERT INTO diagnosa(
											idDiagnosa,
											idGU,
											idGangguan,
											bobotDiagnosa
											) 
									VALUES(
											'$idDiagnosa',
											'$gp[$no]',
											'$_POST[idGangguan]',
											'$bd[$no]'
										)");		
		}
	}
	
	mysql_query("DELETE FROM inferensi WHERE idGangguan = '$_POST[idGangguan]'");
		
	$result = mysql_query("SELECT * FROM gejalakhusus"); 
	$get_pages=mysql_num_rows($result);
	$ulang=0;
	$bobot=1;
	$nilai=1;
	$no=0;
	$urut=0;
	
	while ($ulang<$get_pages){
		$ulang++;
		if (isset($_POST['dg'.$ulang])) {
			$no++;
			$dg[$no]= $_POST['dg'.$ulang];
			$tampil = mysql_query("	SELECT * FROM inferensi ORDER BY idInferensi DESC LIMIT 1");
			$data=mysql_fetch_array($tampil);
			
			$kd = substr("$data[idInferensi]", 10, 4); 
			$kdbaru= $kd + 1;
			$idInferensi="INFERENSI".sprintf("%04s",$kdbaru);
			mysql_query("INSERT INTO inferensi(
											idInferensi,
											idGK,
											idGangguan
											) 
									VALUES(
											'$idInferensi',
											'$dg[$no]',
											'$_POST[idGangguan]'
										)");		
		}
	}
	
	mysql_query("DELETE FROM solusi WHERE idGangguan = '$_POST[idGangguan]'");
	$result = mysql_query("SELECT * FROM gangguan"); 
	$get_pages=mysql_num_rows($result);
	$ulang=0;
	$bobot=1;
	$nilai=1;
	$no=0;
	$urut=0;
	
	$idPencegahan= $_POST['idPencegahan'];
	while ($ulang<$get_pages){
		$ulang++;
		if (isset($_POST['idPencegahan'.$ulang])){
			$no++;
			$idPencegahan[$no]= $_POST['idPencegahan'.$ulang];
			//echo "$idPencegahan[$no]</br>";
			$tampil = mysql_query("	SELECT * FROM solusi ORDER BY idSolusi DESC LIMIT 1");
			$data=mysql_fetch_array($tampil);
			
			$kd = substr("$data[idSolusi]", 8, 4); 
			$kdbaru= $kd + 1;
			$idSolusi="SOLUSI".sprintf("%04s",$kdbaru);
			mysql_query("INSERT INTO solusi(
									idSolusi,
									idGangguan,
									idPencegahan
                                ) 
	                       VALUES(
                                	'$idSolusi',
									'$_POST[idGangguan]',
									'$idPencegahan[$no]'
								)");
			
			
		}
	}
	header('location:media.php?module='.$module);
}

//Hapus Gangguan
elseif ($module=='gangguan' AND $act=='hapus'){
	IF ('$_GET[id]'<>''){
		mysql_query("DELETE FROM gangguan WHERE idGangguan = '$_GET[id]'");
		mysql_query("DELETE FROM diagnosa WHERE idGangguan = '$_GET[id]'");
		mysql_query("DELETE FROM solusi WHERE idGangguan = '$_GET[id]'");
		mysql_query("DELETE FROM inferensi WHERE idGangguan = '$_GET[id]'");
	}
	
	$n = $_POST['jmlbaris'];
	for ($i=1; $i<=$n-1; $i++){
		if (isset($_POST['idGangguan'.$i])){
			$idGangguan = $_POST['idGangguan'.$i]; 
			$query = "DELETE FROM gangguan WHERE idGangguan = '$idGangguan'";
			mysql_query($query);
			mysql_query("DELETE FROM diagnosa WHERE idGangguan = '$idGangguan'");
		}
	}
  header('location:media.php?module='.$module);
}

//Hapus Solusi yang berkaitan
elseif ($module=='gangguan' AND $act=='hapussolusi'){
	mysql_query("DELETE FROM solusi WHERE idGangguan = '$_GET[id]'");
}


//Hapus Gejala yang berkaitan
elseif ($module=='gangguan' AND $act=='hapusgejala'){
	mysql_query("DELETE FROM diagnosa WHERE idGangguan = '$_GET[id]'");
}


//Hapus Gejala Khusus/Inferensi yang berkaitan
elseif ($module=='gangguan' AND $act=='hapusinferensi'){
	mysql_query("DELETE FROM inferensi WHERE idGangguan = '$_GET[id]'");
}


// Input Pencegahan
elseif ($module=='pencegahan' AND $act=='Add'){
	mysql_query("INSERT INTO pencegahan(
									idPencegahan,
									nmPencegahan
                                    ) 
					            VALUES(
									'$_POST[idPencegahan]',
									'$_POST[nmPencegahan]'
									)
									");
  header('location:media.php?module='.$module);
}

// Update Pencegahan
elseif ($module=='pencegahan' AND $act=='Update'){
	mysql_query("UPDATE pencegahan SET nmPencegahan		= '$_POST[nmPencegahan]'
                               WHERE idPencegahan	= '$_POST[idPencegahan]'");
  header('location:media.php?module='.$module);
}


//Hapus Pencegahan
elseif ($module=='pencegahan' AND $act=='hapus'){
	IF ('$_GET[id]'<>''){
		mysql_query("DELETE FROM pencegahan WHERE idPencegahan = '$_GET[id]'");
	}
	
	$n = $_POST['jmlbaris'];
	for ($i=1; $i<=$n-1; $i++){
		if (isset($_POST['idPencegahan'.$i])){
			$idPencegahan = $_POST['idPencegahan'.$i]; 
			$query = "DELETE FROM pencegahan WHERE idPencegahan = '$idPencegahan'";
			mysql_query($query);
		}
	}
  header('location:media.php?module='.$module);
}


// Input Rule
elseif ($module=='rule' AND $act=='Add'){
	mysql_query("INSERT INTO rule(
									idGK,
									yaRule,
									tidakRule
                                ) 
	                       VALUES(
                                	'$_POST[idGK]',
									'$_POST[yaRule]',
									'$_POST[tidakRule]'
								)");
	
	header('location:media.php?module='.$module);
}

// Update Rule
elseif ($module=='rule' AND $act=='Update'){
	mysql_query("UPDATE rule SET	yaRule		= '$_POST[yaRule]',
									tidakRule	= '$_POST[tidakRule]'
									WHERE idGK	= '$_POST[idGK]'");
	header('location:media.php?module='.$module);
}

//Hapus Rule
elseif ($module=='rule' AND $act=='hapus'){
	IF ('$_GET[id]'<>''){
		mysql_query("DELETE FROM rule WHERE idGK = '$_GET[id]'");
	}
	
	$n = $_POST['jmlbaris'];
	for ($i=1; $i<=$n-1; $i++){
		if (isset($_POST['idGK'.$i])){
			$idGK = $_POST['idGK'.$i]; 
			mysql_query("DELETE FROM rule WHERE idGK = '$idGK'");
		}
	}
  header('location:media.php?module='.$module);
}

?>
