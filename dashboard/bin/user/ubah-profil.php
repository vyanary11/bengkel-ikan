<?php
	include "../koneksi.php";
	if(isset($_POST[ubah_info])){
        if (mysqli_query($conn, "UPDATE user SET nama_lengkap='$_POST[nama]', tanggal_lahir='$_POST[tgl_lahir]', alamat='$_POST[alamat]', provinsi='$_POST[provinsi]', kabupaten='$_POST[kabupaten]', kecamatan='$_POST[kecamatan]', desa='$_POST[desa]', jenis_kelamin='$_POST[jenis_kelamin]', no_telp='$_POST[no_telp]', bio='$_POST[bio]' WHERE kd_user='$_GET[id]'")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/setting-profil/msg=berhasil-ubah-profil">  
	        <?php
        }else{
		 	?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/setting-profil/msg=gagal-ubah-profil">  
	        <?php
        }
    }elseif (isset($_POST[simpan_foto])) {
        $sql=mysqli_query($conn, "SELECT * FROM user where kd_user='$_GET[id]'");
	$data=mysqli_fetch_assoc($sql);
        $foto = basename($_FILES['fp']['name']);
    		$upload = "../../../assets/images/user/".$foto;
			if (move_uploaded_file($_FILES['fp']['tmp_name'], $upload)) {
				if ($data[fp]!="default.png") {
					unlink("../../../assets/images/user/".$data[fp]);
				}
				mysqli_query($conn, "UPDATE user SET fp='$foto' WHERE kd_user='$_GET[id]'");
				?>
		            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/setting-profil/msg=berhasil-ganti-foto">  
		        <?php 
			}else{
				?>
		            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/setting-profil/msg=gagal-ganti-foto">  
		        <?php 
			}
    }

?>