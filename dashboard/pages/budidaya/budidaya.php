<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Data Budi Daya</div>
  <div class="card-body">
    <div class="row my-3">
      <div class="col-lg-3">
        <a href="<?php echo $base_url ?>/dashboard/budidaya/tambah" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah</a>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-light">
          <tr>
            <th>No.</th>
            <th>Nama Ikan</th>
            <th>Deskripsi</th>
            <th>Cara Budidaya</th>
            <th width="115px">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $sql_budidaya=mysqli_query($conn, "SELECT * FROM budidaya_ikan left join ikan on ikan.kd_ikan=budidaya_ikan.kd_ikan order by kd_budidaya DESC");
            while($data_budidaya=mysqli_fetch_assoc($sql_budidaya)){
          ?>
          <tr>
            <th scope="row"><?php echo ++$no ?>.</th>
            <td><?php echo ucwords($data_budidaya[nama_ikan]) ?></td>
            <td><?php echo substr($data_budidaya[deskripsi], 0,200) ?>...</td>
            <td><?php echo substr($data_budidaya[budidaya], 0,200) ?>...</td>
            <td>
              <a class="btn btn-warning" href="<?php echo $base_url ?>/dashboard/budidaya/edit/id=<?php echo $data_budidaya[kd_budidaya] ?>" role="button"><span class="fa fa-edit ptooltip" data-toggle="tooltip" data-placement="top" title="Edit"></span></a>
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
                    <div class="modal-body">Pilih ya untuk menghapus budidaya ikan <strong><?php echo ucwords($data_budidaya[nama_ikan]); ?></strong></div>
                    <div class="modal-footer">
                      <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/budidaya/crud.php?id=<?php echo $data_budidaya[kd_budidaya] ?>">Ya</a>
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                    </div>
                  </div>
                </div>
              </div>
          </tr> 
          <?php }  ?>
        </tbody>
      </table>
    </div>
  </div>
</div>