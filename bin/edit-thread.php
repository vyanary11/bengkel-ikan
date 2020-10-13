<?php 
	include "koneksi.php";
	function judul_url($s) {  
	   $c = array (' ');  
	   $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');  
	   $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d  
	   
	   $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua  
	   return $s;  
	}
	$tgl_sekarang=time();
	$judul_url=judul_url($_POST[judul]);
	if (isset($_POST[simpan])) {
		$foto = basename($_FILES['headline_thread']['name']);
    	$upload = "../assets/images/threads/".$foto;
		if ($foto=="") {
			$query=mysqli_query($conn, "UPDATE threads SET kd_kategori='$_POST[kategori]', judul='$_POST[judul]', judul_url='$judul_url' , isi='$_POST[isi_thread]' WHERE kd_thread='$_GET[id]'");
		}else{
			$qryambilgambar=mysqli_query($conn, "SELECT gambar_headline FROM threads WHERE kd_thread='$_GET[id]'");
			$dtambilgambar=mysqli_fetch_row($qryambilgambar);
			unlink("../assets/images/threads/".$dtambilgambar[0]);
			$query=mysqli_query($conn, "UPDATE threads SET kd_kategori='$_POST[kategori]', judul='$_POST[judul]', judul_url='$judul_url' , isi='$_POST[isi_thread]', gambar_headline='$foto' WHERE kd_thread='$_GET[id]'");
		}
		if ($query) {
			move_uploaded_file($_FILES['headline_thread']['tmp_name'],$upload);
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/threads/<?php echo $_SESSION[loginuser] ?>/msg=berhasileditthread">
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/threads/<?php echo $_SESSION[loginuser] ?>/msg=gagal">
	        <?php  
		}
	}