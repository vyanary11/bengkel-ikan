<div class="row mt-5 mb-3">
	<div class="col-lg-12">
    <nav aria-label="breadcrumb" role="navigation">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Forum</li>
      </ol>
    </nav>
  </div>
</div>
<?php  
    $sql_kategori=mysqli_query($conn, "SELECT * FROM kategori WHERE kd_kategori_utama=2");
    while($data_kategori=mysqli_fetch_assoc($sql_kategori)){
    $nama_kategori=str_replace(" ","-",$data_kategori[nama_kategori]);
    $sql_page_threads=mysqli_query($conn, "SELECT * FROM threads left join user on user.kd_user=threads.kd_user left join kategori on threads.kd_kategori=kategori.kd_kategori WHERE threads.kd_kategori='$data_kategori[kd_kategori]' order by kd_thread DESC LIMIT 4"); 
?>
    <div class="row mt-5 mb-0">
      <div class="col-6">
        <h2 class="h2 text-primary align-middle"><?php echo ucwords($data_kategori[nama_kategori]); ?></h2>
      </div>
      <?php if(mysqli_num_rows($sql_page_threads)!=0){ ?>
      <div class="col-6">
        <a href="<?php echo $base_url.'/forum/'.$nama_kategori ?>" class="btn btn-sm btn-primary align-middle float-right">Lihat Semua</a>
      </div>
      <?php } ?>
    </div>
    <hr class="mt-0 pt-0">
    <?php if(mysqli_num_rows($sql_page_threads)==0){ ?>
      <div class="row mb-5 justify-content-center">
        <div class="col-lg-8 text-center alert alert-danger">
          Data Kosong
        </div>
      </div>
    <?php }else{ ?>
  <div class="row mb-5">
  	<?php 
    while ($data_page_threads=mysqli_fetch_array($sql_page_threads)) { 
    $nama_kategori=str_replace(" ","-",$data_page_threads[nama_kategori]); 
    ?>
  	<div class="col-lg-3 wow fadeInUp" data-wow-delay="<?php echo $delay+=0.5 ?>s">
        <div class="card mb-3">
          <div class="card-img-top gambar" style="background-image:url(<?php echo $base_url; ?>/assets/images/threads/<?php echo str_replace(" ", "%20", $data_page_threads[gambar_headline]) ?>);">
              &nbsp;
          </div>
          <div class="card-body">
              <h6 class="card-title text-center"><?php echo ucwords($data_page_threads[judul]); ?> </h6>
               <a href="<?php echo $base_url.'/forum/'.$nama_kategori.'/'.$data_page_threads[judul_url].'-'.$data_page_threads[kd_thread].'.html' ?>" class="btn btn-primary"><span class="fa fa-eye"></span> Baca Selengkapnya</a>
          </div>
          <div class="card-footer text-muted">
            <span class="fa fa-user"></span> <a class="text-muted" href="<?php echo $base_url ?>/user/akun/<?php echo $data_page_threads[kd_user] ?>"><?php echo ucwords($data_page_threads[nama_lengkap ]); ?></a>
          </div>
        </div>
      </div>
      <?php }  ?>
  </div>
<?php } } ?>