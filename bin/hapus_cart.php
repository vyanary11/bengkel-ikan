 <?php 
	include "koneksi.php";
	if(mysqli_query($conn, "DELETE FROM cart where kd_cart='$_GET[id]'")){
		?>
		    <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/jual-beli/cart">  
		<?php	
	} else {
		echo "gagal";
	}

 ?> 