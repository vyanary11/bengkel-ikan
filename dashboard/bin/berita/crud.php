<?php 
	include "../koneksi.php";
	function judul_url($s) {  
	   $c = array (' ');  
	   $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');  
	   $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d  
	   
	   $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua  
	   return $s;  
	}
	$tgl_sekarang=time();
	$judul_url=judul_url($_POST[judul]);
	if (isset($_POST[tambah])) {
		$foto = basename($_FILES['headline_berita']['name']);
    	$upload = "../../../assets/images/berita/".$foto;
		if (mysqli_query($conn, "INSERT INTO berita VALUES('','$_POST[Kategori]','$_SESSION[loginadmin]','$tgl_sekarang','$_POST[judul]','$judul_url','$_POST[isi_berita]','$foto','')")) {
			move_uploaded_file($_FILES['headline_berita']['tmp_name'],$upload);
			?>
	           <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/berita/msg=berhasil-tambah-data">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/berita/msg=gagal-tambah-data">  
	        <?php 
		}
	}elseif (isset($_POST[ubah])) {
		$foto = basename($_FILES['headline_berita']['name']);
    	$upload = "../../../assets/images/berita/".$foto;
		if ($foto=="") {
			$query=mysqli_query($conn, "UPDATE berita SET kd_kategori='$_POST[Kategori]', judul='$_POST[judul]', judul_url='$judul_url' , isi='$_POST[isi_berita]' WHERE kd_berita='$_GET[id]'");
		}else{
			$qryambilgambar=mysqli_query($conn, "SELECT gambar_headline FROM berita WHERE kd_berita='$_GET[id]'");
			$dtambilgambar=mysqli_fetch_row($qryambilgambar);
			if ($dtambilgambar[0]!="" and $dtambilgambar[0]!="no-image.jpeg") {
				unlink("../../../assets/images/berita/".$dtambilgambar[0]);
			}
			$query=mysqli_query($conn, "UPDATE berita SET kd_kategori='$_POST[Kategori]', judul='$_POST[judul]', judul_url='$judul_url' , isi='$_POST[isi_berita]', gambar_headline='$foto' WHERE kd_berita='$_GET[id]'");
		}
		if ($query) {
			move_uploaded_file($_FILES['headline_berita']['tmp_name'],$upload);
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/berita/msg=berhasil-simpan-data">
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/berita/msg=gagal-simpan-data">  
	        <?php 
		}
	}else{
		$qryambilgambar=mysqli_query($conn, "SELECT gambar_headline FROM berita WHERE kd_berita='$_GET[id]'");
		$dtambilgambar=mysqli_fetch_row($qryambilgambar);
		if(unlink("../../../assets/images/berita/".$dtambilgambar[0])){
			if (mysqli_query($conn, "DELETE FROM berita WHERE kd_berita='$_GET[id]'")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/berita/msg=berhasil-hapus-data">  
	        <?php 
			}else{
				?>
		            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/berita/msg=gagal-hapus-data">  
		        <?php 
			} 
		}else{
		?>
            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/berita/msg=gagal">  
        <?php 
		}
	}
?>