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
	if (isset($_POST[tambah])) {
		$foto = basename($_FILES['headline_thread']['name']);
    	$upload = "../assets/images/threads/".$foto;
		if (mysqli_query($conn, "INSERT INTO threads VALUES('','$_SESSION[loginuser]','$_POST[kategori]','$tgl_sekarang','$_POST[judul]','$judul_url','$_POST[isi_thread]','$foto','')")) {
			move_uploaded_file($_FILES['headline_thread']['tmp_name'],$upload);
			?>
	           <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/threads/<?php echo $_SESSION[loginuser] ?>/msg=berhasiltulisthread">  
	        <?php 
		}else{
			?>
	           <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/threads/<?php echo $_SESSION[loginuser] ?>/msg=gagal">  
	        <?php 
		}
	}
?>