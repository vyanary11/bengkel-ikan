<?php
include("koneksi.php");
	$sqluser=mysqli_query($conn, "SELECT * FROM user WHERE kd_user='$_GET[kd_user]'");
	$datauser=mysqli_fetch_assoc($sqluser);
	
	$password_baru=md5($_POST['password_baru']);
	$aktivasi=mysqli_query($conn, "UPDATE user SET kode_reset_password=0, password='$password_baru' WHERE kd_user='$_GET[kd_user]'");
	if ($aktivasi) {
	?>
	    <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/masuk/msg=resetpasswordberhasil">  
	<?php 
	}else{
		echo "gagal";
	}
?>