<?php
	include("../koneksi.php");
	$sql_detail_pesanan=mysqli_query($conn, "SELECT * FROM detail_order WHERE kd_order='$_GET[kdorder]' and kd_barang='$_GET[kdbarang]'");
	$data_detail_pesanan=mysqli_fetch_assoc($sql_detail_pesanan);
	if (isset($_GET[s])) {
		if ($_GET[s]=="1") {
			if (mysqli_query($conn,"UPDATE detail_order SET status='p' WHERE kd_order='$_GET[kdorder]' and kd_barang='$_GET[kdbarang]'")) {
					include("../../../plugins/phpmailer/examples/detail_pesanan.php");
					?>
						  <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/pesanan/detail-pesanan/id=<?php echo $_GET[kdorder] ?>/msg=berhasil-memproses-pesanan">
					<?php
			}
		}elseif($_GET[s]=="2"){
			if (mysqli_query($conn,"UPDATE detail_order SET status='b' WHERE kd_order='$_GET[kdorder]' and kd_barang='$_GET[kdbarang]'")) {
					include("../../../plugins/phpmailer/examples/detail_pesanan.php");
					?>
						 <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/pesanan/detail-pesanan/id=<?php echo $_GET[kdorder] ?>/msg=berhasil-membatalkan-pesanan">
					<?php
			}
		}elseif($_GET[s]=="3"){
			if (mysqli_query($conn,"UPDATE detail_order SET status='d' WHERE kd_order='$_GET[kdorder]' and kd_barang='$_GET[kdbarang]'")) {
					include("../../../plugins/phpmailer/examples/detail_pesanan.php");
					?>
						 <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/pesanan/detail-pesanan/id=<?php echo $_GET[kdorder] ?>/msg=berhasil-mengirim-pesanan">
					<?php
			}
		}elseif($_GET[s]=="4"){
			if (mysqli_query($conn,"UPDATE detail_order SET status='t' WHERE kd_order='$_GET[kdorder]' and kd_barang='$_GET[kdbarang]'")) {
					include("../../../plugins/phpmailer/examples/detail_pesanan.php");
					?>
						  <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/detail-pesanan=<?php echo $_GET[kdorder]; ?>/<?php echo $data_orders[kd_user]; ?>">
					<?php
			}
		}
	}
?>