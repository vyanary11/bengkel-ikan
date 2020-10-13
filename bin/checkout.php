<?php
	include "koneksi.php"; 
	$qryalamat=mysqli_query($conn, "SELECT * FROM propinsi left join kabupaten on kabupaten.kodePropinsi=propinsi.kodePropinsi  left join kecamatan on kecamatan.kodeKabKota=kabupaten.kodeKabKota left join kelurahan on kelurahan.kodeKecamatan=kecamatan.kodeKecamatan where kelurahan.kodeKelurahan='$_POST[desa]'");
	$dataalamat=mysqli_fetch_assoc($qryalamat);
	$alamat=$_POST[alamat].", Desa ".$dataalamat[namaKelurahan]." - ".$dataalamat[namaKecamatan]." - ".$dataalamat[namaKabKota]." - ".$dataalamat[namaPropinsi];

	$isicart=array();
	$qry1=mysqli_query($conn, "SELECT * FROM cart left join barang on barang.kd_barang=cart.kd_barang where cart.kd_user='$_SESSION[loginuser]'");
	while($r=mysqli_fetch_assoc($qry1)){
		$isicart[]=$r;
	}

	$jml=count($isicart);

	for($i=0; $i < $jml; $i++){
		$total=$total+($isicart[$i]['harga']*$isicart[$i]['qty']);
	}

	$randomangka=mt_rand(300,400);
	$totalakhir=$total+$randomangka;

	
	if(mysqli_query($conn, "INSERT INTO orders values('','$_SESSION[loginuser]','$_POST[nama]','$alamat','$_POST[no_telp]','$jml',now(),'$totalakhir','n')")){
		$qry4=mysqli_query($conn, "SELECT * FROM orders order by kd_order DESC");
		$dt4=mysqli_fetch_array($qry4);
		$kdorder4=$dt4['kd_order'];
		for($i=0; $i < $jml; $i++){
			mysqli_query($conn, "INSERT INTO detail_order values('$kdorder4',{$isicart[$i]['kd_barang']},{$isicart[$i]['harga']},{$isicart[$i]['qty']},{$isicart[$i]['harga']}*{$isicart[$i]['qty']},'pt')");
		}
		
		if(mysqli_query($conn, "DELETE FROM cart where kd_user='$_SESSION[loginuser]'")){
			$qry_order=mysqli_query($conn, "SELECT * FROM orders where kd_user='$_SESSION[loginuser]' ORDER by kd_order DESC");
			$data_order=mysqli_fetch_array($qry_order);
			$kdorder5=$data_order['kd_order'];
			include "../plugins/phpmailer/examples/checkout.php";
			
			?>
				<meta http-equiv="refresh" content="0;URL=<?php echo $base_url ?>/jual-beli/invoice/<?php echo $kdorder5; ?>">
			<?php	
		} else {
			echo "gagal2";
		}
	} else {
		echo "gagal1";
	}
?>