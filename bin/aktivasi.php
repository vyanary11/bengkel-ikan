<?php
include("koneksi.php");
	$sqluser=mysqli_query($conn, "SELECT * FROM user WHERE kd_user='$_GET[kd_user]'");
	$datauser=mysqli_fetch_assoc($sqluser);
	if ($datauser[kode_aktivasi]==0) {
		?>
		    <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>">  
		<?php 
	}elseif($datauser[kode_aktivasi]==$_GET[kode_aktivasi]){
		$aktivasi=mysqli_query($conn, "UPDATE user SET kode_aktivasi=0 WHERE kd_user='$_GET[kd_user]'");
		if ($aktivasi) {
			?>
		    <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/masuk/msg=aktivasiberhasil">  
		<?php 
		}else{
			echo "gagal";
		}
	}else{
		?>
		    <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>">  
		<?php 
	}

?>