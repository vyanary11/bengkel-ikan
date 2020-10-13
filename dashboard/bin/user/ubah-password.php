<?php
	include "../koneksi.php";
	$sql=mysqli_query($conn, "SELECT * FROM user where kd_user='$_GET[id]'");
	$data=mysqli_fetch_assoc($sql);
	if(isset($_POST[ubah_pass])){
        if ($data[password]==md5($_POST[password1])) {
        	if ($_POST[passbaru]==$_POST[passbaru1]) {
                $passbaru=md5($_POST[passbaru1]);
                mysqli_query($conn, "UPDATE user SET password='$passbaru' WHERE kd_user='$_GET[id]'");
	        	?>
		            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/setting-profil/msg=berhasil-ubah-password">  
		        <?php
	        }else{
				?>
		            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/setting-profil/msg=gagal-password-tidak-sama">  
		        <?php
    		}
        }else{
        	?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/setting-profil/msg=gagal-password-tidak-valid">  
	        <?php
        }
	}
?>