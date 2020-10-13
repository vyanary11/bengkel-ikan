<?php

include("koneksi.php");
if (isset($_POST[daftar])) {
	$sqlcek=mysqli_query($conn, "SELECT * FROM user WHERE email='$_POST[email]' and level_user='seller'");
	if (mysqli_num_rows($sqlcek)==1) {
		?>
		    <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>dashboard/daftar-seller/msg=emailsudahada">  
		<?php 
	}else{
		$pass=md5($_POST[password]);
		$kd_aktivasi=rand();
		$daftar=mysqli_query($conn, "INSERT INTO user VALUES('','$_POST[email]','$pass','$_POST[nama]','','','','','','','','$_POST[telp]','','default.png','seller','','$kd_aktivasi',now())");
		if ($daftar) {
			$sql_user=mysqli_query($conn, "SELECT * FROM user ORDER BY kd_user DESC LIMIT 1");
			$data_user=mysqli_fetch_assoc($sql_user);
			include "../../plugins/phpmailer/examples/daftar_user.php";

		}else{
			echo "gagal";
		}
	}
}

?>