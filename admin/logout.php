<?php
	session_start();
	session_destroy();
	
	header('location:../media.php?module=home');
?>
