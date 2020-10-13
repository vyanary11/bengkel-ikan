<div class="row mt-5 mb-3">
	<div class="col-lg-12">
		<nav aria-label="breadcrumb" role="navigation">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Jual Beli</li>
		  </ol>
		</nav>
	</div>
</div>
<?php  
    $sql_kategori=mysqli_query($conn, "SELECT * FROM kategori WHERE kd_kategori_utama=3");
    while($data_kategori=mysqli_fetch_assoc($sql_kategori)){
    $nama_kategori=str_replace(" ","-",$data_kategori[nama_kategori]);
    $sql_page_barang=mysqli_query($conn, "SELECT * FROM barang left join user on user.kd_user=barang.kd_user left join kategori on barang.kd_kategori=kategori.kd_kategori WHERE barang.kd_kategori='$data_kategori[kd_kategori]' order by kd_barang DESC LIMIT 4");    
?>
    <div class="row mt-5 mb-0">
      <div class="col-6">
        <h2 class="h2 text-primary align-middle"><?php echo ucwords($data_kategori[nama_kategori]); ?></h2>
      </div>
      <?php if(mysqli_num_rows($sql_page_barang)!=0){ ?>
      <div class="col-6">
        <a href="<?php echo $base_url.'/jual-beli/'.$nama_kategori ?>" class="btn btn-sm btn-primary align-middle float-right">Lihat Semua</a>
      </div>
      <?php } ?>
    </div>
    <hr class="mt-0 pt-0">
    <?php if(mysqli_num_rows($sql_page_barang)==0){ ?>
      <div class="row mb-5 justify-content-center">
        <div class="col-lg-8 text-center alert alert-danger">
          Data Kosong
        </div>
      </div>
    <?php }else{ ?>
    <div class="row mb-5">
    	<?php
        while ($data_page_barang=mysqli_fetch_array($sql_page_barang)) { 
        $nama_kategori=str_replace(" ","-",$data_page_barang[nama_kategori]);
        $sql1=mysqli_query($conn, "SELECT SUM(rating), count(kd_review) FROM review where kd_barang='$data_page_barang[kd_barang]'");
        $dttotal=mysqli_fetch_array($sql1);
        if ($dttotal[1]==0) {
          $total=0;
        }else{
          $total=$dttotal[0]/$dttotal[1];
        }
        $total1=ceil($total); 
        $sql_review=mysqli_query($conn, "SELECT * FROM review WHERE kd_barang='$data_page_barang[kd_barang]'");
      ?>
    	<div class="col-lg-3 wow fadeInUp" data-wow-delay="<?php echo $delay+=0.5 ?>s">
          <div class="card mb-3">
            <div class="card-img-top gambar" style="background-image:url(<?php echo $base_url; ?>/assets/images/barang/<?php echo str_replace(" ", "%20", $data_page_barang[gambar_barang]) ?>);">
                &nbsp;
            </div>
            <div class="card-body text-center">
                <h6 class="card-title text-center"><?php echo ucwords($data_page_barang[nama_barang])?></h6>
                <p class="card-text text-primary">Rp. <?php echo str_replace(",", ".",number_format($data_page_barang[harga])) ?></p>
                <?php if(mysqli_num_rows($sql_review)!=0){ ?>
                <p class="text-muted">
                  <?php 
                    $jml=$total1;
                    for ($i=0; $i < $jml; $i++) { 
                      ?>
                      <i class="fa fa-star text-warning">&nbsp;</i>
                      <?php
                    }
                    for ($i=0; $i < 5-$jml; $i++) { 
                      ?>
                      <i class="fa fa-star-o" style="color: #ddd">&nbsp;</i>
                      <?php
                    }
                  ?>
                <?php echo mysqli_num_rows($sql_review); ?> Review
                </p>
                <?php }else{ ?>
                <p class="text-muted">&nbsp;</p>
                <?php } ?>
                <a href="<?php echo $base_url ?>/bin/cart.php?id=<?php echo $data_page_barang[kd_barang] ?>" class="btn btn-primary"><span class="fa fa-shopping-cart"></span> Beli</a>
                <a href="<?php echo $base_url.'/jual-beli/'.$nama_kategori.'/'.$data_page_barang[judul_url].'-'.$data_page_barang[kd_barang].'.html' ?>" class="btn btn-primary"><span class="fa fa-eye"></span> Detail</a>
            </div>
            <div class="card-footer text-muted">
                  <span class="fa fa-odnoklassniki"></span> <a class="text-muted" href="<?php echo $base_url ?>/user/akun/<?php echo $data_page_barang[kd_user] ?>"><?php echo ucwords($data_page_barang[nama_lengkap ]); ?></a>
                </div>
          </div>
        </div>
        <?php } ?>
    </div>
  <?php } } ?>