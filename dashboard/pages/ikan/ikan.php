<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Data Ikan</div>
  <div class="card-body">
    <div class="row my-3">
      <div class="col-lg-3">
        <a href="<?php echo $base_url ?>/dashboard/ikan/tambah" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah</a>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-light">
          <tr>
            <th>No</th>
            <th>Jenis Ikan</th>
            <th>Nama Ikan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $sql_jenis_ikan=mysqli_query($conn, "SELECT * FROM ikan left join jenis_ikan on jenis_ikan.kd_jenis_ikan=ikan.kd_jenis_ikan GROUP BY jenis_ikan.kd_jenis_ikan order by kd_ikan DESC");
            while($data_jenis_ikan=mysqli_fetch_assoc($sql_jenis_ikan)){
               $sql_ikan=mysqli_query($conn, "SELECT * FROM ikan where kd_jenis_ikan='$data_jenis_ikan[kd_jenis_ikan]'");
          ?>
          <tr>
            <th rowspan="<?php echo mysqli_num_rows($sql_ikan) ?>" scope="row"><?php echo ++$no ?></th>
            <td rowspan="<?php echo mysqli_num_rows($sql_ikan) ?>" class="font-weight-bold"><?php echo ucwords($data_jenis_ikan[jenis_ikan]) ?></td>
            <?php while($data_ikan=mysqli_fetch_assoc($sql_ikan)){ ?>
            <td><?php echo ucwords($data_ikan[nama_ikan]) ?></td>
            <td>
              <a class="btn btn-warning" href="<?php echo $base_url ?>/dashboard/ikan/edit/id=<?php echo $data_ikan[kd_ikan] ?>" role="button"><span class="fa fa-edit ptooltip" data-toggle="tooltip" data-placement="top" title="Edit"></span></a>
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
                    <div class="modal-body">Pilih ya untuk menghapus data Ikan <strong><?php echo $data_ikan[nama_ikan]; ?></strong> dengan jenis ikan <strong><?php echo $data_jenis_ikan[jenis_ikan]; ?></strong></div>
                    <div class="modal-footer">
                      <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/ikan/crud.php?id=<?php echo $data_ikan[kd_ikan] ?>">Ya</a>
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                    </div>
                  </div>
                </div>
              </div>
          </tr> 
          <?php } } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>