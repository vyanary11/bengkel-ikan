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
	$judul_url=judul_url($_POST[nama_barang]);
	if (isset($_POST[tambah])) {
		$foto = basename($_FILES['gambar_barang']['name']);
    	$upload = "../../../assets/images/barang/".$foto;
		if (mysqli_query($conn, "INSERT INTO barang VALUES('', '$_POST[kategori]','$_SESSION[loginadmin]','$_POST[nama_barang]','$judul_url', '$_POST[harga]', '$_POST[deskripsi]', '$foto','$_POST[satuan]','')")) {
			move_uploaded_file($_FILES['gambar_barang']['tmp_name'],$upload);
			?>
	           <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/barang/msg=berhasiltambah">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/barang/msg=gagal">  
	        <?php 
		}
	}elseif (isset($_POST[ubah])) {
		$foto = basename($_FILES['gambar_barang']['name']);
    	$upload = "../../../assets/images/barang/".$foto;
		if ($foto=="") {
			$query=mysqli_query($conn, "UPDATE barang SET kd_kategori='$_POST[kategori]',nama_barang='$_POST[nama_barang]', judul_url='$judul_url',harga='$_POST[harga]',deskripsi='$_POST[deskripsi]', satuan='$_POST[satuan]' WHERE kd_barang='$_GET[id]'");
		}else{
			$qryambilgambar=mysqli_query($conn, "SELECT gambar_barang FROM barang WHERE kd_barang='$_GET[id]'");
			$dtambilgambar=mysqli_fetch_row($qryambilgambar);
			if ($dtambilgambar[0]!="" and $dtambilgambar[0]!="no-image.jpeg") {
				unlink("../../../assets/images/barang/".$dtambilgambar[0]);
			}
			$query=mysqli_query($conn, "UPDATE barang SET kd_kategori='$_POST[kategori]',nama_barang='$_POST[nama_barang]', judul_url='$judul_url',deskripsi='$_POST[deskripsi]', harga='$_POST[harga]', satuan='$_POST[satuan]', gambar_barang='$foto' WHERE kd_barang='$_GET[id]'");
		}
		
		if ($query) {
			move_uploaded_file($_FILES['gambar_barang']['tmp_name'],$upload);
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/barang/msg=berhasilsimpan">
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/barang/msg=gagal">  
	        <?php 
		}
	}else{
		$qryambilgambar=mysqli_query($conn, "SELECT gambar_barang FROM barang WHERE kd_barang='$_GET[id]'");
		$dtambilgambar=mysqli_fetch_row($qryambilgambar);
		if(unlink("../../../assets/images/barang/".$dtambilgambar[0])){
			if (mysqli_query($conn, "DELETE FROM barang WHERE kd_barang='$_GET[id]'")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/barang/msg=berhasilhapus">  
	        <?php 
			}else{
				?>
		            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/barang/msg=gagal">  
		        <?php 
			}
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/barang/msg=gagal">  
	        <?php 
			}
	}
?>