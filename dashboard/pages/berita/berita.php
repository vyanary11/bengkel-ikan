<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Data Berita</div>
  <div class="card-body">
    <div class="row my-3">
      <div class="col-lg-3">
        <a href="<?php echo $base_url ?>/dashboard/berita/tambah" class="btn btn-primary"><span class="fa fa-plus"></span> Berita Baru</a>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-light">
          <tr>
            <th>No.</th>
            <th>Judul Berita</th>
            <th>Nama Penulis</th>
            <th>Kategori</th>
            <th>View</th>
            <th width="115px">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $sql_berita=mysqli_query($conn, "SELECT kd_berita,judul,nama_lengkap,jumlah_view,nama_kategori,judul_url FROM berita left join user on user.kd_user=berita.kd_user left join kategori on kategori.kd_kategori=berita.kd_kategori order by kd_berita DESC");
            while($data_berita=mysqli_fetch_assoc($sql_berita)){
            	$nama_kategori=str_replace(" ", "-", $data_berita[nama_kategori]);
          ?>
          <tr>
            <th scope="row"><?php echo ++$no ?>.</th>
            <td><?php echo ucwords($data_berita[judul]) ?></td>
            <td><?php echo ucwords($data_berita[nama_lengkap]) ?></td>
            <td><?php echo ucwords($data_berita[nama_kategori]) ?></td>
            <td><?php echo number_format($data_berita[jumlah_view]); ?></td>
            <td>
              <a class="btn btn-warning" href="<?php echo $base_url ?>/dashboard/berita/edit/id=<?php echo $data_berita[kd_berita] ?>" role="button"><span class="fa fa-edit ptooltip" data-toggle="tooltip" data-placement="top" title="Edit"></span></a>
              <a class="btn btn-danger" data-toggle="modal"  href="#hapusmodal<?php echo ++$counter ?>" role="button"><span class="fa fa-trash ptooltip" data-toggle="tooltip" data-placement="top" title="Hapus"></span></a>
              <a class="btn btn-info" href="<?php echo $base_url ?>/berita/<?php echo $nama_kategori."/".$data_berita[judul_url]."-".$data_berita[kd_berita].".html" ?>" role="button"><span class="fa fa-eye ptooltip" data-toggle="tooltip" data-placement="top" title="Lihat"></span></a>
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
                    <div class="modal-body">Pilih ya untuk menghapus berita dengan judul <strong><?php echo ucwords($data_berita[judul]); ?></strong></div>
                    <div class="modal-footer">
                      <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/berita/crud.php?id=<?php echo $data_berita[kd_berita] ?>">Ya</a>
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