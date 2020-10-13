<?php 
	include "../koneksi.php";
	if (isset($_POST[tambah])) {
		if (mysqli_query($conn, "INSERT INTO kategori VALUES('','$_POST[kategori_utama]','$_POST[nama_kategori]')")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/kategori/msg=berhasiltambah">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/kategori/msg=gagal">  
	        <?php 
		}
	}elseif (isset($_POST[ubah])) {
		if (mysqli_query($conn, "UPDATE kategori SET kd_kategori_utama=$_POST[kategori_utama], nama_kategori='$_POST[nama_kategori]' WHERE kd_kategori='$_GET[id]'")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/kategori/msg=berhasilsimpan">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/kategori/msg=gagal">  
	        <?php 
		}
	}else{
		if (mysqli_query($conn, "DELETE FROM kategori WHERE kd_kategori='$_GET[id]'")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/kategori/msg=berhasilhapus">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/kategori/msg=gagal">  
	        <?php 
		}
	}
?>