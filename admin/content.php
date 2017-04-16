<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";

// Bagian Home
if ($_GET[module]=='home'){
 echo "	<form>
			<div>Selamat Datang <blink><b>$_SESSION[namauser]</b></blink>...</div>
			<div>Anda Login sebagai <blink><b>$_SESSION[leveluser]</b></blink>, silahkan klik menu pilihan yang berada 
          	di atas untuk mengelola content website. </div>
          	<div>&nbsp;</div>
			<div>&nbsp;</div>
			<div>&nbsp;</div>
          	<div align=right>Login Hari ini: ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo "	</div>
		</form>";
}

// Bagian Gangguan
elseif ($_GET[module]=='gangguan'){
  include "modul/mod_gangguan.php";
}

// Bagian Inferensi
elseif ($_GET[module]=='rule'){
  include "modul/mod_rule.php";
}

// Bagian Pengguna
elseif ($_GET[module]=='pengguna'){
  include "modul/mod_pengguna.php";
}

// Bagian Gejala
elseif ($_GET[module]=='gejalaumum'){
  include "modul/mod_gejalaumum.php";
}

// Bagian Gejala Penyakit
elseif ($_GET[module]=='gp'){
  include "modul/mod_gejalapenyakit.php";
}

// Bagian Diagnosa
elseif ($_GET[module]=='diagnosadini'){
  include "modul/mod_diagnosadini.php";
}
// Bagian Pecegahan
elseif ($_GET[module]=='pencegahan'){
  include "modul/mod_pencegahan.php";
}
// Bagian Ubah Password
elseif ($_GET[module]=='ubahpassword'){
  include "modul/mod_ubahpassword.php";
}
// Bagian Detail Gejala
elseif ($_GET[module]=='gejalakhusus'){
  include "modul/mod_gejalakhusus.php";
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA</b></p>";
}
?>
