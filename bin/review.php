<?php 
	include "koneksi.php";
	if (!$_SESSION[loginuser]) {
		?>
			<meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/masuk">
		<?php
	}elseif (isset($_POST[kirim])) {
		if (mysqli_query($conn, "INSERT INTO review values('', '$_GET[id]', '$_SESSION[loginuser]', '$_POST[rating]', now(),'$_POST[review]')")) {
			?>
				<meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/jual-beli/<?php echo str_replace(" ", "-", $data[nama_kategori]); ?>/<?php echo $data[judul_url]."-".$_GET[id].".html"; ?>">  
			<?php
		}else{
			echo "gagal";
		}
	}
?>