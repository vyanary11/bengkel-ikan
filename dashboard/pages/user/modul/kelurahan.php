<?php
    include "../../../bin/koneksi.php";

    $id_kecamatan = $_POST['kecamatan'];
    $sqlmodul = mysqli_query($conn, "SELECT * from kelurahan where kodeKecamatan='$id_kecamatan'");
    $html = "<option value=''>- Pilih Desa / Kelurahan -</option>";
    while($datamodul = mysqli_fetch_assoc($sqlmodul)){ 
        $html .= "<option value='".$datamodul['kodeKelurahan']."'>".$datamodul['namaKelurahan']."</option>"; 
    }

    $callback = array('data_desa'=>$html); 
    echo json_encode($callback); 
?>