//fungsi untuk autoNumber
function newCode(){
	include "../config/koneksi.php";
	$query = mysql_query("select count from divisi");
	$nomor = mysql_fetch_array($query);
	$nomor2 = $nomor[0] + 1;
	$countNO = "D0".str_pad($nomor2, 4, 0, STR_PAD_LEFT);
	return $countNO;
}

//fungsi untuk update count
function newCount(){
	$tblCount = mysql_query("select count from divisi");
	$hasil = mysql_fetch_array($tblCount);
	$nmrCount = $hasil[0] + 1;
	return $nmrCount;
}

//penggunaan :
//<input name="noInv" type="hidden" id="noInv" value="<?=newCode()?>"/>