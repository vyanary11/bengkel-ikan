<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Data Jenis Ikan</div>
  <div class="card-body">
    <div class="row my-3">
      <div class="col-lg-3">
        <a href="<?php echo $base_url ?>/dashboard/gizi/tambah" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah</a>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-light">
          <tr>
            <th scope="row">No</th>
            <th>Nama Ikan</th>
            <th>Kalori</th>
            <th>Protein</th>
            <th>Lemak</th>
            <th>Karbohidrat</th>
            <th>Kalsium</th>
            <th>Fosfor</th>
            <th>Besi</th>
            <th>VIT A</th>
            <th>VIT B1</th>
            <th>VIT C</th>
            <th width="2000000px">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $sql_gizi_ikan=mysqli_query($conn, "SELECT * FROM gizi_ikan left join ikan on ikan.kd_ikan=gizi_ikan.kd_ikan order by kd_gizi DESC");
            while($data_gizi_ikan=mysqli_fetch_assoc($sql_gizi_ikan)){
          ?>
          <tr>
            <th scope="row"><?php echo ++$no ?></th>
            <td><?php echo ucwords($data_gizi_ikan[nama_ikan]); ?></td>
            <td><?php echo $data_gizi_ikan[kalori] ?> %</td>
            <td><?php echo $data_gizi_ikan[protein] ?> %</td>
            <td><?php echo $data_gizi_ikan[lemak] ?> %</td>
            <td><?php echo $data_gizi_ikan[karbohidrat] ?> %</td>
            <td><?php echo $data_gizi_ikan[kalsium] ?> %</td>
            <td><?php echo $data_gizi_ikan[fosfor] ?> %</td>
            <td><?php echo $data_gizi_ikan[besi] ?> %</td>
            <td><?php echo $data_gizi_ikan[vit_a] ?> %</td>
            <td><?php echo $data_gizi_ikan[vit_b1] ?> %</td>
            <td><?php echo $data_gizi_ikan[vit_c] ?> %</td>
            <td>
              <a class="btn btn-warning" href="<?php echo $base_url ?>/dashboard/gizi/edit/id=<?php echo $data_gizi_ikan[kd_gizi] ?>" role="button"><span class="fa fa-edit ptooltip" data-toggle="tooltip" data-placement="top" title="Edit"></span></a>
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
                    <div class="modal-body">Pilih ya untuk menghapus data Jenis ikan <strong><?php echo $data_gizi_ikan[gizi_ikan]; ?></strong></div>
                    <div class="modal-footer">
                      <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/gizi/crud.php?id=<?php echo $data_gizi_ikan[kd_gizi] ?>">Ya</a>
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