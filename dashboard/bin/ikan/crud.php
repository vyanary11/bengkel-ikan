<?php 
	include "../koneksi.php";
	if (isset($_POST[tambah])) {
		$foto = basename($_FILES['gambar_ikan']['name']);
    	$upload = "../../../assets/images/ikan/".$foto;
		if (mysqli_query($conn, "INSERT INTO ikan VALUES('','$_POST[jenis_ikan]','$_POST[nama_ikan]','$foto')")) {
			move_uploaded_file($_FILES['gambar_ikan']['tmp_name'],$upload);
			?>
	           <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/ikan/msg=berhasiltambah">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/ikan/msg=gagal">  
	        <?php 
		}
	}elseif (isset($_POST[ubah])) {
		$foto = basename($_FILES['gambar_ikan']['name']);
    	$upload = "../../../assets/images/ikan/".$foto;
		if ($foto=="") {
			$query=mysqli_query($conn, "UPDATE ikan SET kd_jenis_ikan='$_POST[jenis_ikan]', nama_ikan='$_POST[nama_ikan]' WHERE kd_ikan='$_GET[id]'");
		}else{
			$qryambilgambar=mysqli_query($conn, "SELECT gambar_ikan FROM ikan WHERE kd_ikan='$_GET[id]'");
			$dtambilgambar=mysqli_fetch_row($qryambilgambar);
			if ($dtambilgambar[0]!="" and $dtambilgambar[0]!="no-image.jpeg") {
				unlink("../../../assets/images/ikan/".$dtambilgambar[0]);
			}
			$query=mysqli_query($conn, "UPDATE ikan SET kd_jenis_ikan='$_POST[jenis_ikan]', nama_ikan='$_POST[nama_ikan]', gambar_ikan='$foto' WHERE kd_ikan='$_GET[id]'");
		}
		
		if ($query) {
			move_uploaded_file($_FILES['gambar_ikan']['tmp_name'],$upload);
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/ikan/msg=berhasilsimpan">
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/ikan/msg=gagal">  
	        <?php 
		}
	}else{
		$qryambilgambar=mysqli_query($conn, "SELECT gambar_ikan FROM ikan WHERE kd_ikan='$_GET[id]'");
		$dtambilgambar=mysqli_fetch_row($qryambilgambar);
		if(unlink("../../../assets/images/ikan/".$dtambilgambar[0])){
			if (mysqli_query($conn, "DELETE FROM ikan WHERE kd_ikan='$_GET[id]'")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/ikan/msg=berhasilhapus">  
	        <?php 
			}else{
				?>
		            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/ikan/msg=gagal">  
		        <?php 
			}
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/ikan/msg=gagal">  
	        <?php 
		}
	}
?>