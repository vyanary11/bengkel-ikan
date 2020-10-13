<?php  
$per_page=9; /* Jumlah Data yang ditampilkan Setiap Page*/  
$page_query=mysqli_query($conn, "SELECT COUNT(*) from barang where kd_user='$_GET[kd_user]'");
$pages1 = ceil(mysqli_result($page_query) / $per_page);
$page1 = (isset($_GET[hal])) ? (int)$_GET[hal] : 1;
$start = ($page1 - 1) * $per_page;  
$sql_catalog=mysqli_query($conn, "SELECT * FROM barang left join kategori on barang.kd_kategori=kategori.kd_kategori where kd_user='$_GET[kd_user]' order by kd_barang DESC LIMIT $start, $per_page");
?>
<h3>Catalog</h3>
<?php if(mysqli_num_rows($sql_catalog)<1){ ?>
<div class="row mt-3 mb-5">
  <div class="col-lg-12 text-center alert alert-secondary" role="alert">
    <h2>Data Catalog Kosong</h2>
    <p class="text-muted">Seller belum menjual produk satu pun.</p>
  </div>
</div>
<?php }else{ ?>
<div class="row mt-3 mb-5">
	<?php 
    while ($data_catalog=mysqli_fetch_array($sql_catalog)) {
    $nama_kategori=str_replace(" ","-",$data_catalog[nama_kategori]);  
  ?>
	<div class="col-lg-4">
    <div class="card mb-3 border-0">
      <div class="card-img-top gambar" style="background-image:url(<?php echo $base_url; ?>/assets/images/barang/<?php echo str_replace(" ", "%20", $data_catalog[gambar_barang]) ?> ); ">
          &nbsp;
      </div>
      <div class="card-body">
          <h5 class="card-title"><?php echo substr(ucwords($data_catalog[nama_barang]), 0, 40) ?>...</h5>
          <p class="card-text text-primary">Rp. <?php echo str_replace(",", ".",number_format($data_catalog[harga])) ?></p>
          <a href="<?php echo $base_url ?>/bin/cart.php?id=<?php echo $data_catalog[kd_barang] ?>" class="btn btn-primary"><span class="fa fa-shopping-cart"></span> Beli</a>
          <a href="<?php echo $base_url.'/jual-beli/'.$nama_kategori.'/'.$data_catalog[judul_url].'-'.$data_catalog[kd_barang].'.html' ?>" class="btn btn-primary"><span class="fa fa-eye"></span> Detail</a>
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
              echo "<li class='page-item'><a class='page-link' href='$base_url/user/catalog/$data[kd_user]/page=$link' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
            } else {
              echo "<li class='page-item disabled'><a class='page-link' href='#' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
            }
          ?>
          <?php   
              if($pages1 >= 1 && $page1 <= $pages1){
                for($x=1; $x<=$pages1; $x++){
                  echo ($x == $page1) ?
                  '<li class="page-item active"><a class="page-link" href="#">'.$x.'<span class="sr-only">'.$x.'</span></a></li>' : '<li class="page-item"><a class="page-link" href="'.$base_url.'/user/catalog/'.$data[kd_user].'/page='.$x.'">'.$x.'</a></li>'; 
                }
            }
          ?>  
            <?php 
              if ( $page1 < $pages1 ) {
                $link = $page1 + 1;
                echo "<li class='page-item'><a class='page-link' href='$base_url/user/catalog/$data[kd_user]/page=$link' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
              } else {
                echo "<li class='page-item disabled'><a class='page-link' href='#' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
              }
            ?>   
        </ul>
	</nav>
</div>
<?php } ?>