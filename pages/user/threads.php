<?php 
  if ($_GET[msg]=="gagal") {
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <h3><span class="fa fa-times-circle"></span> Ada yang salah</h3>
      Coba cek kembali 
    </div>
    <?php
  }elseif ($_GET[msg]=="berhasiltulisthread") {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <?php 
        $sql_thread_baru=mysqli_query($conn, "SELECT * FROM threads left join kategori on kategori.kd_kategori=threads.kd_kategori where kd_user='$_GET[kd_user]' ORDER BY kd_thread DESC LIMIT 1");
        $data_thread_baru=mysqli_fetch_assoc($sql_thread_baru);
      ?>
      <h3><span class="fa fa-check-circle"></span> Berhasil Membuat Thread Baru, <a href="<?php echo $base_url ?>/forum/<?php echo $data_thread_baru[nama_kategori]."/".$data_thread_baru[judul_url]."-".$data_thread_baru[kd_thread] ?>.html" class="alert-link">Lihat.</a></h3>
    </div>
    <?php
  }elseif ($_GET[msg]=="berhasilhapus") {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <h3><span class="fa fa-check-circle"></span> Berhasil hapus thread</h3>
    </div>
    <?php
  }elseif ($_GET[msg]=="berhasileditthread") {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <h3><span class="fa fa-check-circle"></span> Berhasil edit thread</h3>
    </div>
    <?php
  }
?>
<h3>Threads Saya</h3>
<?php if ($_SESSION[loginuser]) { ?>
<div class="row mt-4 mb-3">
  <div class="col-lg-3">
    <a href="<?php echo $base_url; ?>/forum/tulis-thread" class="btn btn-primary"><span class="fa fa-pencil"></span> Tulis Thread</a>
  </div>
</div>
<?php } ?>
<table class="table table-bordered">
  	<thead class="thead-light bg-light">
    	<tr>
      		<th scope="col" class="w-50">Threads</th>
      		<th scope="col">Kategori</th>
      		<th scope="col">Stat</th>
          <?php if($_GET[kd_user]==$_SESSION[loginuser]){ ?>
          <th scope="col">Action</th>
          <?php } ?>
    	</tr>
  	</thead>
  	<tbody>
      <?php 
        $sql_threads=mysqli_query($conn, "SELECT * FROM threads left join kategori on threads.kd_kategori=kategori.kd_kategori WHERE kd_user='$_GET[kd_user]'");
        if (mysqli_num_rows($sql_threads)==0) {
        ?>
          <tr>
            <td colspan="4" align="center">
              Anda Tidak Memiliki Threads
            </td>
          </tr>
        <?php
        }else{
          while ($data_threads=mysqli_fetch_assoc($sql_threads)) {
            $jmlreply=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM balasan_thread where kd_thread='$data_threads[kd_thread]'"));
            ?>
              <tr>
                <td><a href="" ><?php echo ucwords($data_threads[judul]); ?></a></td>
                <td><a href="" ><?php echo $data_threads[nama_kategori]; ?></a></td>
                <td>View : <strong><?php echo $data_threads[jumlah_view]; ?></strong></br>Reply : <strong><?php echo $jmlreply; ?></strong></td>
                <?php if($_GET[kd_user]==$_SESSION[loginuser]){ ?>
                <td>
                  <a href="<?php echo $base_url ?>/forum/edit-thread/id=<?php echo $data_threads[kd_thread] ?>" class="btn btn-warning"><span class="fa fa-edit ptooltip" data-toggle="tooltip" data-placement="top" title="edit"></span></a>
                  <a class="btn btn-danger" data-toggle="modal"  href="#hapusmodal<?php echo ++$counter ?>" role="button"><span class="fa fa-trash ptooltip" data-toggle="tooltip" data-placement="top" title="hapus"></span></a>
                </td>
                <div class="modal fade" id="hapusmodal<?php echo $counter ?>" tabindex="-1" role="dialog" aria-labelledby="hapusmodallabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="hapusmodallabel">Yakin ingin menghapus ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">Pilih ya untuk menghapus thread yang berjudul <strong><?php echo ucwords($data_threads[judul]); ?></strong></div>
                      <div class="modal-footer">
                        <a class="btn btn-danger" href="<?php echo $base_url; ?>/bin/hapus_thread.php?id=<?php echo $data_threads[kd_thread] ?>">Ya</a>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </tr>
            <?php
          }
        }
      ?>
  	</tbody>
</table>