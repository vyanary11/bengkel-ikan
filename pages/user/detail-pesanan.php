<?php 
	if (!$_SESSION[loginuser]) {
		?>
		    <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/masuk">  
		<?php 
	}
?>
<?php
  $sql_orders=mysqli_query($conn, "SELECT * FROM orders left join user on user.kd_user=orders.kd_user WHERE kd_order='$_GET[id]'");
  $data_orders=mysqli_fetch_assoc($sql_orders);
?>
<h3>Detail Pesanan</h3>
<table cellpadding="10">
  <tr class="font-weight-bold">
    <td valign="top">NO. INVOICE</td>
    <td valign="top">:</td>
    <td valign="top"><?php echo $data_orders[kd_order]; ?></td>
  </tr>
  <tr>
    <td valign="top">TANGGAL TRANSAKSI</td>
    <td valign="top">:</td>
    <td valign="top"><?php echo date("d F Y H:i", strtotime($data_orders[tgl_order])); ?></td>
  </tr>
  <tr>
    <td valign="top">ALAMAT PENGIRIMAN</td>
    <td valign="top">:</td>
    <td valign="top">
      <b><?php echo $data_orders[nama_pengiriman]; ?></b><br>
      <?php echo $data_orders[alamat_pengiriman]; ?><br>
      No Telp : <?php echo $data_orders[no_telp]; ?>
    </td>
  </tr>
</table>
<div class="table-responsive">
  <table class="table table-bordered" cellspacing="0" style="font-size: 12px">
    <thead class="bg-light">
      <tr>
        <th width="100">Kode Barang</th>
        <th colspan="2">Nama Barang</th>
        <th class="text-right">Harga</th>
        <th class="text-center" width="80">Kuantitas</th>
        <th class="text-right">Total Harga</th>
        <th class="text-center" width="80">Status</th>
        <?php if($data_orders[status_pembayaran]=="y"){ ?>
        <th class="text-center">Action</th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql_detail_orders=mysqli_query($conn, "SELECT * FROM detail_order left join barang on barang.kd_barang=detail_order.kd_barang left join user on user.kd_user=barang.kd_user WHERE kd_order='$_GET[id]'"); 
        while($data_detail_orders=mysqli_fetch_assoc($sql_detail_orders)){
          $subtotal+=$data_detail_orders[harga];
      ?>
      <tr>
        <td class="align-middle"><?php echo ucwords($data_detail_orders[kd_barang]); ?></td>
        <td class="align-middle border-right-0" width="80px">
          <a  data-toggle="modal"  href="#gambarmodal<?php echo ++$counter2 ?>" role="button">
            <img class="img-fluid" src="<?php echo $base_url ?>/assets/images/barang/<?php echo $data_detail_orders[gambar_barang] ?>" >
          </a>
        </td>
        <td class="align-middle border-left-0"><?php echo ucwords($data_detail_orders[nama_barang]); ?></td>
        <td class="align-middle text-right">Rp. <?php echo number_format($data_detail_orders[harga]); ?></td>
        <td class="align-middle text-center"><?php echo $data_detail_orders[qty] ?></td>
        <td class="align-middle text-right">Rp. <?php echo number_format($data_detail_orders[total_harga]); ?></td>
        <td class="align-middle text-center">
         <?php
              $tgl_sekarang=time();
              $tgl_order_berakhir=strtotime('+12 hours', strtotime($data_orders[tgl_order]));  
              if ($data_orders[status_pembayaran]=="n" and $tgl_sekarang>$tgl_order_berakhir) {
                echo "<span class='badge badge-danger'>Dibatalkan</span>";
              }elseif ($data_orders[status_pembayaran]=="n" and $tgl_sekarang<$tgl_order_berakhir) {
                echo "<span class='badge badge-warning'>Menunggu Konfirmasi</span>";
              }else{
                if ($data_detail_orders[status]=="p") {
                  echo "<span class='badge badge-info p-2'>Sedang diproses</span>";
                }elseif ($data_detail_orders[status]=="d") {
                  echo "<span class='badge badge-primary p-2'>Telah dikirim</span>";
                }elseif ($data_detail_orders[status]=="t") {
                  echo "<span class='badge badge-success p-2'>Telah diterima</span>";
                }elseif ($data_detail_orders[status]=="b") {
                  echo "<span class='badge badge-danger p-2'>Dibatalkan</span>";
                }elseif($data_detail_orders[status]=="pt") {
                  echo "<span class='badge badge-warning p-2'>Perlu Tindakan</span>";
                }
              }
            ?>
        </td>
        <?php if($data_orders[status_pembayaran]=="y"){ ?>
        <td class="align-middle text-center">
        	<?php if($data_detail_orders[status]=="d"){ ?>
            <a class="btn btn-sm btn-primary" data-toggle="modal"  href="#terimamodal<?php echo ++$counter3 ?>" role="button">Terima Pesanan</a>
            <?php } ?>
        </td>
        <?php } ?>
            <!-- MODAL terima -->
            <div class="modal fade" id="terimamodal<?php echo $counter3 ?>" tabindex="-1" role="dialog" aria-labelledby="invalidmodallabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="hapusmodallabel">Yakin pesanan anda <strong>Telah diterima</strong> ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">Pilih ya untuk menyatakan bahwa pesanan dengan kode order <strong>#<?php echo $data_detail_orders[kd_order]; ?></strong> dan nama barang <strong><?php echo ucwords($data_detail_orders[nama_barang]); ?></strong> Telah diterima</div>
                  <div class="modal-footer">
                    <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/pesanan/pesanan.php?s=4&kdorder=<?php echo $data_detail_orders[kd_order] ?>&kdbarang=<?php echo $data_detail_orders[kd_barang] ?>">Ya</a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                  </div>
                </div>
              </div>
            </div>
          <!-- MODAL IMAGES -->
            <div class="modal fade" id="gambarmodal<?php echo $counter2 ?>" tabindex="-1" role="dialog" aria-labelledby="invalidmodallabel" aria-hidden="true">
              <div class="row justify-content-end m-4">
                <div class="col-lg-1 float-right">
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                  </button>
                </div>
              </div>
              <div class="modal-dialog" role="document">
                <div class="row justify-content-center">
                  <div class="col-lg-12 align-middle">
                    <img src="<?php echo $base_url ?>/assets/images/barang/<?php echo $data_detail_orders[gambar_barang] ?>" class="img-fluid w-100">
                  </div>
                </div>
              </div>
            </div>
      </tr> 
      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5" class="text-center align-middle font-weight-bold">SUB TOTAL : </td>
        <td class="text-right font-weight-bold align-middle" style="font-size: 24px">Rp. <?php echo number_format($subtotal); ?></td>
      </tr>
    </tfoot>
  </table>
</div>
<a href="<?php echo $base_url ?>/pages/cetak/cetak_invoice.php?id=<?php echo $_GET[id] ?>" class="mt-2 float-right btn btn-primary"><span class="fa fa-print"></span> Cetak Invoice</a>