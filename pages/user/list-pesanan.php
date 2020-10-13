<?php
  if (!$_SESSION[loginuser]) {
    ?>
      <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/masuk">  
    <?php 
  }
?>
<h3 class="my-3">Pesanan Saya</h3>
<?php 
  $sql_pesanan=mysqli_query($conn, "SELECT kd_order, tgl_order,status_pembayaran FROM orders WHERE kd_user='$_SESSION[loginuser]' order by tgl_order DESC");
if (mysqli_num_rows($sql_pesanan)==0) {
?>
<div class="row mb-5 justify-content-center">
  <div class="col-lg-8 text-center alert alert-danger">
    Pesanan Anda Kosong </br>Ingin Belanja sesuatu<a href="<?php echo $base_url ?>/jual-beli" class="alert-link"> Klik disini.</a>
  </div>
</div>
<?php }else{ ?>
<div id="accordion" role="tablist">
  <?php while ($data_pesanan=mysqli_fetch_assoc($sql_pesanan)) { ?>
  <?php ++$counter; ?>
  <div class="card mb-3">
    <div class="card-header bg-light" role="tab" id="heading<?php echo $counter ?>">
      <div class="row align-items-center">
        <div class="col-1">
          <h5 class="mb-0">
            <a data-toggle="collapse" href="#collapse<?php echo $counter ?>" aria-expanded="true" aria-controls="collapse<?php echo $counter ?>"><span class="fa fa-bars"></span></a>
          </h5>
        </div>
        <div class="col-8">
          Pesanan <a href="" class="card-link">#<?php echo $data_pesanan[kd_order]; ?></a></br>
          Di pesan pada : <?php echo date("d/m/Y", strtotime($data_pesanan[tgl_order])); ?>
        </div>
        <div class="col-3">
          <a href="<?php echo $base_url ?>/user/detail-pesanan=<?php echo $data_pesanan[kd_order] ?>/<?php echo $_GET[kd_user] ?>" class="card-link">DETAIL PESANAN</a>
        </div>
      </div>
    </div>
    <div id="collapse<?php echo $counter ?>" class="collapse <?php if($counter==1){echo"show";} ?>" role="tabpanel" aria-labelledby="heading<?php echo $counter ?>" data-parent="#accordion">
      <div class="card-body">
        <?php 
          $sql_barang_pesanan=mysqli_query($conn, "SELECT * FROM detail_order left join barang on barang.kd_barang=detail_order.kd_barang WHERE kd_order='$data_pesanan[kd_order]'");
          while($data_barang_pesanan=mysqli_fetch_assoc($sql_barang_pesanan)){
        ?>
        <div class="media">
          <img class="mr-3 img-fluid img-thumbnail w-25" src="<?php echo $base_url ?>/assets/images/barang/<?php echo $data_barang_pesanan[gambar_barang] ?>" alt="Generic placeholder image">
          <div class="media-body">
            <a href="" class="btn-link"><h5 class="mt-0"><?php echo ucwords($data_barang_pesanan[nama_barang]); ?></h5></a>
            <h5>
            <?php
              $tgl_sekarang=time();
              $tgl_order_berakhir=strtotime('+12 hours', strtotime($data_pesanan[tgl_order]));  
              if ($data_pesanan[status_pembayaran]=="n" and $tgl_sekarang>$tgl_order_berakhir) {
                echo "<span class='badge badge-danger'>Dibatalkan</span>";
              }elseif ($data_pesanan[status_pembayaran]=="n" and $tgl_sekarang<$tgl_order_berakhir) {
                echo "<span class='badge badge-warning'>Menunggu Konfirmasi</span>";
              }else{
                if ($data_barang_pesanan[status]=="p") {
                  echo "<span class='badge badge-info p-2'>Sedang diproses</span>";
                }elseif ($data_barang_pesanan[status]=="d") {
                  echo "<span class='badge badge-primary p-2'>Telah dikirim</span>";
                }elseif ($data_barang_pesanan[status]=="t") {
                  echo "<span class='badge badge-success p-2'>Telah diterima</span>";
                }elseif ($data_barang_pesanan[status]=="b") {
                  echo "<span class='badge badge-danger p-2'>Dibatalkan</span>";
                }elseif($data_barang_pesanan[status]=="pt") {
                  echo "<span class='badge badge-warning p-2'>Perlu Tindakan Seller</span>";
                }
              }
            ?>
            </h5>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
<?php } ?>