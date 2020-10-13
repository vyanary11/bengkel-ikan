<?php 
	include "koneksi.php";
	if (isset($_POST[kirim])) {
		$sql_cek_kd_order=mysqli_query($conn,"SELECT * FROM orders WHERE kd_order='$_POST[kode_order]' and kd_user='$_SESSION[loginuser]'");
		$data_cek_kd_order=mysqli_fetch_assoc($sql_cek_kd_order);
		$tgl_sekarang=time();
		$tgl_order_berakhir=strtotime('+12 hours', strtotime($data_cek_kd_order[tgl_order])); 
		if (mysqli_num_rows($sql_cek_kd_order)==1) {
			if ($_POST[jumlah]!=$data_cek_kd_order[total]) {
				?>
					<meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/konfirmasi/<?php echo $_SESSION[loginuser] ?>/msg=gagal-jumlah-yang-ditransfer">  
				<?php
			}else{
				if ($data_cek_kd_order[status_pembayaran]=="n" and $tgl_sekarang<$tgl_order_berakhir ) {
					$foto = basename($_FILES['filebukti']['name']);
		    		$bukti = "../assets/images/bukti/".$foto;
					if (mysqli_query($conn, "INSERT INTO konfirmasi_order VALUES('','$_POST[kode_order]','$_POST[bank]','$_POST[nama]','$_POST[jumlah]','$_POST[tgl_transfer]','$foto','perlu validasi')")) {
						move_uploaded_file($_FILES['filebukti']['tmp_name'],$bukti);
						?>
							<meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/konfirmasi/<?php echo $_SESSION[loginuser] ?>/msg=berhasil-konfirmasi">  
						<?php
					}else{
						?>
							<meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/konfirmasi/<?php echo $_SESSION[loginuser] ?>/msg=gagal-konfirmasi">  
						<?php
					}
				}else{
					?>
							<meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/konfirmasi/<?php echo $_SESSION[loginuser] ?>/msg=gagal-kadaluarsa">  
						<?php
				}
			}
		}else{
			?>
				<meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/konfirmasi/<?php echo $_SESSION[loginuser] ?>/msg=gagal-kode-order-tidak-ada">  
			<?php
		}
	}
?>