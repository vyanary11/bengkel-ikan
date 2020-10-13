<?php 
	include "../koneksi.php";
	if (isset($_POST[tambah])) {
		$password=md5($_POST[password]);
		if (mysqli_query($conn, "INSERT INTO user VALUES('','$_POST[email]','$password','$_POST[nama]','','','','','','','','$_POST[telp]','','default.png','admin',0,0,now())")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/user/msg=berhasiltambahadmin">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/user/msg=gagalsimpan">  
	        <?php 
		}
	}else{
		if (mysqli_query($conn, "DELETE FROM user WHERE kd_user='$_GET[id]'")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/user/msg=berhasilhapus">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/user/msg=gagalhapus">  
	        <?php 
		}
	}
?>