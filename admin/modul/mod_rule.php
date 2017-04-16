	
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
		RULE
	</div>
	
	<form method='post' action=./aksi.php?module=rule&act=hapus >
	<div id='tablewrapper'>
		<div class=buttons align=left>
			<button type=button class=positive onclick=location.href='?module=rule&act=Add'><img src=icon/add.png>ADD NEW</button>
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
      				<th><h3>Ya Gejala</h3></th>
      				<th><h3>Tidak Gejala</h3></th>
                </tr>
            </thead>
            <tbody>";
				$tampil = mysql_query("	SELECT * FROM rule 
										ORDER BY idGK DESC");
				$no=$posisi+1;
				while ($r=mysql_fetch_array($tampil)){
				echo"<tr>
						<td>
							<input type='checkbox' name='idGK$no' value='$r[idGK]'>
							<a href=?module=rule&act=Update&id=$r[idGK]><img src='icon/application_edit.png' width=16 height=16></a>
							<a href=./aksi.php?module=rule&act=hapus&id=$r[idGK] " . "onClick = \"return confirm('Yakinkah anda akan menghapus $r[nmGejala]?')\"" ."><img src='icon/delete.png' width=16 height=16></a>
						</td>
						<td align=center>$no.</td>
						<td><a href=?module=rule&act=Update&id=$r[idGK]>$r[idGK]</a></td>
						<td><a href=?module=rule&act=Update&id=$r[idGK]>$r[yaRule]</a></td>
						<td><a href=?module=rule&act=Update&id=$r[idGK]>$r[tidakRule]</a></td>
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
	$judul = strtoupper("$act rule");
	
	if ($_GET[act]=="Add"){
		$tampil = mysql_query("	SELECT * FROM rule ORDER BY idGK DESC LIMIT 1");
		$data=mysql_fetch_array($tampil);

		$kd = substr("$data[idGK]", 7, 4); 
		$kdbaru= $kd + 1;
		$idGK="GEJALA".sprintf("%04s",$kdbaru);
	}elseif ($_GET[act]=="Update"){
		$edit = mysql_query("SELECT * FROM rule WHERE idGK='$_GET[id]'");
		$r    = mysql_fetch_array($edit);
		$idGK=$r[idGK];
	}
	?>
		<script type="text/javascript" src="../js/jquery-1.4.js"></script>
		<script type="text/javascript" src="../js/jquery.ketchup.js"></script>
		<script type="text/javascript" src="../js/jquery.ketchup.messages.js"></script>
		<script type="text/javascript" src="../js/jquery.ketchup.validations.basic.js"></script>
	<?php	
	
	
    echo "	<form id='form' method=POST action='./aksi.php?module=rule&act=$act' enctype='multipart/form-data'>
				<div id='judul'>
					$judul
					<input type=hidden id='idGK' name='idGK' value='$idGK' size=15 maxlength=255 class='validate(required)'>
				</div>
				<div style='width:600px;'>
					<fieldset>
						<div>";
								if ($act=='Add'){
							echo"<label><b>Root Gejala :</b></label>
									<select name='idGK'>";
									$query = "SELECT * FROM gejalakhusus ORDER BY namaGK ASC";
									$hasil = mysql_query($query);
									while ($data = mysql_fetch_array($hasil)){
										echo "<option value=$data[idGK]>$data[namaGK]</option>";
									}
							echo"</select>";
								}elseif($act=='Update'){
									$grup1=mysql_query("Select * from gejalakhusus WHERE idGK='$r[idGK]'");
									$data1= mysql_fetch_array($grup1);
								echo"<label>Gejala :</label>
									$data1[namaGK]</br>";
								}
					echo"</div>
						<div>
							<label><b>Ya Gejala :</b></label>
							<select name='yaRule'>";
								if ($act=='Add'){
									$query = "SELECT * FROM gejalakhusus ORDER BY namaGK ASC";
									$hasil = mysql_query($query);
									while ($data = mysql_fetch_array($hasil)){
										echo "<option value=$data[idGK]>$data[namaGK]</option>";
									}
								}elseif($act=='Update'){
									$grup1=mysql_query("Select * from gejalakhusus WHERE idGK='$r[idGK]'");
									$data1= mysql_fetch_array($grup1);
									
									$grup2=mysql_query("Select * from gejalakhusus  
															ORDER BY namaGK ASC");
									while ($data2= mysql_fetch_array($grup2)){
										IF ($data1[idGK]==$data2[idGK]){
									echo"	<option value=$data2[idGK] selected>$data2[namaGK]</option>";
										}ELSE{
									echo"	<option value=$data2[idGK]>$data2[namaGK]</option>";
										}
									}	
								}
						echo"</select>
						</div>
						<div>
							<label><b>Tidak Gejala :</b></label>
							<select name='tidakRule'>";
								if ($act=='Add'){
									$query = "SELECT * FROM gejalakhusus ORDER BY namaGK ASC";
									$hasil = mysql_query($query);
									while ($data = mysql_fetch_array($hasil)){
										echo "<option value=$data[idGK]>$data[namaGK]</option>";
									}
								}elseif($act=='Update'){
									$grup1=mysql_query("Select * from gejalakhusus WHERE idGK='$r[idGK]'");
									$data1= mysql_fetch_array($grup1);
									
									$grup2=mysql_query("Select * from gejalakhusus  
															ORDER BY namaGK ASC");
									while ($data2= mysql_fetch_array($grup2)){
										IF ($data1[idGK]==$data2[idGK]){
									echo"	<option value=$data2[idGK] selected>$data2[namaGK]</option>";
										}ELSE{
									echo"	<option value=$data2[idGK]>$data2[namaGK]</option>";
										}
									}	
								}
						echo"</select>
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