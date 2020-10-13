<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Data Kategori</div>
  <div class="card-body">
    <div class="row my-3">
      <div class="col-lg-3">
        <a href="<?php echo $base_url ?>/dashboard/kategori/tambah" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah</a>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-light">
          <tr>
            <th>No</th>
            <th>Kategori Utama</th>
            <th>Kategori</th>
            <th width="115px">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $sql_kategori_utama=mysqli_query($conn, "SELECT * FROM kategori_utama left join kategori on kategori.kd_kategori_utama=kategori_utama.kd_kategori_utama GROUP BY kategori_utama.kd_kategori_utama order by kd_kategori DESC");
            while($data_kategori_utama=mysqli_fetch_assoc($sql_kategori_utama)){
               $sql_kategori=mysqli_query($conn, "SELECT * FROM kategori where kd_kategori_utama='$data_kategori_utama[kd_kategori_utama]'");
          ?>
          <tr>
            <th rowspan="<?php echo mysqli_num_rows($sql_kategori) ?>" scope="row"><?php echo ++$no ?></th>
            <td rowspan="<?php echo mysqli_num_rows($sql_kategori) ?>" class="font-weight-bold"><?php echo ucwords($data_kategori_utama[nama_kategori_utama]) ?></td>
            <?php while($data_kategori=mysqli_fetch_assoc($sql_kategori)){ ?>
            <td><?php echo ucwords($data_kategori[nama_kategori]) ?></td>
            <td>
              <a class="btn btn-warning" href="<?php echo $base_url ?>/dashboard/kategori/edit/id=<?php echo $data_kategori[kd_kategori] ?>" role="button"><span class="fa fa-edit ptooltip" data-toggle="tooltip" data-placement="top" title="Edit"></span></a>
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
                    <div class="modal-body">Pilih ya untuk menghapus data kategori <strong><?php echo $data_kategori[nama_kategori]; ?></strong> dengan kategori utama <strong><?php echo $data_kategori_utama[nama_kategori_utama]; ?></strong></div>
                    <div class="modal-footer">
                      <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/kategori/crud.php?id=<?php echo $data_kategori[kd_kategori] ?>">Ya</a>
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