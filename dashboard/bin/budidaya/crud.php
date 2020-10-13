<?php 
	include "../koneksi.php";
	if (isset($_POST[tambah])) {
		if (mysqli_query($conn, "INSERT INTO budidaya_ikan VALUES ('','$_POST[ikan]','$_POST[deskripsi]','$_POST[budidaya]')")) {
		?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/budidaya/msg=berhasiltambah">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/budidaya/msg=gagal">  
	        <?php 
		}
	}elseif (isset($_POST[ubah])) {
		if (mysqli_query($conn, "UPDATE budidaya_ikan SET kd_ikan ='$_POST[ikan]',deskripsi ='$_POST[deskripsi]', budidaya ='$_POST[budidaya]' WHERE kd_budidaya='$_GET[id]'")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/budidaya/msg=berhasilsimpan">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/budidaya/msg=gagal">  
	        <?php 
		}	 
	}else{
		if (mysqli_query($conn, "DELETE FROM budidaya_ikan WHERE kd_budidaya='$_GET[id]'")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/budidaya/msg=berhasilhapus">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/budidaya/msg=gagal">  
	        <?php 
		}
	}
?>