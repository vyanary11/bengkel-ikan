<?php if($data_user[level_user]=="seller"){ ?>
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-archive"></i>
        </div>
        <div class="mr-5"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM barang where kd_user='$_SESSION[loginadmin]'")); ?> Barang diplubikasikan!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo $base_url ?>/dashboard/barang">
        <span class="float-left">Lihat</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-tasks"></i>
        </div>
        <div class="mr-5"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT kd_order FROM detail_order left join barang on barang.kd_barang=detail_order.kd_barang left join user on user.kd_user=barang.kd_user WHERE barang.kd_user='$_SESSION[loginadmin]' and detail_order.status='p' ")); ?> Pesanan Sedang diproses!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo $base_url ?>/dashboard/pesanan">
        <span class="float-left">Lihat</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-handshake-o"></i>
        </div>
        <div class="mr-5"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM detail_order left join barang on barang.kd_barang=detail_order.kd_barang left join user on user.kd_user=barang.kd_user WHERE barang.kd_user='$_SESSION[loginadmin]' and detail_order.status='t'")); ?> Pesanan Telah diterima!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo $base_url ?>/dashboard/pesanan">
        <span class="float-left">Lihat</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-truck"></i>
        </div>
        <div class="mr-5"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM detail_order left join barang on barang.kd_barang=detail_order.kd_barang left join user on user.kd_user=barang.kd_user WHERE barang.kd_user='$_SESSION[loginadmin]' and detail_order.status='d'")); ?> Pesanan Telah dikirim!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo $base_url ?>/dashboard/pesanan">
        <span class="float-left">Lihat</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
</div>
<div class="row justify-content-center">
  <div class="col-lg-9 text-center mt-lg-5 mt-md-3">
    <h2>Wellcome <?php echo ucwords($data_user[level_user]); ?></h2>
  </div>
</div>
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
<?php }else{ ?>
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-newspaper-o"></i>
        </div>
        <div class="mr-5"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM berita")); ?> Berita dipublikasi!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo $base_url ?>/dashboard/berita">
        <span class="float-left">Lihat</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-users"></i>
        </div>
        <div class="mr-5"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user where level_user='seller'")); ?> Seller mendaftar!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo $base_url ?>/dashboard/user">
        <span class="float-left">Lihat</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-user"></i>
        </div>
        <div class="mr-5"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user where level_user='user'")); ?> User mendaftar!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo $base_url ?>/dashboard/user">
        <span class="float-left">Lihat</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-check-square-o"></i>
        </div>
        <div class="mr-5"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM konfirmasi_order where status='perlu validasi'")); ?> Konfirmasi perlu validasi!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo $base_url ?>/dashboard/konfirmasi">
        <span class="float-left">Lihat</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
</div>
<div class="row justify-content-center">
  <div class="col-lg-9 text-center mt-lg-5 mt-md-3">
    <h2>Wellcome <?php echo ucwords($data_user[level_user]); ?></h2>
  </div>
</div>
<div class="card my-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Konfirmasi Pembayaran Terbaru</div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-light">
          <tr style="font-size: 11.5px">
            <th>No.</th>
            <th>Kode Order</th>
            <th>Bank</th>
            <th>Atas Nama</th>
            <th>Jumlah Transfer</th>
            <th>Tanggal Transfer</th>
            <th width="80px">Bukti Transfer</th>
            <th>Status Konfirmasi</th>
            <th width="115px">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $sql_konfirmasi=mysqli_query($conn, "SELECT * FROM konfirmasi_order order by kd_konfirmasi desc ");
            while($data_konfirmasi=mysqli_fetch_assoc($sql_konfirmasi)){
          ?>
          <tr style="font-size: 11.5px">
            <th scope="row"><?php echo ++$no ?>.</th>
            <td>#<?php echo $data_konfirmasi[kd_order] ?></td>
            <td><?php echo $data_konfirmasi[bank] ?></td>
            <td><?php echo ucwords($data_konfirmasi[nama]); ?></td>
            <td>Rp. <?php echo number_format($data_konfirmasi[jumlah_transfer]); ?></td>
            <td><?php echo date("d F Y", strtotime($data_konfirmasi[tgl_transfer]))."<br>Pukul ".date("H:i", strtotime($data_konfirmasi[tgl_transfer])); ?> WIB</td>
            <td>
              <a  data-toggle="modal"  href="#gambarmodal<?php echo ++$counter2 ?>" role="button">
                <img class="img-fluid" src="<?php echo $base_url ?>/assets/images/bukti/<?php echo $data_konfirmasi[bukti_transfer] ?>" >
              </a>
            </td>
            <td>
              <?php 
                if ($data_konfirmasi[status]=="valid") {
                  echo "<span class='badge badge-success p-2'>".ucwords($data_konfirmasi[status])."</span>";
                }elseif ($data_konfirmasi[status]=="invalid") {
                  echo "<span class='badge badge-danger p-2'>".ucwords($data_konfirmasi[status])."</span>";
                }else{
                  echo "<span class='badge badge-info p-2'>".ucwords($data_konfirmasi[status])."</span>";
                }
              ?>
            </td>
            <td>
              <?php if ($data_konfirmasi[status]=="perlu validasi") { ?>
              <a class="btn btn-success" data-toggle="modal"  href="#validmodal<?php echo ++$counter1 ?>" role="button"><span class="fa fa-check-square-o ptooltip" data-toggle="tooltip" data-placement="top" title="Valid"></span></a>
              <a class="btn btn-danger" data-toggle="modal"  href="#invalidmodal<?php echo ++$counter ?>" role="button"><span class="fa fa-ban ptooltip" data-toggle="tooltip" data-placement="top" title="Invalid"></span></a>
              <?php } ?>
              <a class="btn btn-info" href="<?php echo $base_url ?>/dashboard/pesanan/detail-pesanan/id=<?php echo $data_konfirmasi[kd_order] ?>" role="button"><span class="fa fa-eye ptooltip" data-toggle="tooltip" data-placement="top" title="Lihat"></span></a>
            </td>
          </tr> 
            <!-- MODAL VALID -->
            <div class="modal fade" id="validmodal<?php echo $counter1 ?>" tabindex="-1" role="dialog" aria-labelledby="validmodallabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="hapusmodallabel">Yakin Konfirmasi ini Valid ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">Pilih ya untuk memvalidasi pembayaran pesanan dengan kode order <strong>#<?php echo $data_konfirmasi[kd_order]; ?></strong></div>
                  <div class="modal-footer">
                    <a class="btn btn-success" href="<?php echo $base_url; ?>/dashboard/bin/konfirmasi.php?s=1&id=<?php echo $data_konfirmasi[kd_konfirmasi] ?>">Ya</a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- MODAL INVALID -->
            <div class="modal fade" id="invalidmodal<?php echo $counter ?>" tabindex="-1" role="dialog" aria-labelledby="invalidmodallabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="hapusmodallabel">Yakin Konfirmasi ini tidak valid ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">Pilih ya untuk menyatakan bahwa pembayaran pesanan dengan kode order <strong>#<?php echo $data_konfirmasi[kd_order]; ?></strong> tidak valid</div>
                  <div class="modal-footer">
                    <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/konfirmasi.php?s=2&id=<?php echo $data_konfirmasi[kd_konfirmasi] ?>">Ya</a>
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
                    <img src="<?php echo $base_url ?>/assets/images/bukti/<?php echo $data_konfirmasi[bukti_transfer] ?>" class="img-fluid w-100">
                  </div>
                </div>
              </div>
            </div>
          <?php }  ?>
        </tbody>
      </table>
    </div>
  </div>
</div>    
<?php } ?>