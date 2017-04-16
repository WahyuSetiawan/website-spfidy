<?php
function combotgl($awal, $akhir, $var, $default){
echo "<select name=$var>";
echo "<option value=0 selected>$default</option>";
for ($i=$awal; $i<=$akhir; $i++){
  echo "<option value=$i>$i</option>";
}
echo "</select> ";
}

function combobln($awal, $akhir, $var, $default){
include "../config/library.php";
echo "<select name=$var>";
echo "<option value=0 selected>$default</option>";
for ($bln=$awal; $bln<=$akhir; $bln++){
        echo "<option value=$bln>$nama_bln[$bln]</option>";
}
echo "</select> ";
}

function combotgl2($awal, $akhir, $var, $terpilih){
echo "<select name=$var>";
for ($i=$awal; $i<=$akhir; $i++){
if ($i==$terpilih)
  echo "<option value=$i selected>$i</option>";
else
  echo "<option value=$i>$i</option>";
}
echo "</select> ";
}

function combobln2($awal, $akhir, $var, $terpilih){
include "../config/library.php";
echo "<select name=$var>";
for ($bln=$awal; $bln<=$akhir; $bln++){
      if ($bln==$terpilih)
         echo "<option value=$bln selected>$nama_bln[$bln]</option>";
      else
        echo "<option value=$bln>$nama_bln[$bln]</option>";
}
echo "</select> ";
}
function comboDVS($var){
include "../config/koneksi.php";	
	echo "<select name=$var>";
						echo"<option value=0 selected>- Pilih Gudang -</option>";

							
							
							$sql=mysql_query("select * from gudang");
							while ($data=mysql_fetch_array($sql)){
						echo "<option value=$data[kodeGDG]>$data[namaGDG]</option>";
							}
							

				echo"	</select>";
}
?>
