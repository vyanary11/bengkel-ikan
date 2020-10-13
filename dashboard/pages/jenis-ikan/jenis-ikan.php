<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Data Jenis Ikan</div>
  <div class="card-body">
    <div class="row my-3">
      <div class="col-lg-3">
        <a href="<?php echo $base_url ?>/dashboard/jenis-ikan/tambah" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah</a>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-light">
          <tr>
            <th>No</th>
            <th>Jenis Ikan</th>
            <th width="115px">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $sql_jenis_ikan=mysqli_query($conn, "SELECT * FROM jenis_ikan order by kd_jenis_ikan DESC");
            while($data_jenis_ikan=mysqli_fetch_assoc($sql_jenis_ikan)){
          ?>
          <tr>
            <th scope="row"><?php echo ++$no ?></th>
            <td ><?php echo ucwords($data_jenis_ikan[jenis_ikan]) ?></td>
            <td>
              <a class="btn btn-warning" href="<?php echo $base_url ?>/dashboard/jenis-ikan/edit/id=<?php echo $data_jenis_ikan[kd_jenis_ikan] ?>" role="button"><span class="fa fa-edit ptooltip" data-toggle="tooltip" data-placement="top" title="Edit"></span></a>
              <a class="btn btn-danger" data-toggle="modal"  href="#hapusmodal<?php echo ++$counter ?>" role="button"><span class="fa fa-trash ptooltip" data-toggle="tooltip" data-placement="top" title="Hapus"></span></a>
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
                    <div class="modal-body">Pilih ya untuk menghapus data Jenis ikan <strong><?php echo $data_jenis_ikan[jenis_ikan]; ?></strong></div>
                    <div class="modal-footer">
                      <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/jenis-ikan/crud.php?id=<?php echo $data_jenis_ikan[kd_jenis_ikan] ?>">Ya</a>
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