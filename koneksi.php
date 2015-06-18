<?php
	$connection = mysql_connect('localhost','root', '');
	if(!$connection )
	{
		echo "Koneksi Gagal";
	}
	mysql_select_db('biokimia');
?>