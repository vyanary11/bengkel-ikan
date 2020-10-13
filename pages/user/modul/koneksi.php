<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bengkel_ikan";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	session_start();

	$sqlweb=mysqli_query($conn, "SELECT * FROM web_setting");
	$dataweb=mysqli_fetch_assoc($sqlweb);

	$base_url=$dataweb[base_url];

	date_default_timezone_set('Asia/Jakarta');

	function mysqli_result($res,$row=0,$col=0){ 
	    $numrows = mysqli_num_rows($res); 
	    if ($numrows && $row <= ($numrows-1) && $row >=0){
	        mysqli_data_seek($res,$row);
	        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
	        if (isset($resrow[$col])){
	            return $resrow[$col];
	        }
	    }
	    return false;
	}
?>