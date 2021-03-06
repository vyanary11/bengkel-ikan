<div class="row mt-5 mb-3">
	<div class="col-lg-12">
		<nav aria-label="breadcrumb" role="navigation">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Berita</li>
		  </ol>
		</nav>
	</div>
</div>
<?php  
    $sql_kategori=mysqli_query($conn, "SELECT * FROM kategori WHERE kd_kategori_utama=1");
    while($data_kategori=mysqli_fetch_assoc($sql_kategori)){
    	$nama_kategori=str_replace(" ","-",$data_kategori[nama_kategori]);
    	$sql_page_berita=mysqli_query($conn, "SELECT * FROM berita left join user on user.kd_user=berita.kd_user left join kategori on berita.kd_kategori=kategori.kd_kategori WHERE berita.kd_kategori='$data_kategori[kd_kategori]' order by kd_berita DESC LIMIT 4");  
?>
    <div class="row mt-5 mb-0">
      <div class="col-6">
        <h2 class="h2 text-primary align-middle"><?php echo ucwords($data_kategori[nama_kategori]); ?></h2>
      </div>
      <?php if(mysqli_num_rows($sql_page_berita)!=0){ ?>
      <div class="col-6">
        <a href="<?php echo $base_url.'/berita/'.$nama_kategori ?>" class="btn btn-sm btn-primary align-middle float-right">Lihat Semua</a>
      </div>
      <?php } ?>
    </div>
    <hr class="mt-0 pt-0">
    <?php if(mysqli_num_rows($sql_page_berita)==0){ ?>
      <div class="row mb-5 justify-content-center">
        <div class="col-lg-8 text-center alert alert-danger">
          Data Kosong
        </div>
      </div>
    <?php }else{ ?>
    <div class="row mb-5">
		<?php
			while($data_page_berita=mysqli_fetch_array($sql_page_berita)){
			$nama_kategori=str_replace(" ","-",$data_page_berita[nama_kategori]); 
		?>
		<div class="col-lg-3 wow fadeInUp" data-wow-delay="<?php echo $delay+=0.5 ?>s">
			<div class="card mb-3">
				<div class="card-img-top gambar" style="background-image:url(<?php echo $base_url; ?>/assets/images/berita/<?php echo str_replace(" ", "%20", $data_page_berita[gambar_headline]) ?>);">
							&nbsp;
					</div>
				<div class="card-body">
					<h6 class="card-title text-center"><?php echo ucwords($data_page_berita[judul])?></h6>
					<a href="<?php echo $base_url.'/berita/'.$nama_kategori.'/'.$data_page_berita[judul_url].'-'.$data_page_berita[kd_berita].'.html' ?>" class="btn btn-primary"><span class="fa fa-eye"></span> Baca Selengkapnya</a>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
<?php } } ?>