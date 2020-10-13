<body onload="window.print()">
<?php
  include "../../bin/koneksi.php";
  $qry_order=mysqli_query($conn, "SELECT * FROM orders where kd_user='$_SESSION[loginuser]' and kd_order='$_GET[id]' ORDER by kd_order DESC");
  $data_order=mysqli_fetch_array($qry_order);
  $sql_user=mysqli_query($conn, "SELECT * FROM user where kd_user='$data_order[kd_user]'");
  $data_user=mysqli_fetch_assoc($sql_user);
  $emailuser=$data_user[email];
  $namauser=$data_user[nama];
  $tgl = date('D, d F Y', strtotime('+12 hours', strtotime($data_order[tgl_order])));
  $jam = date('H:i', strtotime('+12 hours', strtotime($data_order[tgl_order])));
  $tgl_kadaluarsa=$tgl." Pukul ".$jam."WIB (1 x 12 Jam)";
  $tbelakang=substr($data_order[total], -3);
  $tdepan=str_replace($tbelakang,  " ", $data_order[total]);

  $sql_dtl_order=mysqli_query($conn, "SELECT barang.nama_barang, barang.gambar_barang, detail_order.harga, detail_order.qty, detail_order.total_harga FROM detail_order left join barang on barang.kd_barang=detail_order.kd_barang where kd_order='$data_order[kd_order]'");
  $isi_pesanan="";

  if (preg_match('/https/', $base_url)) {
    $nama_web=str_replace("https://", "", $base_url);
  }else{
    $nama_web=str_replace("http://", "", $base_url);
  }

  while ($data_dtl_order=mysqli_fetch_array($sql_dtl_order)) {
    $subtotal+=$data_dtl_order[total_harga];
    $isi_pesanan=$isi_pesanan.'<tr>
        <td class="font-weight-bold">'.$data_dtl_order[nama_barang].'</td>
        <td class="text-right">Rp. '.number_format($data_dtl_order[harga]).'</td>
        <td class="text-center">'.number_format($data_dtl_order[qty]).'</td>
        <td class="text-right">Rp. '.number_format($data_dtl_order[total_harga]).'</td>
      </tr>';
  }

  $kode_pemabayaran=$data_order[total]-$subtotal;

  $url_detail_pesanan='<a href="'.$base_url.'/user/detail-order='.$data_order[kd_order].'/'.$data_order[kd_user].'" class="btn btn-primary">Lihat Detail Pesanan</a>';
   
$msg = '
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Selamat datang di Bengkel Ikan</title>
  <style type="text/css">
    .media {display: -ms-flexbox;display: flex;-ms-flex-align: start;    align-items: flex-start;}.media-body {-ms-flex: 1;flex: 1;}.mt-0{margin-top:0!important}.mb-1{margin-bottom:0.25rem!important}.text-white{color:#fff!important}html{box-sizing:border-box;font-family:sans-serif;line-height:1.15;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;-ms-overflow-style:scrollbar;-webkit-tap-highlight-color:transparent}body{margin:0;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;font-size:1rem;font-weight:400;line-height:1.5;color:#212529;background-color:#fff}hr{box-sizing:content-box;height:0;overflow:visible}h1,h2,h3,h4,h5,h6{margin-top:0;margin-bottom:.5rem}p{margin-top:0;margin-bottom:1rem}ol,ul,dl{margin-top:0;margin-bottom:1rem}ol ol,ul ul,ol ul,ul ol{margin-bottom:0}b,strong{font-weight:bolder}img{vertical-align:middle;border-style:none}table{border-collapse:collapse}th{text-align:left}h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6{margin-bottom:.5rem;font-family:inherit;font-weight:500;line-height:1.1;color:inherit}h1,.h1{font-size:2.5rem}h2,.h2{font-size:2rem}h3,.h3{font-size:1.75rem}h4,.h4{font-size:1.5rem}h5,.h5{font-size:1.25rem}h6,.h6{font-size:1rem}hr{margin-top:1rem;margin-bottom:1rem;border:0;border-top:1px solid rgba(0,0,0,.1)}mark,.mark{padding:.2em;background-color:#fcf8e3}.list-unstyled{padding-left:0;list-style:none}.list-inline{padding-left:0;list-style:none}.list-inline-item{display:inline-block}.list-inline-item:not(:last-child){margin-right:5px}.img-fluid{max-width:100%;height:auto}.container{margin-right:auto;margin-left:auto;padding-right:15px;padding-left:15px;width:100%}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}.row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}.col-1,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-10,.col-11,.col-12{position:relative;width:100%;min-height:1px;padding-right:15px;padding-left:15px}.col-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}.col-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}.col-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}.col-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}.col-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}.col-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}.col-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}.table{width:100%;max-width:100%;margin-bottom:1rem;background-color:transparent}.table th,.table td{padding:.75rem;vertical-align:top;border-top:1px solid #e9ecef}.table thead th{vertical-align:bottom;border-bottom:2px solid #e9ecef}.table tbody + tbody{border-top:2px solid #e9ecef}.table .table{background-color:#fff}.table-sm th,.table-sm td{padding:.3rem}.table-striped tbody tr:nth-of-type(odd){background-color:rgba(0,0,0,.05)}.table-hover tbody tr:hover{background-color:rgba(0,0,0,.075)}@media (max-width:991px){.table-responsive{display:block;width:100%;overflow-x:auto;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive.table-bordered{border:0}}.btn{display:inline-block;font-weight:400;text-align:center;white-space:nowrap;vertical-align:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;border:1px solid transparent;padding:.5rem .75rem;font-size:1rem;line-height:1.25;border-radius:.25rem;transition:all 0.15s ease-in-out}.btn:focus,.btn:hover{text-decoration:none}.btn:focus,.btn.focus{outline:0;box-shadow:0 0 0 3px rgba(0,123,255,.25)}.btn-primary{color:#fff;background-color:#007bff;border-color:#007bff}.btn-primary:hover{color:#fff;background-color:#0069d9;border-color:#0062cc}.btn-primary:focus,.btn-primary.focus{box-shadow:0 0 0 3px rgba(0,123,255,.5)}.btn-primary.disabled,.btn-primary:disabled{background-color:#007bff;border-color:#007bff}.btn-primary:active,.btn-primary.active,.show>.btn-primary.dropdown-toggle{background-color:#0069d9;background-image:none;border-color:#0062cc}.card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}.card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}.card-title{margin-bottom:.75rem}.card-text:last-child{margin-bottom:0}.card-header{padding:.75rem 1.25rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:1px solid rgba(0,0,0,.125)}.card-header:first-child{border-radius:calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0}.bg-primary{background-color:#007bff!important}a.bg-primary:focus,a.bg-primary:hover{background-color:#0062cc!important}.bg-secondary{background-color:#868e96!important}a.bg-secondary:focus,a.bg-secondary:hover{background-color:#6c757d!important}.bg-light{background-color:#f8f9fa!important}a.bg-light:focus,a.bg-light:hover{background-color:#dae0e5!important}.bg-transparent{background-color:transparent!important}.border{border:1px solid #e9ecef!important}.border-top-0{border-top:0!important}.border-right-0{border-right:0!important}.border-bottom-0{border-bottom:0!important}.border-left-0{border-left:0!important}.border-secondary{border-color:#868e96!important}.border-light{border-color:#f8f9fa!important}.justify-content-center{-ms-flex-pack:center!important;justify-content:center!important}.w-25{width:25%!important}.w-50{width:50%!important}.m-3{margin:1rem!important}.mt-3{margin-top:1rem!important}.mr-3{margin-right:1rem!important}.mb-3{margin-bottom:1rem!important}.ml-3{margin-left:1rem!important}.mx-3{margin-right:1rem!important;margin-left:1rem!important}.my-3{margin-top:1rem!important;margin-bottom:1rem!important}.m-4{margin:1.5rem!important}.mt-4{margin-top:1.5rem!important}.mr-4{margin-right:1.5rem!important}.mb-4{margin-bottom:1.5rem!important}.ml-4{margin-left:1.5rem!important}.mx-4{margin-right:1.5rem!important;margin-left:1.5rem!important}.my-4{margin-top:1.5rem!important;margin-bottom:1.5rem!important}.m-5{margin:3rem!important}.mt-5{margin-top:3rem!important}.mr-5{margin-right:3rem!important}.mb-5{margin-bottom:3rem!important}.ml-5{margin-left:3rem!important}.mx-5{margin-right:3rem!important;margin-left:3rem!important}.my-5{margin-top:3rem!important;margin-bottom:3rem!important}.p-3{padding:1rem!important}.pt-3{padding-top:1rem!important}.pr-3{padding-right:1rem!important}.pb-3{padding-bottom:1rem!important}.pl-3{padding-left:1rem!important}.px-3{padding-right:1rem!important;padding-left:1rem!important}.py-3{padding-top:1rem!important;padding-bottom:1rem!important}.p-4{padding:1.5rem!important}.pt-4{padding-top:1.5rem!important}.pr-4{padding-right:1.5rem!important}.pb-4{padding-bottom:1.5rem!important}.pl-4{padding-left:1.5rem!important}.px-4{padding-right:1.5rem!important;padding-left:1.5rem!important}.py-4{padding-top:1.5rem!important;padding-bottom:1.5rem!important}.p-5{padding:3rem!important}.pt-5{padding-top:3rem!important}.pr-5{padding-right:3rem!important}.pb-5{padding-bottom:3rem!important}.pl-5{padding-left:3rem!important}.px-5{padding-right:3rem!important;padding-left:3rem!important}.py-5{padding-top:3rem!important;padding-bottom:3rem!important}.text-justify{text-align:justify!important}.text-left{text-align:left!important}.text-right{text-align:right!important}.text-center{text-align:center!important}.font-weight-bold{font-weight:700}.text-secondary{color:#868e96!important}a.text-secondary:focus,a.text-secondary:hover{color:#6c757d!important}.text-muted{color:#868e96!important}a{text-decoration:none}
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row justify-content-center p-3">
      <div class="col-12">
        <h2>Invoice Pembayaran #'.$data_order[kd_order].'</h2>
        <hr>
        <p>Hai '.$data_user[nama_lengkap].',</br>
        Terima kasih atas kepercayaanmu telah berbelanja di '.$nama_web.' . Mohon segera lakukan pembayaran sebelum:</p>
        <h4 class="text-center bg-light p-3 border border-gray">'.$tgl_kadaluarsa.'</h4>
        <br>
        <p>Berikut adalah penjelasan tagihan pembayaran:</p>
          <div class="card" style="border-radius: 0">
            <div class="card-body">
              <table class="table">
                <tr>
                  <td class="font-weight-bold">Waktu Transaksi</td>
                  <td>'.date("d F Y H:i", strtotime($data_order[tgl_order])).'</td>
                </tr>
                <tr>
                  <td class="font-weight-bold">Pembeli</td>
                  <td>'.$data_user[nama_lengkap].'</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="card border-top-0 mt-3" style="border-top-right-radius: 0px;border-top-left-radius: 0px;">
            <div class="card-body" style="margin:0;padding: 0">
              <table class="table table-bordered">
                <thead class="bg-light">
                  <tr>
                    <th width="100px">Nama Produk</th>
                    <th class="text-right">Harga Produk</th>
                    <th class="text-center">Kuantitas</th>
                    <th class="text-right" width="100px">Total Harga</th>
                  </tr>
                </thead>
                <tbody>
                  '.$isi_pesanan.'
                </tbody>
              </table>
              <table class="table" style="margin-bottom: 0">
                <tbody>
                  <tr>
                    <td width="400px;" class="text-center">Sub Total</td>
                    <td class="font-weight-bold text-right" colspan="2">Rp.'.number_format($subtotal).'</td>
                  </tr>
                  <tr>
                    <td width="400px;" >Kode Pembayaran <font class="text-muted" style="font-size: 10px;">(Hanya dibebankan kepada pembeli)</font</td>
                    <td class="font-weight-bold text-right" colspan="2">Rp.'.$kode_pemabayaran.'</td>
                  </tr>
                </tbody>
                <tfoot class="bg-light">
                  <tr>
                    <td width="400px;" class="font-weight-bold">TOTAL PEMBAYARAN</td>
                    <td class="font-weight-bold text-right text-white bg-primary" colspan="2">Rp. '.number_format($data_order[total]).'</td>
                  </tr>   
                </tfoot>
              </table>
            </div>
          </div>
          <p class="mt-4">
            <font class="font-weight-bold">Alamat tujuan pengiriman</font><br>
            '.$data_order[nama_pengiriman].'<br>
            '.$data_order[alamat_pengiriman].'<br>
            No. Telp: '.$data_order[no_telp].'
          </p>
          <p class="text-muted mt-5 mb-4">
            Copyright © 2017 BengkelIkan.com. All Rights Reserved<br>
            Gedung Jurusan TI Politeknik Negeri Jember Jl. Mastrip PO.BOX 164 <br>
            Jember Jawa Timur 68101 Indonesia
          </p>
          
          <p style="border-bottom: 3px solid #ddd"></p>
      </div>
    </div>
  </div>
</body>
</html>
';

echo $msg;
?>
<meta http-equiv="refresh" content="0; url=<?php echo $base_url ?>/user/detail-pesanan=<?php echo $data_order[kd_order] ?>/<?php echo $_SESSION[loginuser] ?>">