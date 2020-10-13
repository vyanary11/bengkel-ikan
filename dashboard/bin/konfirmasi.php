<?php
	include("koneksi.php");
	$sql_konfirmasi=mysqli_query($conn, "SELECT * FROM konfirmasi_order WHERE kd_konfirmasi='$_GET[id]'");
	$data_konfirmasi=mysqli_fetch_assoc($sql_konfirmasi);
	if (isset($_GET[s])) {
		if ($_GET[s]=="1") {
			if (mysqli_query($conn,"UPDATE konfirmasi_order SET status='valid' WHERE kd_konfirmasi='$_GET[id]'")) {
				if (mysqli_query($conn,"UPDATE orders SET status_pembayaran='y' WHERE kd_order='$data_konfirmasi[kd_order]'")) {
					$sql_seller=mysqli_query($conn, "SELECT DISTINCT user.kd_user,email,nama_lengkap FROM user left join barang on barang.kd_user=user.kd_user left join detail_order on barang.kd_barang=detail_order.kd_barang WHERE kd_order='$data_konfirmasi[kd_order]'");
					require '../../plugins/phpmailer/PHPMailerAutoload.php';
					while ($data_seller=mysqli_fetch_assoc($sql_seller)) {
						include("../../plugins/phpmailer/examples/ke_seller.php");
					}
					include("../../plugins/phpmailer/examples/konfirmasi.php");
					?>
						  <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/konfirmasi/msg=berhasil-accept-konfirmasi">
					<?php
				}
			}
		}else{
			if (mysqli_query($conn,"UPDATE konfirmasi_order SET status='invalid' WHERE kd_konfirmasi='$_GET[id]'")) {
					require '../../plugins/phpmailer/PHPMailerAutoload.php';
					include("../../plugins/phpmailer/examples/konfirmasi.php");
					?>
						  <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/konfirmasi/msg=berhasil-banned-konfirmasi">
					<?php
			}
		}
	}else{
		echo "asa";
	}
?>