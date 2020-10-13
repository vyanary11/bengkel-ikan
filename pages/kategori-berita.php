<?php
	$nama_kategori=str_replace("-", " ",$_GET[kategori]);
	$sql_kategori=mysqli_query($conn, "SELECT * FROM kategori left join kategori_utama on kategori_utama.kd_kategori_utama=kategori.kd_kategori_utama WHERE nama_kategori_utama='berita' and nama_kategori='$nama_kategori'");
	$data_kategori=mysqli_fetch_assoc($sql_kategori);
	$per_page=12; /* Jumlah Data yang ditampilkan Setiap Page*/  
	$page_query=mysqli_query($conn, "SELECT COUNT(*) from berita left join kategori on berita.kd_kategori=kategori.kd_kategori WHERE berita.kd_kategori='$data_kategori[kd_kategori]'");
	$pages1 = ceil(mysqli_result($page_query) / $per_page);
	$page1 = (isset($_GET['hal'])) ? (int)$_GET['hal'] : 1;
	$start = ($page1 - 1) * $per_page; 
	$sql_search_berita=mysqli_query($conn, "SELECT * FROM berita left join user on user.kd_user=berita.kd_user left join kategori on berita.kd_kategori=kategori.kd_kategori WHERE berita.kd_kategori='$data_kategori[kd_kategori]' order by kd_berita DESC LIMIT $start, $per_page");
?>
<?php if(mysqli_num_rows($sql_kategori)==0){ include "./pages/404.php"; }else{ ?>
<div class="row mt-5 mb-3">
	<div class="col-lg-12">
		<nav aria-label="breadcrumb" role="navigation">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>/berita">Berita</a></li>
		    <li class="breadcrumb-item active" aria-current="page"><?php echo $nama_kategori; ?></li>
		  </ol>
		</nav>
	</div>
</div>
<?php if(mysqli_num_rows($sql_search_berita)==0){ ?>
  <div class="row mb-5 justify-content-center">
    <div class="col-lg-8 text-center alert alert-danger">
      Data Kosong
    </div>
  </div>
<?php }else{ ?>
	<div class="row mb-5">
		<?php while($data_search_berita=mysqli_fetch_array($sql_search_berita)){ ?>
		<?php $nama_kategori=str_replace(" ","-",$data_search_berita[nama_kategori]); ?>
		<div class="col-lg-3 wow fadeInUp" data-wow-delay="<?php echo $delay+=0.5 ?>s">
			<div class="card mb-3">
				<div class="card-img-top gambar" style="background-image:url(<?php echo $base_url; ?>/assets/images/berita/<?php echo str_replace(" ", "%20", $data_search_berita[gambar_headline]) ?>);">
							&nbsp;
					</div>
				<div class="card-body">
					<h6 class="card-title text-center"><?php echo ucwords($data_search_berita[judul]) ?></h6>
					<a href="<?php echo $base_url.'/berita/'.$nama_kategori.'/'.$data_search_berita[judul_url].'-'.$data_search_berita[kd_berita].'.html' ?>" class="btn btn-primary"><span class="fa fa-eye"></span> Baca Selengkapnya</a>	
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
	              echo "<li class='page-item'><a class='page-link' href='$base_url/berita/$_GET[kategori]/page=$link' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
	            } else {
	              echo "<li class='page-item disabled'><a class='page-link' href='#' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
	            }
	          ?>
	          <?php   
	              if($pages1 >= 1 && $page1 <= $pages1){
	                for($x=1; $x<=$pages1; $x++){
	                  echo ($x == $page1) ?
	                  '<li class="page-item active"><a class="page-link" href="#">'.$x.'<span class="sr-only">'.$x.'</span></a></li>' : '<li class="page-item"><a class="page-link" href="'.$base_url.'/berita/'.$_GET[kategori].'/page='.$x.'">'.$x.'</a></li>'; 
	                }
	            }
	          ?>  
	            <?php 
	              if ( $page1 < $pages1 ) {
	                $link = $page1 + 1;
	                echo "<li class='page-item'><a class='page-link' href='$base_url/berita/$_GET[kategori]/page=$link' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
	              } else {
	                echo "<li class='page-item disabled'><a class='page-link' href='#' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
	              }
	            ?>   
	        </ul>
		</nav>
	</div>
	<?php } ?>
<?php } ?>	