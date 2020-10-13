<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Data Barang Yang di Jual</div>
  <div class="card-body">
    <div class="row my-3">
      <div class="col-lg-3">
        <a href="<?php echo $base_url ?>/dashboard/barang/tambah" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah</a>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-light">
          <tr>
            <th>No.</th>
            <th>Kategori</th>
            <th>Nama Barang</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Satuan</th>
            <th width="115px">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $sql_barang=mysqli_query($conn, "SELECT * FROM barang left join kategori on kategori.kd_kategori=barang.kd_kategori WHERE kd_user='$_SESSION[loginadmin]' order by kd_barang DESC");
            while($data_barang=mysqli_fetch_assoc($sql_barang)){
            	$nama_kategori=str_replace(" ", "-", $data_barang[nama_kategori]);
          ?>
          <tr>
            <th scope="row"><?php echo ++$no ?>.</th>
            <td><?php echo ucwords($data_barang[nama_kategori]) ?></td>
            <td><?php echo substr(ucwords($data_barang[nama_barang]), 0,30) ?>...</td>
            <td><?php echo substr($data_barang[deskripsi], 0,50) ?>...</td>
            <td>Rp. <?php echo number_format($data_barang[harga]); ?></td>
            <td>Per <?php echo ucwords($data_barang[satuan]); ?></td>
            <td>
              <a class="btn btn-warning" href="<?php echo $base_url ?>/dashboard/barang/edit/id=<?php echo $data_barang[kd_barang] ?>" role="button"><span class="fa fa-edit ptooltip" data-toggle="tooltip" data-placement="top" title="Edit"></span></a>
              <a class="btn btn-danger" data-toggle="modal"  href="#hapusmodal<?php echo ++$counter ?>" role="button"><span class="fa fa-trash ptooltip" data-toggle="tooltip" data-placement="top" title="Hapus"></span></a>
              <a class="btn btn-info" href="<?php echo $base_url ?>/jual-beli/<?php echo $nama_kategori."/".$data_barang[judul_url]."-".$data_barang[kd_barang].".html" ?>" role="button"><span class="fa fa-eye ptooltip" data-toggle="tooltip" data-placement="top" title="Lihat"></span></a>
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
                    <div class="modal-body">Pilih ya untuk menghapus barang dengan Nama <strong><?php echo ucwords($data_barang[nama_barang]); ?></strong></div>
                    <div class="modal-footer">
                      <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/barang/crud.php?id=<?php echo $data_barang[kd_barang] ?>">Ya</a>
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