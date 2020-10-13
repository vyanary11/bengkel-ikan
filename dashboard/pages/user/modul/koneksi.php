<?php
	$servername = "localhost";
	$username = "id8846108_bengkelikan";
	$password = "vyanary11";
	$dbname = "id8846108_bengkelikan";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	session_start();

	$sqlweb=mysqli_query($conn, "SELECT * FROM web_setting");
	$dataweb=mysqli_fetch_assoc($sqlweb);

	$base_url=$dataweb[base_url];
	date_default_timezone_set('Asia/Jakarta');
?>