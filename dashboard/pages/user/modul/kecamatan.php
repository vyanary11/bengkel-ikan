<?php
    include "../../../bin/koneksi.php";

    $id_kabkota = $_POST['kabupaten'];
    $sqlmodul = mysqli_query($conn, "SELECT * from kecamatan where kodeKabKota='$id_kabkota'");
    $html = "<option value=''>- Pilih Kecamatan -</option>";
    while($datamodul = mysqli_fetch_assoc($sqlmodul)){ 
        $html .= "<option value='".$datamodul['kodeKecamatan']."'>".$datamodul['namaKecamatan']."</option>"; 
    }

    $callback = array('data_kec'=>$html); 
    echo json_encode($callback); 
?>