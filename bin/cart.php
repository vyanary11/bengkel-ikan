<?php 
	include "koneksi.php";
	if (!$_SESSION[loginuser]) {
		header("location:".$base_url."/masuk");
	}elseif (isset($_POST['enter'])) {
		$quantity=$_POST['qty'];
		if (mysqli_query($conn, "UPDATE cart set qty='$quantity' where kd_cart='$_GET[id]'")) {
			header("location:".$base_url."/jual-beli/cart");
		}	
	}elseif (isset($_GET[qty])) {
		if (mysqli_query($conn, "UPDATE cart set qty='$_GET[qty]' where kd_cart='$_GET[id]'")) {
			header("location:".$base_url."/jual-beli/cart");
		}
	}else {
		$qrycart=mysqli_query($conn, "SELECT * FROM cart where kd_barang='$_GET[id]' and kd_user='$_SESSION[loginuser]'");
		$cek=mysqli_num_rows($qrycart);
		if($cek==0){
			if(mysqli_query($conn, "INSERT INTO cart values('','$_SESSION[loginuser]','$_GET[id]',1)")){
				header("location:".$base_url."/jual-beli/cart");
			} else {
				echo "gagal";
			}
		} else {
			if(mysqli_query($conn, "UPDATE cart set qty=qty+1 where kd_barang='$_GET[id]' and kd_user='$_SESSION[loginuser]'")){
				header("location:".$base_url."/jual-beli/cart");
			} else {
				echo "gagal1";
			}
		}
	}
?>