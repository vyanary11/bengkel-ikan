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

	function Tgl($data_tgl){
	    $tm=time();
	    $time=($tm-$data_tgl);

	    if ($time<60) {
	      echo "Baru Saja";
	    } else if ($time<3600) {
	      $time = ceil($time/60). " Menit Yang Lalu";
	      echo $time;
	    } else if ($time<86400) {
	      $time = ceil($time/3600). " Jam Yang Lalu";
	      echo $time;
	    }else{
	      echo date("d F Y", $data_tgl);
	    }
	  }
?>