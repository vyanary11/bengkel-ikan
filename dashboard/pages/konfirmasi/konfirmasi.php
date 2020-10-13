<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Data Konfirmasi Pembayaran</div>
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
            $sql_konfirmasi=mysqli_query($conn, "SELECT * FROM konfirmasi_order order by kd_konfirmasi desc");
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