
<link rel="stylesheet" href="style.css" />
<script type="text/javascript" src="../js/jquery-1.4.js"></script>
    <script type="text/javascript">
		$(document).ready(function() {
			$('#ceksemua').click(function () {
		        $(this).parents('table:eq(0)').find(':checkbox').attr('checked', this.checked);
			});
			$(':input:not([type="submit"])').each(function() {
				$(this).focus(function() {
					$(this).parent().addClass('hilite');
				}).blur(function() {
					$(this).parent().removeClass('hilite');});
			});
			$("#nmPengguna").focus();
		});  
    </script>
<?php
	if ($_GET[act]==""){
		$module=$_GET[module];
		$judul = strtoupper("$module Management");
		
echo"<div id='judul'>
		$judul
	</div>
	
	<form method='post' action=./aksi.php?module=gangguan&act=hapus >
	<div id='tablewrapper'>
		<div class=buttons align=left>
			<button type=button class=positive onclick=location.href='?module=gangguan&act=Add'><img src=icon/add.png>ADD NEW</button>
			<button type=submit class=positive><img src=icon/drive.png>DELETE</button>
		</div>
		<div id='tableheader'>
			<div class='search'>
                <select id='columns' onchange=sorter.search('query')></select>
                <input type='text' id='query' onkeyup=sorter.search('query') />
            </div>
            <span class='details'>
				<div>Records <span id='startrecord'></span>-<span id='endrecord'></span> of <span id='totalrecords'></span></div>
        	</span>
        </div>
        <table cellpadding='0' cellspacing='0' border='0' id='table' class='tinytable'>
            <thead>
                <tr>
                    <th width=5><h3>No</h3></th>
					<th width=50 class='nosort'><h3></h3><input type='checkbox' id='ceksemua'></th>
					<th><h3>Nama Gangguan</h3></th>
      				<th><h3>Bobot</h3></th>
      				<th><h3>Gejala</h3></th>
      				<th><h3>Inferensi</h3></th>
      				<th><h3>Pencegahan</h3></th>
                </tr>
            </thead>
            <tbody>";
				$tampil = mysql_query("	SELECT * FROM gangguan
								ORDER BY idGangguan DESC");
				$no=$posisi+1;
				while ($r=mysql_fetch_array($tampil)){
					$jmlGejala=mysql_num_rows(mysql_query("	SELECT * FROM diagnosa WHERE idGangguan='$r[idGangguan]'"));
					$jmlInferensi=mysql_num_rows(mysql_query("	SELECT * FROM inferensi WHERE idGangguan='$r[idGangguan]'"));
					$jmlPencegahan=mysql_num_rows(mysql_query("	SELECT * FROM solusi WHERE idGangguan='$r[idGangguan]'"));
				echo"<tr>
						<td align=center>$no.</td>
						<td>
							<input type='checkbox' name='idGangguan$no' value='$r[idGangguan]'>
							<a href=?module=gangguan&act=Update&id=$r[idGangguan]><img src='icon/application_edit.png' width=16 height=16></a>
							<a href=./aksi.php?module=gangguan&act=hapus&id=$r[idGangguan] " . "onClick = \"return confirm('Yakinkah anda akan menghapus $r[nmGangguan]?')\"" ."><img src='icon/delete.png' width=16 height=16></a>
						</td>
						<td><a href=?module=gangguan&act=Update&id=$r[idGangguan]>$r[nmGangguan]</a></td>
						<td><a href=?module=gangguan&act=Update&id=$r[idGangguan]>$r[bobotGangguan]</a></td>
						<td><a href=?module=gangguan&act=Update&id=$r[idGangguan]>$jmlGejala Gejala</a></td>
						<td><a href=?module=gangguan&act=Update&id=$r[idGangguan]>$jmlInferensi Inferensi</a></td>
						<td><a href=?module=gangguan&act=Update&id=$r[idGangguan]>$jmlPencegahan Pencegahan</a></td>
					</tr>";
					$no++;
				}
				
        echo"</tbody>
        </table>
		<input type='hidden' name='jmlbaris' value='$no' />
        <div id='tablefooter'>
          <div id='tablenav'>
            	<div>
                    <img src='images/first.gif' width=16 height=16 alt='First Page' onclick='sorter.move(-1,true)' />
                    <img src='images/previous.gif' width=16 height=16 alt='First Page' onclick='sorter.move(-1)' />
                    <img src='images/next.gif' width=16 height=16 alt='First Page' onclick='sorter.move(1)' />
                    <img src='images/last.gif' width=16 height=16 alt='Last Page' onclick='sorter.move(1,true)' />
                </div>
                <div>
                	<select id='pagedropdown'></select>
				</div>
                <div>
                	<a href='javascript:sorter.showall()'>view all</a>
                </div>
            </div>
			<div id='tablelocation'>
            	<div>
                    <select onchange='sorter.size(this.value)'>
                    <option value=5>5</option>
                        <option value=10 selected=selected>10</option>
                        <option value=20>20</option>
                        <option value=50>50</option>
                        <option value=100>100</option>
                    </select>
                    <span>Data Per Halaman</span>
                </div>
                <div class='page'>Halaman <span id='currentpage'></span> dari <span id='totalpages'></span></div>
            </div>
        </div></br>
		</form>";
?>
	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript">
	var sorter = new TINY.table.sorter('sorter','table',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:true,
		size:10,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		pageddid:'pagedropdown',
		navid:'tablenav',
		sortcolumn:1,
		sortdir:1,
		//sum:[8],
		//avg:[6,7,8,9],
		columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
		init:true
	});
  </script>
<?php
	}ELSEIF ($_GET[act]<>""){
		$module=$_GET[module];
		$act=$_GET[act];
		$judul = strtoupper("$act $module");
		
		if ($_GET[act]=="Add"){
			$tampil = mysql_query("	SELECT * FROM gangguan ORDER BY idGangguan DESC LIMIT 1");
			$data=mysql_fetch_array($tampil);

			$kd = substr("$data[idGangguan]", 9, 4); 
			$kdbaru= $kd + 1;
			$idGangguan="GANGGUAN".sprintf("%04s",$kdbaru);
		}elseif ($_GET[act]=="Update"){
			$edit = mysql_query("SELECT * FROM gangguan WHERE idGangguan='$_GET[id]'");
			$r    = mysql_fetch_array($edit);
			$idGangguan=$r[idGangguan];
		}
		
	?>
		<script type="text/javascript" src="../js/jquery-1.4.js"></script>
		<script type="text/javascript" src="../js/jquery.ketchup.js"></script>
		<script type="text/javascript" src="../js/jquery.ketchup.messages.js"></script>
		<script type="text/javascript" src="../js/jquery.ketchup.validations.basic.js"></script>
	<?php	
    echo"<form id='form' method=POST action='./aksi.php?module=gangguan&act=$act' enctype='multipart/form-data'>
				<div id='judul'>
					$judul
					<input type=hidden id='idGangguan' name='idGangguan' value='$idGangguan' size=15 maxlength=255 class='validate(required)'>
				</div>
				<div style='width:600px;'>
					<fieldset>
						<div>
							<h2>Data Gangguan</h2>
						</div>
						<div>
							<label>Nama Gangguan :</label>
							<input type='text' id='nmGangguan' name='nmGangguan' value='$r[nmGangguan]' size=50 maxlength=255 class='validate(required)'>
						</div>
						<div>
							<label>Keterangan :</label>
							<textarea id='ketGangguan' name='ketGangguan' cols='40' rows='3' class='validate(required)'>$r[ketGangguan]</textarea>
						</div>
						<div>
							<label>Bobot :</label>
							<input type='text' id='bobotGangguan' name='bobotGangguan' value='$r[bobotGangguan]' size=50 maxlength=255 class='validate(required)'>
						</div>
					</fieldset>";
						
						$gejala=mysql_query("SELECT * FROM diagnosa WHERE idGangguan='$_GET[id]'");
						$jmlGejalasama=	mysql_num_rows($gejala);			
				echo"<fieldset>
						<div>
							<h2>Gejala Umum yang berkaitan ($jmlGejalasama): 
								<a href=./aksi.php?module=gangguan&act=hapusgejala&id=$r[idGangguan] " . "onClick = \"return confirm('Yakinkah anda akan menghapus data gejala pada gangguan $r[nmGangguan]?')\"" ."><img src='../images/delete.gif' width=20 height=20></a>
							</h2>
						</div>
						<div>
							<table >";
							if($act=='Add'){		
								$tampil = mysql_query("	SELECT * FROM gejalaumum
											ORDER BY namaGU ASC LIMIT 60");
											
				
								$no = 1;
				
								while ($r=mysql_fetch_array($tampil)){
									echo"
										<tr>
											<td id='bodi' align=center valign=top>$no</td>
											<td id='bodi'>
												<input type='checkbox' value='$r[idGU]' name='gp$no'/>
												<input type='text' value='$cekGejala[bobotDiagnosa]' name='bd$no' size=5/>$r[nmGejala]
											</td>";
								$no++;
								}
							}elseif($act=='Update'){
								$tampilPenyakit = mysql_query("	SELECT * FROM gejalaumum
											ORDER BY namaGU ASC");
											
				
								$no = 1;
				
								while ($rPenyakit=mysql_fetch_array($tampilPenyakit)){
									$cek = mysql_query("SELECT * FROM diagnosa WHERE diagnosa.idGangguan='$_GET[id]' AND diagnosa.idGU='$rPenyakit[idGU]' ");
									$cekGejala=mysql_fetch_array($cek);
									//echo "Data $cekGejala[idGU]";
									if ($cekGejala[idGU]<>null){
								echo"	<tr>
											<td id='bodi' align=center valign=top>$no</td>
											<td id='bodi'>
												<input type='checkbox' checked value='$rPenyakit[idGU]' name='gp$no'/>
												<input type='text' value='$cekGejala[bobotDiagnosa]' name='bd$no' size=5/>$rPenyakit[nmGejala]
											</td>
										</tr>";
									}else{
								echo"	<tr>
											<td id='bodi' align=center valign=top>$no</td>
											<td id='bodi'>
												<input type='checkbox' value='$rPenyakit[idGU]' name='gp$no'/>
												<input type='text' value='$cekGejala[bobotDiagnosa]' name='bd$no' size=5/>$rPenyakit[nmGejala]
											</td>
										</tr>";
									}
								$no++;
								}
							}
						echo"	</table>
						</div>
					</fieldset>";
						$detailgejala=mysql_query("SELECT * FROM inferensi WHERE idGangguan='$_GET[id]'");
						$jmlDetailGejalasama=mysql_num_rows($detailgejala);							
				echo"<fieldset>
						<div>
							<h2>Gejala Khusus yang berkaitan ($jmlDetailGejalasama): 
								<a href=./aksi.php?module=gangguan&act=hapusinferensi&id=$r[idGangguan] " . "onClick = \"return confirm('Yakinkah anda akan menghapus data Gejala Khusus pada gangguan $r[nmGangguan]?')\"" ."><img src='../images/delete.gif' width=20 height=20></a>
							</h2>
						</div>
						<div>";
							$tampilGejala = mysql_query("SELECT * FROM gejalakhusus
														ORDER BY idGK ASC");
									
							$no = 1;
							while ($rDetailGejala=mysql_fetch_array($tampilGejala)){
								$cek = mysql_query("SELECT * FROM inferensi 
													WHERE inferensi.idGK='$rDetailGejala[idGK]' AND inferensi.idGangguan='$r[idGangguan]' ");
								$cekGejala=mysql_fetch_array($cek);
								if ($cekGejala[idGK]<>null){
							echo"<div>
									$no. 
									<input type='checkbox' value='$rDetailGejala[idGK]' name='dg$no' checked />$rDetailGejala[namaGK]
								</div>";
								}else{
							echo"<div>
									$no.
									<input type='checkbox' value='$rDetailGejala[idGK]' name='dg$no'/>  $rDetailGejala[namaGK]
								</div>";
								}
							$no++;
							}
						echo"</div>
					</fieldset>";
						$detailsolusi=mysql_query("SELECT * FROM solusi WHERE idGangguan='$_GET[id]'");
						$jmlSolusi=mysql_num_rows($detailsolusi);
				echo"<fieldset>
						<div>
							<h2>
								Pencegahan yang berkaitan $jmlSolusi:
								<a href=./aksi.php?module=gangguan&act=hapussolusi&id=$r[idGangguan] " . "onClick = \"return confirm('Yakinkah anda akan menghapus data solusi pada gangguan $r[nmGangguan]?')\"" ."><img src='../images/delete.gif' width=20 height=20></a>
							</h2>
						</div>
						<div>";
							$tampilPencegahan = mysql_query("	SELECT * FROM pencegahan
										ORDER BY nmPencegahan ASC");
							$no = 1;
							while ($rPencegahan=mysql_fetch_array($tampilPencegahan)){
								$cek2 = mysql_query("SELECT * FROM solusi 
													WHERE solusi.idPencegahan='$rPencegahan[idPencegahan]' AND solusi.idGangguan='$r[idGangguan]' ");
								$cekPencegahan=mysql_fetch_array($cek2);
								if ($cekPencegahan[idGangguan]<>null){
								echo"<div>
										$no
										<input type='checkbox' value='$rPencegahan[idPencegahan]' name='idPencegahan$no' checked /> $rPencegahan[nmPencegahan]
									</div>";
								}else{
								echo"<div>
										$no
										<input type='checkbox' value='$rPencegahan[idPencegahan]' name='idPencegahan$no'/> $rPencegahan[nmPencegahan]
									</div>";
								}
								$no++;
							}
					echo"</div>	
					</fieldset>
					<div class=buttons align=center>
						<button type=submit class=positive><img src=icon/drive.png>SAVE</button>
						<button type=button class=positive onclick=self.history.back()><img src=icon/cancel.png>CANCEL</button>
					</div>
				</div>
      		</form>";
	}
?>