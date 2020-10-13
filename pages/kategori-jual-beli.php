<?php
	$kategori_replace=str_replace("-", " ", $_GET[kategori]);
	$sql_kategori=mysqli_query($conn, "SELECT * FROM kategori left join kategori_utama on kategori_utama.kd_kategori_utama=kategori.kd_kategori_utama WHERE nama_kategori_utama = 'jual beli' and nama_kategori='$kategori_replace'");
	$data_kategori=mysqli_fetch_assoc($sql_kategori);
	$per_page=12; /* Jumlah Data yang ditampilkan Setiap Page*/  
	$page_query=mysqli_query($conn, "SELECT COUNT(*) from barang left join kategori on barang.kd_kategori=kategori.kd_kategori WHERE barang.kd_kategori='$data_kategori[kd_kategori]'");
	$pages1 = ceil(mysqli_result($page_query) / $per_page);
	$page1 = (isset($_GET['hal'])) ? (int)$_GET['hal'] : 1;
	$start = ($page1 - 1) * $per_page; 
	$sql_search_barang=mysqli_query($conn, "SELECT * FROM barang left join user on user.kd_user=barang.kd_user left join kategori on barang.kd_kategori=kategori.kd_kategori WHERE barang.kd_kategori='$data_kategori[kd_kategori]' order by kd_barang DESC LIMIT $start, $per_page");
?>
<?php if(mysqli_num_rows($sql_kategori)==0){ include "./pages/404.php"; }else{ ?>
<div class="row mt-5 mb-3">
	<div class="col-lg-12">
		<nav aria-label="breadcrumb" role="navigation">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>/jual-beli">Jual Beli</a></li>
		    <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($kategori_replace); ?></li>
		  </ol>
		</nav>
	</div>
</div>
<?php if(mysqli_num_rows($sql_search_barang)==0){ ?>
  <div class="row mb-5 justify-content-center">
    <div class="col-lg-8 text-center alert alert-danger">
      Data Kosong
    </div>
  </div>
<?php }else{ ?>
  <div class="row mb-5">
  	<?php while ($data_search_barang=mysqli_fetch_array($sql_search_barang)) { ?>
    <?php $nama_kategori=str_replace(" ","-",$data_search_barang[nama_kategori]); ?>
    <?php 
      $sql1=mysqli_query($conn, "SELECT SUM(rating), count(kd_review) FROM review where kd_barang='$data_search_barang[kd_barang]'");
        $dttotal=mysqli_fetch_array($sql1);
        if ($dttotal[1]==0) {
          $total=0;
        }else{
          $total=$dttotal[0]/$dttotal[1];
        }
        $total1=ceil($total); 
        $sql_review=mysqli_query($conn, "SELECT * FROM review WHERE kd_barang='$data_search_barang[kd_barang]'");
    ?>
  	<div class="col-lg-3 wow fadeInUp" data-wow-delay="<?php echo $delay+=0.5 ?>s">
        <div class="card mb-3">
          <div class="card-img-top gambar" style="background-image:url(<?php echo $base_url; ?>/assets/images/barang/<?php echo str_replace(" ", "%20", $data_search_barang[gambar_barang]) ?>);">
              &nbsp;
          </div>
          <div class="card-body text-center">
              <h6 class="card-title text-center"><?php echo ucwords($data_search_barang[nama_barang]) ?></h6>
              <p class="card-text text-primary">Rp. <?php echo str_replace(",", ".",number_format($data_search_barang[harga])) ?></p>
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
              <a href="<?php echo $base_url ?>/bin/cart.php?id=<?php echo $data_search_barang[kd_barang] ?>" class="btn btn-primary"><span class="fa fa-shopping-cart"></span> Beli</a>
              <a href="<?php echo $base_url.'/jual-beli/'.$nama_kategori.'/'.$data_search_barang[judul_url].'-'.$data_search_barang[kd_barang].'.html' ?>" class="btn btn-primary"><span class="fa fa-eye"></span> Detail</a>
          </div>
          <div class="card-footer text-muted">
            <span class="fa fa-odnoklassniki"></span> <a class="text-muted" href="<?php echo $base_url ?>/user/akun/<?php echo $data_search_barang[kd_user] ?>"><?php echo ucwords($data_search_barang[nama_lengkap ]); ?></a>
          </div>
        </div>
      </div>
      <?php } ?>
  </div>
  <div class="row justify-content-center">
  	<nav aria-label="Page navigation example">
          <ul class="pagination ">  
              <?php
              if ( $page1 > 1 ) {
                $link = $page1-1;
                echo "<li class='page-item'><a class='page-link' href='$base_url/jual-beli/$_GET[kategori]/page=$link' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
              } else {
                echo "<li class='page-item disabled'><a class='page-link' href='#' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
              }
            ?>
            <?php   
                if($pages1 >= 1 && $page1 <= $pages1){
                  for($x=1; $x<=$pages1; $x++){
                    echo ($x == $page1) ?
                    '<li class="page-item active"><a class="page-link" href="#">'.$x.'<span class="sr-only">'.$x.'</span></a></li>' : '<li class="page-item"><a class="page-link" href="'.$base_url.'/jual-beli/'.$_GET[kategori].'/page='.$x.'">'.$x.'</a></li>'; 
                  }
              }
            ?>  
              <?php 
                if ( $page1 < $pages1 ) {
                  $link = $page1 + 1;
                  echo "<li class='page-item'><a class='page-link' href='$base_url/jual-beli/$_GET[kategori]/page=$link' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
                } else {
                  echo "<li class='page-item disabled'><a class='page-link' href='#' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
                }
              ?>   
          </ul>
  	</nav>
  </div>
  <?php } ?>
<?php } ?>