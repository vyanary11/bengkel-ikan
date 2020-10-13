<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Data Pesanan</div>
  <div class="card-body">
    <div class="table-responsive" style="font-size: 14px">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-light">
          <tr>
            <th>No.</th>
            <th>No. Pesanan</th>
            <th>Pembeli</th>
            <th>Nama Pengiriman</th>
            <th>Tanggal Pesanan</th>
            <th>Total Harga</th>
            <th>Status Pembayaran</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql_detail_orders=mysqli_query($conn, "SELECT kd_order FROM detail_order left join barang on barang.kd_barang=detail_order.kd_barang left join user on user.kd_user=barang.kd_user WHERE barang.kd_user='$_SESSION[loginadmin]' GROUP BY kd_order order by kd_order desc"); 
            while($data_detail_orders=mysqli_fetch_assoc($sql_detail_orders)){
              $sql_orders=mysqli_query($conn, "SELECT nama_lengkap,nama_pengiriman,tgl_order,total,status_pembayaran FROM orders left join user on user.kd_user=orders.kd_user where kd_order='$data_detail_orders[kd_order]'");
              $data_orders=mysqli_fetch_assoc($sql_orders);
          ?>
          <tr>
            <td><?php echo ++$no; ?></td>
            <td class="align-middle">#<?php echo $data_detail_orders[kd_order] ?></td>
            <td class="align-middle"><?php echo ucwords($data_orders[nama_lengkap]); ?></td>
            <td class="align-middle"><?php echo ucwords($data_orders[nama_pengiriman]); ?></td>
            <td class="align-middle"><?php echo date("d F Y H:i",strtotime($data_orders[tgl_order])); ?></td>
            <td class="align-middle">Rp. <?php echo number_format($data_orders[total]); ?></td>
            <td class="align-middle text-center">
              <?php
                $tgl_sekarang=time();
                $tgl_order_berakhir=strtotime('+12 hours', strtotime($data_orders[tgl_order]));  
                if ($data_orders[status_pembayaran]=="n" and $tgl_sekarang>$tgl_order_berakhir) {
                  echo "<span class='badge badge-danger'>dibatalkan</span>";
                }elseif ($data_orders[status_pembayaran]=="n" and $tgl_sekarang<$tgl_order_berakhir) {
                  echo "<span class='badge badge-info'>Menunggu Konfirmasi</span>";
                }else{
                  echo "<span class='badge badge-success'>Pembayaran Sukses</span>";
                }
              ?>
            </td>
            <td class="align-middle text-center">
              <a class="btn btn-info" href="<?php echo $base_url ?>/dashboard/pesanan/detail-pesanan/id=<?php echo $data_detail_orders[kd_order] ?>" role="button"><span class="fa fa-eye ptooltip" data-toggle="tooltip" data-placement="top" title="Detail"></span></a>
            </td>
            <div class="modal fade" id="hapusmodal<?php echo $counter ?>" tabindex="-1" role="dialog" aria-labelledby="hapusmodallabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="hapusmodallabel">Yakin Ingin Menghapus ?</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">Pilih ya untuk menghapus data Pesanan <strong><?php echo $data_orders[orders]; ?></strong></div>
                    <div class="modal-footer">
                      <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/jenis-ikan/crud.php?id=<?php echo $data_orders[kd_orders] ?>">Ya</a>
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                    </div>
                  </div>
                </div>
              </div>
          </tr> 
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>