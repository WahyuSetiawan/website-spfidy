	
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
		GEJALA UMUM
	</div>
	
	<form method='post' action=./aksi.php?module=gejalaumum&act=hapus >
	<div id='tablewrapper'>
		<div class=buttons align=left>
			<button type=button class=positive onclick=location.href='?module=gejalaumum&act=Add'><img src=icon/add.png>ADD NEW</button>
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
					<th width=50 class='nosort'><h3></h3><input type='checkbox' id='ceksemua'></th>
                    <th width=5><h3>No</h3></th>
					<th><h3>Nama Gejala</h3></th>
      				<th><h3>Keterangan</h3></th>
                </tr>
            </thead>
            <tbody>";
				$tampil = mysql_query("	SELECT * FROM gejalaumum 
										ORDER BY idGU DESC");
				$no=$posisi+1;
				while ($r=mysql_fetch_array($tampil)){
				echo"<tr>
						<td>
							<input type='checkbox' name='idGU$no' value='$r[idGU]'>
							<a href=?module=gejalaumum&act=Update&id=$r[idGU]><img src='icon/application_edit.png' width=16 height=16></a>
							<a href=./aksi.php?module=gejalaumum&act=hapus&id=$r[idGU] " . "onClick = \"return confirm('Yakinkah anda akan menghapus $r[namaGU]?')\"" ."><img src='icon/delete.png' width=16 height=16></a>
						</td>
						<td align=center>$no.</td>
						<td><a href=?module=gejalaumum&act=Update&id=$r[idGU]>$r[namaGU]</a></td>
						<td><a href=?module=gejalaumum&act=Update&id=$r[idGU]>$r[ketGU]</a></td>
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
		$tampil = mysql_query("	SELECT * FROM gejalaumum ORDER BY idGU DESC LIMIT 1");
		$data=mysql_fetch_array($tampil);

		$kd = substr("$data[idGU]", 7, 4); 
		$kdbaru= $kd + 1;
		$idGU="GEJALA".sprintf("%04s",$kdbaru);
	}elseif ($_GET[act]=="Update"){
		$edit = mysql_query("SELECT * FROM gejalaumum WHERE idGU='$_GET[id]'");
		$r    = mysql_fetch_array($edit);
		$idGU=$r[idGU];
	}
	?>
		<script type="text/javascript" src="../js/jquery-1.4.js"></script>
		<script type="text/javascript" src="../js/jquery.ketchup.js"></script>
		<script type="text/javascript" src="../js/jquery.ketchup.messages.js"></script>
		<script type="text/javascript" src="../js/jquery.ketchup.validations.basic.js"></script>
	<?php	
	
	
    echo "	<form id='form' method=POST action='./aksi.php?module=gejalaumum&act=$act' enctype='multipart/form-data'>
				<div id='judul'>
					$judul
					<input type=hidden id='idGU' name='idGU' value='$idGU' size=15 maxlength=255 class='validate(required)'>
				</div>
				<div style='width:600px;'>
					<fieldset>
						<div>
							<label>Nama Gejala :</label>
							<input type='text' id='namaGU' name='namaGU' value='$r[namaGU]' size=50 maxlength=255 class='validate(required)'>
						</div>
						<div>
							<label>Keterangan :</label>
							<textarea id='ketGU' name='ketGU' cols='40' rows='3' class='validate(required)'>$r[ketGU]</textarea>
						</div>
					</fieldset>
					<fieldset>
						<h2>Gangguan yang berkaitan:</h2>
						<div>
							<table >";
							if($act=='Add'){		
								$tampil = mysql_query("	SELECT * FROM Gangguan
											ORDER BY nmGangguan ASC LIMIT 60");
											
								$no = 1;
				
								while ($r=mysql_fetch_array($tampil)){
									echo"
										<tr>
											<td id='bodi' align=center valign=top>$no</td>
											<td id='bodi'>
												<input type='checkbox' value='$r[idGangguan]' name='gp$no'/>
												<input type='text' value='$cekGejala[bobotDiagnosa]' name='bd$no' size=5/>$r[nmGangguan]
											</td>";
								$no++;
								}
							}elseif($act=='Update'){
								$tampilPenyakit = mysql_query("	SELECT * FROM gangguan
											ORDER BY nmGangguan ASC");
											
				
								$no = 1;
				
								while ($rPenyakit=mysql_fetch_array($tampilPenyakit)){
									$cek = mysql_query("SELECT * FROM diagnosa WHERE diagnosa.idGU='$_GET[id]' AND diagnosa.idGangguan='$rPenyakit[idGangguan]' ");
									$cekGejala=mysql_fetch_array($cek);
									//echo "Data $cekGejala[idGU]";
									if ($cekGejala[idGangguan]<>null){
								echo"	<tr>
											<td id='bodi' align=center valign=top>$no</td>
											<td id='bodi'>
												<input type='checkbox' checked value='$rPenyakit[idGangguan]' name='gp$no'/>
												<input type='text' value='$cekGejala[bobotDiagnosa]' name='bd$no' size=5/>$rPenyakit[nmGangguan]
											</td>
										</tr>";
									}else{
								echo"	<tr>
											<td id='bodi' align=center valign=top>$no</td>
											<td id='bodi'>
												<input type='checkbox' value='$rPenyakit[idGangguan]' name='gp$no'/>
												<input type='text' value='$cekGejala[bobotDiagnosa]' name='bd$no' size=5/>$rPenyakit[nmGangguan]
											</td>
										</tr>";
									}
								$no++;
								}
							}
						echo"	</table>
						</div>
					</fieldset>
					<div class=buttons align=center>
						<button type=submit class=positive><img src=icon/drive.png>SAVE</button>
						<button type=button class=positive onclick=self.history.back()><img src=icon/cancel.png>CANCEL</button>
					</div>
				</div>
			</form>";
	}
?>