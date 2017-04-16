	
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
	
	<form method='post' action=./aksi.php?module=pengguna&act=hapus >
	<div id='tablewrapper'>
		<div class=buttons align=left>
			<button type=button class=positive onclick=location.href='?module=pengguna&act=Add'><img src=icon/add.png>ADD NEW</button>
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
                    <th><h3>No</h3></th>
					<th width=50 class='nosort'><h3></h3><input type='checkbox' id='ceksemua'></th>
					<th><h3>Name</h3></th>
					<th><h3>Username</h3></th>
					<th><h3>Level</h3></th>
					<th><h3>Male</h3></th>
					<th><h3>Telp</h3></th>
					<th><h3>Email</h3></th>
                </tr>
            </thead>
            <tbody>";
				$tampil = mysql_query("	SELECT * FROM pengguna
										ORDER BY idPengguna DESC");
				$no=$posisi+1;
				while ($r=mysql_fetch_array($tampil)){
				echo"<tr>
						<td align=center>$no.</td>
						<td>
							<input type='checkbox' name='idPengguna$no' value='$r[idPengguna]'>
							<a href=?module=pengguna&act=Update&id=$r[idPengguna]><img src='icon/application_edit.png' width=16 height=16></a>
							<a href=./aksi.php?module=pengguna&act=hapus&id=$r[idPengguna] " . "onClick = \"return confirm('Yakinkah anda akan menghapus $r[nmPengguna]?')\"" ."><img src='icon/delete.png' width=16 height=16></a>
						</td>
						<td><a href=?module=pengguna&act=Update&id=$r[idPengguna]>$r[nmPengguna]</a></td>
						<td><a href=?module=pengguna&act=Update&id=$r[idPengguna]>$r[usernamePengguna]</a></td>
						<td><a href=?module=pengguna&act=Update&id=$r[idPengguna]>$r[levelPengguna]</a></td>
						<td><a href=?module=pengguna&act=Update&id=$r[idPengguna]>$r[jkPengguna]</a></td>
						<td><a href=?module=pengguna&act=Update&id=$r[idPengguna]>$r[nohpPengguna]</a></td>
						<td><a href=?module=pengguna&act=Update&id=$r[idPengguna]>$r[emailPengguna]</a></td>
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
			$tampil = mysql_query("	SELECT * FROM pengguna ORDER BY idPengguna DESC LIMIT 1");
			$data=mysql_fetch_array($tampil);

			$kd = substr("$data[idPengguna]", 6, 4); 
			$kdbaru= $kd + 1;
			$idPengguna="USER-".sprintf("%04s",$kdbaru);
		}elseif ($_GET[act]=="Update"){
			$edit = mysql_query("SELECT * FROM pengguna WHERE idPengguna='$_GET[id]'");
			$r    = mysql_fetch_array($edit);
			$idPengguna=$r[idPengguna];
		}
		
	?>
		<script type="text/javascript" src="../js/jquery-1.4.js"></script>
		<script type="text/javascript" src="../js/jquery.ketchup.js"></script>
		<script type="text/javascript" src="../js/jquery.ketchup.messages.js"></script>
		<script type="text/javascript" src="../js/jquery.ketchup.validations.basic.js"></script>
	<?php	
	echo"<form id='form' method=POST action=./aksi.php?module=pengguna&act=$act enctype='multipart/form-data'>
			<div id='judul'>
				$judul
				<input type=hidden id='idPengguna' name='idPengguna' value='$idPengguna' size=15 maxlength=255 class='validate(required)'>
			</div>
			<div style='width:600px;'>
				<div>
					<label>Name :</label>     
					<input type=text id='nmPengguna' name='nmPengguna' value='$r[nmPengguna]' size=50 maxlength=255 class='validate(required)'>
				</div>
				<div>
					<label>Username :</label> 
					<input type=text id='usernamePengguna' name='usernamePengguna' value='$r[usernamePengguna]' size=50 maxlength=255 class='validate(required)'>
				</div>
				<div>
					<label>Password :</label>     
					<input type=password id='passwordPengguna' name='passwordPengguna' size=50 maxlength=255>
				</div>   
				<div>
					<label>Level :</label>";
							if ($_GET[act]=='Add'){
								echo"<input type=radio id='levelPengguna' name='levelPengguna' value='Administrator'>Administrator
									<input type=radio id='levelPengguna' name='levelPengguna' value='Operator' checked>Operator";
							}elseif($_GET[act]=='Update'){
								$levelPengguna= array('Administrator', 'Operator');
								foreach ($levelPengguna as &$value){
									if ($r[levelPengguna]==$value){
										echo"	<input type=radio id='levelPengguna' name='levelPengguna' value='$value' checked>$value";
									}else{
										echo"	<input type=radio id='levelPengguna' name='levelPengguna' value='$value'>$value";
									}
								}
							}
			echo"</div>
				<div>
				<label>Male :</label>";
					if ($_GET[act]=='Add'){
						echo"<input type=radio id='jkPengguna' name='jkPengguna' value='Laki-Laki' checked>Laki-Laki
							<input type=radio id='jkPengguna' name='jkPengguna' value='Perempuan'>Perempuan";
					}elseif($_GET[act]=='Update'){
						$jkPengguna= array('Laki-Laki', 'Perempuan');
						foreach ($jkPengguna as &$value){
							if ($r[jkPengguna]==$value){
								echo"	<input type=radio id='jkPengguna' name='jkPengguna' value='$value' checked>$value";
							}else{
								echo"	<input type=radio id='jkPengguna' name='jkPengguna' value='$value' checked>$value";
							}
						}
					}
			echo"</div> 
				<div>
					<label>Address :</label> 
					<textarea id='alamatPengguna' name='alamatPengguna' cols='40' rows='3' class='validate(required)'>$r[alamatPengguna]</textarea>
				</div>
				<div>
					<label>Phone :</label>     
					<input type=text id='nohpPengguna' name='nohpPengguna' value='$r[nohpPengguna]' size=50 maxlength=255 class='validate(required)'>
				</div>
				<div>
					<label>Email :</label>     
					<input type=type id='emailPengguna' name='emailPengguna' value='$r[emailPengguna]' size=50 maxlength=255 class='validate(email)'>
				</div>
				<div class=buttons align=center>
					<button type=submit class=positive><img src=icon/drive.png>SAVE</button>
					<button type=button class=positive onclick=self.history.back()><img src=icon/cancel.png>CANCEL</button>
				</div>
			</div>
        </form>
		</div>";
	}
?>
