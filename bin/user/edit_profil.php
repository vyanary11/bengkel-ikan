<?php 
	include "../koneksi.php";
	$sql=mysqli_query($conn, "SELECT * FROM user where kd_user='$_GET[kd_user]'");
	$data=mysqli_fetch_assoc($sql);
	$konfirmasipass=md5($_POST[password1]);
	if ($data['password']==$konfirmasipass) {
		if (isset($_POST['simpan_foto'])) {
			$foto = basename($_FILES['filefoto']['name']);
    		$upload = "../../assets/images/user/".$foto;
			if (move_uploaded_file($_FILES['filefoto']['tmp_name'], $upload)) {
				if ($data[fp]!="default.png") {
					unlink("../../assets/images/user/".$data[fp]);
				}
				mysqli_query($conn, "UPDATE user SET fp='$foto' WHERE kd_user='$_GET[kd_user]'");
				?>
		           <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/tentang-saya/<?php echo $_GET[kd_user] ?>/msg=berhasilubahfoto">  
		        <?php 
			}
		}elseif (isset($_POST['simpan_info'])) {
			if (mysqli_query($conn, "UPDATE user SET nama_lengkap='$_POST[nama]', tanggal_lahir='$_POST[tgl_lahir]', alamat='$_POST[alamat]', provinsi='$_POST[provinsi]', kabupaten='$_POST[kabupaten]', kecamatan='$_POST[kecamatan]', desa='$_POST[desa]', jenis_kelamin='$_POST[jenis_kelamin]', no_telp='$_POST[no_telp]', bio='$_POST[bio]' WHERE kd_user='$_GET[kd_user]'")) {
				?>
		           <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/tentang-saya/<?php echo $_GET[kd_user] ?>/msg=berhasilubahprofil">  
		        <?php
			}else{
				echo "string";
			}
		}elseif (isset($_POST['simpan_pass'])) {
			if ($_POST[passbaru]==$_POST[passbaru1]) {
				$passbaru=md5($_POST[passbaru1]);
				mysqli_query($conn, "UPDATE user SET password='$passbaru' WHERE kd_user='$_GET[kd_user]'");
				?>
		           <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/tentang-saya/<?php echo $_GET[kd_user] ?>/msg=berhasilubahpass">  
		        <?php
			}else{
				?>
		           <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/tentang-saya/<?php echo $_GET[kd_user] ?>/msg=gagalpasstidaksama">  
		        <?php
			}
		}
	}else{
		?>
           <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/tentang-saya/<?php echo $_GET[kd_user] ?>/msg=gagalpasssalah">  
        <?php 
	}
?>