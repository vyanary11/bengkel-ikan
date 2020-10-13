<?php 
	include "koneksi.php";
	$tgl_sekarang=time();
	if (isset($_POST[tambah])) {
		if (mysqli_query($conn, "INSERT INTO balasan_thread VALUES('','$_GET[id]','$_SESSION[loginuser]','$tgl_sekarang','$_POST[isi_reply]')")) {
			$sql_thread_ini=mysqli_query($conn, "SELECT * FROM threads left join kategori on kategori.kd_kategori=threads.kd_kategori where kd_thread='$_GET[id]'");
        	$data_thread_ini=mysqli_fetch_assoc($sql_thread_ini);
			?>
	           <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/forum/<?php echo str_replace(" ", "-", $data_thread_ini[nama_kategori])."/".$data_thread_ini[judul_url]."-".$_GET[id] ?>.html">  
	        <?php 
		}else{
			?>
	           <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/forum/reply-thread/<?php echo $data_thread_ini[judul_url]."-".$_GET[id]."/msg=gagalinputreply" ?>">  
	        <?php 
		}
	}
?>