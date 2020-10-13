<?php
include("koneksi.php");
if (isset($_POST[kirim])) {
	$sqlcek=mysqli_query($conn, "SELECT * FROM user WHERE email='$_POST[email]' and level_user!='user'");
	if (mysqli_num_rows($sqlcek)==1) {
		$kode_reset_password=rand();
		$reset=mysqli_query($conn, "UPDATE user SET kode_reset_password='$kode_reset_password' WHERE email='$_POST[email]'");
		if ($reset) {
			$sql_user=mysqli_query($conn, "SELECT * FROM user WHERE email='$_POST[email]'");
			$data_user=mysqli_fetch_assoc($sql_user);
			include "../../plugins/phpmailer/examples/lupa_password.php";
		}else{
			echo "gagal";
		}
	}else{
		?>
		    <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/lupa-password/msg=emailtidakterdaftar">  
		<?php 
	}
}

?>