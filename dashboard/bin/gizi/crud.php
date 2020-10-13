<?php 
	include "../koneksi.php";
	if (isset($_POST[tambah])) {
		if (mysqli_query($conn, "INSERT INTO gizi_ikan VALUES ('','$_POST[ikan]','$_POST[kalori]','$_POST[protein]','$_POST[lemak]','$_POST[karbohidrat]','$_POST[kalsium]','$_POST[fosfor]','$_POST[besi]','$_POST[vit_a]','$_POST[vit_b1]','$_POST[vit_c]')")) {
		?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/gizi/msg=berhasiltambah">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/gizi/msg=gagal">  
	        <?php 
		}
	}elseif (isset($_POST[ubah])) {
		if (mysqli_query($conn, "UPDATE gizi_ikan SET kd_ikan='$_POST[ikan]',kalori ='$_POST[kalori]', protein ='$_POST[protein]',lemak ='$_POST[lemak]',karbohidrat ='$_POST[karbohidrat]', kalsium ='$_POST[kalsium]', fosfor ='$_POST[fosfor]', besi ='$_POST[besi]', vit_a = '$_POST[vit_a]', vit_b1 ='$_POST[vit_b1]', vit_c = '$_POST[vit_c]' WHERE  kd_gizi='$_GET[id]'")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/gizi/msg=berhasilsimpan">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/gizi/msg=gagal">  
	        <?php 
		}	 
	}else{
		if (mysqli_query($conn, "DELETE FROM gizi_ikan WHERE kd_gizi='$_GET[id]'")) {
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/gizi/msg=berhasilhapus">  
	        <?php 
		}else{
			?>
	            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/gizi/msg=gagal">  
	        <?php 
		}
	}
?>
	