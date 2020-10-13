<?php 
	include "../koneksi.php";
	if (isset($_POST[tambah])) {
		if (mysqli_query($conn, "INSERT INTO jenis_ikan VALUES('','$_POST[jenis_ikan]')")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/jenis-ikan/msg=berhasiltambah">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/jenis-ikan/msg=gagal">  
	        <?php 
		}
	}elseif (isset($_POST[ubah])) {
		if (mysqli_query($conn, "UPDATE jenis_ikan SET jenis_ikan='$_POST[jenis_ikan]' WHERE kd_jenis_ikan='$_GET[id]'")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/jenis-ikan/msg=berhasilsimpan">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/jenis-ikan/msg=gagal">  
	        <?php 
		}
	}else{
		if (mysqli_query($conn, "DELETE FROM jenis_ikan WHERE kd_jenis_ikan='$_GET[id]'")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/jenis-ikan/msg=berhasilhapus">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/jenis_ikan/msg=gagal">  
	        <?php 
		}
	}
?>