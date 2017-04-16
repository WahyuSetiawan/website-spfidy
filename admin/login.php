<?php
include "../config/koneksi.php";
$pass = md5($_POST[passwordPengguna]);
$usernamePengguna=$_POST[usernamePengguna];
//echo"$usernamePengguna $pass";

$login  = mysql_query("SELECT * FROM pengguna WHERE usernamePengguna='$_POST[usernamePengguna]' AND passwordPengguna='$pass'");
$ketemu = mysql_num_rows($login);
$r      = mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  session_register("iduser");
  session_register("namauser");
  session_register("passuser");
  session_register("leveluser");

  $_SESSION[iduser]   = $r[idPengguna];
  $_SESSION[namauser] = $r[usernamePengguna];
  $_SESSION[passuser] = $r[passwordPengguna];
  $_SESSION[leveluser]= $r[levelPengguna];
  header("location:../admin/media.php?module=home");
}
else{
  echo "<script>alert('Username dan Password anda salah!!!'); document.location='../media.php?module=home'</script>";
	exit;
}
?>
