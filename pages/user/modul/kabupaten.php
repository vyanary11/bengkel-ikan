<?php
	include "../../../bin/koneksi.php";

	$id_provinsi = $_POST['provinsi'];
	$sqlmodul = mysqli_query($conn, "SELECT * from kabupaten where kodePropinsi='$id_provinsi'");
	$html = "<option value=''>- Pilih Kabupaten -</option>";
	while($datamodul = mysqli_fetch_assoc($sqlmodul)){ 
	    $html .= "<option value='".$datamodul['kodeKabKota']."'>".$datamodul['namaKabKota']."</option>"; 
	}

	$callback = array('data_kota_user'=>$html); 
	echo json_encode($callback); 
?>