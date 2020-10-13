<?php
include "koneksi.php";
$qryambilgambar=mysqli_query($conn, "SELECT gambar_headline FROM threads WHERE kd_thread='$_GET[id]'");
$dtambilgambar=mysqli_fetch_row($qryambilgambar);
if(unlink("../assets/images/threads/".$dtambilgambar[0])){
	if (mysqli_query($conn, "DELETE FROM threads WHERE kd_thread='$_GET[id]'")) {
	?>
        <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/threads/<?php echo $_SESSION[loginuser] ?>/msg=berhasilhapus">  
    <?php 
	}else{
		?>
            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/threads/<?php echo $_SESSION[loginuser] ?>/msg=gagal">  
        <?php 
	} 
}else{
?>
    <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/user/threads/<?php echo $_SESSION[loginuser] ?>/msg=gagal"> 
<?php 
}