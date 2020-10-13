<?php
  $sql_orders=mysqli_query($conn, "SELECT * FROM orders left join user on user.kd_user=orders.kd_user WHERE kd_order='$_GET[id]'");
  $data_orders=mysqli_fetch_assoc($sql_orders);
  $tgl_sekarang=time();
  $tgl_order_berakhir=strtotime('+12 hours', strtotime($data_orders[tgl_order]));  
?>

<div class="col-lg-12 bg-white">
  <table cellpadding="10">
    <tr class="font-weight-bold">
      <td valign="top">NO. INVOICE</td>
      <td valign="top">:</td>
      <td valign="top"><?php echo $data_orders[kd_order]; ?></td>
    </tr>
    <tr>
      <td valign="top">PEMBELI</td>
      <td valign="top">:</td>
      <td valign="top"><?php echo $data_orders[nama_lengkap]; ?></td>
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
  <p>Rincian Pesanan :</p>
  <div class="table-responsive">
    <table class="table table-bordered" cellspacing="0">
      <thead class="bg-light">
        <tr>
          <th>No.</th>
          <th width="130">Kode Barang</th>
          <th colspan="2">Nama Barang</th>
          <th class="text-right">Harga</th>
          <th class="text-center" width="80">Kuantitas</th>
          <th class="text-right">Total Harga</th>
          <th class="text-center" width="80">Status</th>
          <?php if ($data_user[level_user]=="seller") { ?>
            <?php if ($data_orders[status_pembayaran]=="n" and $tgl_sekarang>$tgl_order_berakhir) { }elseif ($data_orders[status_pembayaran]=="n" and $tgl_sekarang<$tgl_order_berakhir) { }else{ ?>
            <th class="text-center">Action</th>
            <?php } ?>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php
          if ($data_user[level_user]=="seller") {
            $sql_detail_orders=mysqli_query($conn, "SELECT * FROM detail_order left join barang on barang.kd_barang=detail_order.kd_barang left join user on user.kd_user=barang.kd_user WHERE kd_order='$_GET[id]' and barang.kd_user='$_SESSION[loginadmin]'");
          }else{
            $sql_detail_orders=mysqli_query($conn, "SELECT * FROM detail_order left join barang on barang.kd_barang=detail_order.kd_barang left join user on user.kd_user=barang.kd_user WHERE kd_order='$_GET[id]'");
          }
          while($data_detail_orders=mysqli_fetch_assoc($sql_detail_orders)){
            $subtotal+=$data_detail_orders[total_harga];
        ?>
        <tr>
          <td><?php echo ++$no; ?>.</td>
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
          <?php if ($data_user[level_user]=="seller") { ?>
            <?php if ($data_orders[status_pembayaran]=="n" and $tgl_sekarang>$tgl_order_berakhir) { }elseif ($data_orders[status_pembayaran]=="n" and $tgl_sekarang<$tgl_order_berakhir) { }else{ ?>
            <td class="align-middle text-center">
              <?php if ($data_detail_orders[status]=="pt") { ?>
                <a class="btn btn-success" data-toggle="modal"  href="#validmodal<?php echo ++$counter1 ?>" role="button"><span class="fa fa-check-square-o ptooltip" data-toggle="tooltip" data-placement="top" title="Terima Pesanan"></span></a>
                <a class="btn btn-danger" data-toggle="modal"  href="#invalidmodal<?php echo ++$counter ?>" role="button"><span class="fa fa-ban ptooltip" data-toggle="tooltip" data-placement="top" title="Batalkan Pesanan"></span></a>
              <?php }elseif($data_detail_orders[status]=="p"){ ?>
                <a class="btn btn-success" data-toggle="modal"  href="#kirimmodal<?php echo ++$counter3 ?>" role="button"><span class="fa fa-truck ptooltip" data-toggle="tooltip" data-placement="top" title="Kirim Pesanan"></span></a>
              <?php } ?>
            </td>
            <?php } ?>
          <?php } ?>
          <!-- MODAL TERIMA -->
              <div class="modal fade" id="validmodal<?php echo $counter1 ?>" tabindex="-1" role="dialog" aria-labelledby="validmodallabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="hapusmodallabel">Yakin akan mengganti status pesanan menjadi <strong>Sedang diproses</strong> ?</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">Pilih ya untuk menyatakan bahwa status pesanan dengan kode order <strong>#<?php echo $data_detail_orders[kd_order]; ?></strong> dan nama barang <strong><?php echo ucwords($data_detail_orders[nama_barang]); ?></strong> Sedang diproses</div>
                    <div class="modal-footer">
                      <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/pesanan/pesanan.php?s=1&kdorder=<?php echo $data_detail_orders[kd_order] ?>&kdbarang=<?php echo $data_detail_orders[kd_barang] ?>">Ya</a>
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- MODAL BATALKAN -->
              <div class="modal fade" id="invalidmodal<?php echo $counter ?>" tabindex="-1" role="dialog" aria-labelledby="invalidmodallabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="hapusmodallabel">Yakin akan mengganti status pesanan menjadi <strong>dibatalkan</strong> ?</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">Pilih ya untuk menyatakan bahwa status pesanan dengan kode order <strong>#<?php echo $data_detail_orders[kd_order]; ?></strong> dan nama barang <strong><?php echo ucwords($data_detail_orders[nama_barang]); ?></strong> dibatalkan</div>
                    <div class="modal-footer">
                      <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/pesanan/pesanan.php?s=2&kdorder=<?php echo $data_detail_orders[kd_order] ?>&kdbarang=<?php echo $data_detail_orders[kd_barang] ?>">Ya</a>
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- MODAL KIRIM -->
              <div class="modal fade" id="kirimmodal<?php echo $counter3 ?>" tabindex="-1" role="dialog" aria-labelledby="kirimmodallabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="kirimmodalllabel">Yakin akan mengganti status pesanan menjadi <strong>Telah dikirim</strong> ?</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">Pilih ya untuk menyatakan bahwa status pesanan dengan kode order <strong>#<?php echo $data_detail_orders[kd_order]; ?></strong> dan nama barang <strong><?php echo ucwords($data_detail_orders[nama_barang]); ?></strong> Telah dikirim</div>
                    <div class="modal-footer">
                      <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/pesanan/pesanan.php?s=3&kdorder=<?php echo $data_detail_orders[kd_order] ?>&kdbarang=<?php echo $data_detail_orders[kd_barang] ?>">Ya</a>
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
          <td colspan="6" class="text-center font-weight-bold">SUB TOTAL : </td>
          <td class="text-right font-weight-bold">Rp. <?php echo number_format($subtotal); ?></td>
        </tr>
      </tfoot>
    </table>
  </div>     
</div>