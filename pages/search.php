<div class="row mt-5 mb-3">
	<div class="col-lg-12">
		<nav aria-label="breadcrumb" role="navigation">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Search</li>
		  </ol>
		</nav>
	</div>
</div>
<nav class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item">
	    <a class="nav-link active" id="jual-beli-tab" data-toggle="tab" href="#jual-beli" role="tab" aria-controls="jual-beli" aria-selected="true"><span class="fa fa-shopping-basket"></span>  Jual Beli</a>
	</li>
	<li class="nav-item">
	    <a class="nav-link" id="threads-tab" data-toggle="tab" href="#threads" role="tab" aria-controls="threads" aria-selected="false"><span class="fa fa-fire"> Threads</a>
	</li>
	<li class="nav-item">
	    <a class="nav-link" id="berita-tab" data-toggle="tab" href="#berita" role="tab" aria-controls="berita" aria-selected="false"><span class="fa fa-newspaper-o"></span> Berita</a>
	</li>
</nav>
<div class="tab-content mt-4 mb-5" id="nav-tabContent">
	<div class="tab-pane fade show active" id="jual-beli" role="tabpanel" aria-labelledby="
	jual-beli-tab">
	<?php
	    $per_page=12; /* Jumlah Data yang ditampilkan Setiap Page*/  
	    $page_query=mysqli_query($conn, "SELECT COUNT(*) from barang WHERE nama_barang LIKE '%$_GET[search]%'");
	    $pages1 = ceil(mysqli_result($page_query) / $per_page);
	    $page1 = (isset($_GET['hal'])) ? (int)$_GET['hal'] : 1;
	    $start = ($page1 - 1) * $per_page; 
	    $sql_search_barang=mysqli_query($conn, "SELECT * FROM barang left join user on user.kd_user=barang.kd_user left join kategori on barang.kd_kategori=kategori.kd_kategori WHERE nama_barang LIKE '%$_GET[search]%' order by kd_barang DESC LIMIT $start, $per_page");
    ?>
		<div class="row">
			<div class="col-lg-4">
				<h5>Search Results for: <?php echo $_GET[search] ?></h5>
				<p class="text-muted"><?php echo mysqli_num_rows($sql_search_barang) ?> Item Ditemukan</p>
			</div>
		</div>
		<hr>	
		<div class="row mb-5">
			<?php if(mysqli_num_rows($sql_search_barang)>0 ){ ?>
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
			<div class="col-lg-3">
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
			<?php }else{ ?>
			<div class="col-lg-12 text-center bg-light p-5 border border-dark">
				<h2>Oops hasil pencarian Anda tidak dapat ditemukan.</h2>
				<p class="text-muted">Silakan melakukan pencarian kembali dengan menggunakan kata kunci lain.</p>
			</div>
			<?php } ?>
	    </div>
	    <div class="row justify-content-center">
	    	<nav aria-label="Page navigation example">
		        <ul class="pagination ">  
		            <?php
		            if ( $page1 > 1 ) {
		              $link = $page1-1;
		              echo "<li class='page-item'><a class='page-link' href='?search=$_GET[search]&hal=$link' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
		            } else {
		              echo "<li class='page-item disabled'><a class='page-link' href='#' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
		            }
		          ?>
		          <?php   
		              if($pages1 >= 1 && $page1 <= $pages1){
		                for($x=1; $x<=$pages1; $x++){
		                  echo ($x == $page1) ?
		                  '<li class="page-item active"><a class="page-link" href="#">'.$x.'<span class="sr-only">'.$x.'</span></a></li>' : '<li class="page-item"><a class="page-link" href="?search='.$_GET[search].'&hal='.$x.'">'.$x.'</a></li>'; 
		                }
		            }
		          ?>  
		            <?php 
		              if ( $page1 < $pages1 ) {
		                $link = $page1 + 1;
		                echo "<li class='page-item'><a class='page-link' href='?search=$_GET[search]&hal=$link' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
		              } else {
		                echo "<li class='page-item disabled'><a class='page-link' href='#' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
		              }
		            ?>   
		        </ul>
			</nav>
		</div>
	</div>
	<div class="tab-pane fade" id="threads" role="tabpanel" aria-labelledby="threads-tab">
	<?php
	    $per_page=12; /* Jumlah Data yang ditampilkan Setiap Page*/  
	    $page_query=mysqli_query($conn, "SELECT COUNT(*) from threads WHERE judul LIKE '%$_GET[search]%'");
	    $pages1 = ceil(mysqli_result($page_query) / $per_page);
	    $page1 = (isset($_GET['hal'])) ? (int)$_GET['hal'] : 1;
	    $start = ($page1 - 1) * $per_page; 
	    $sql_search_threads=mysqli_query($conn, "SELECT * FROM threads left join user on user.kd_user=threads.kd_user left join kategori on threads.kd_kategori=kategori.kd_kategori WHERE judul LIKE '%$_GET[search]%' order by kd_thread DESC LIMIT $start, $per_page");
    ?>
		<div class="row">
			<div class="col-lg-4">
				<h5>Search Results for: <?php echo $_GET[search] ?></h5>
				<p class="text-muted"><?php echo mysqli_num_rows($sql_search_threads) ?> Item Ditemukan</p>
			</div>
		</div>
		<hr>	
		<div class="row mb-5">
			<?php if(mysqli_result($sql_search_threads)>0 ){ ?>
			<?php while ($data_search_threads=mysqli_fetch_array($sql_search_threads)) { ?>
			<?php $nama_kategori=str_replace(" ","-",$data_search_threads[nama_kategori]); ?>
			<div class="col-lg-3">
	          <div class="card mb-3">
	            <div class="card-img-top gambar" style="background-image:url(<?php echo $base_url; ?>/assets/images/threads/<?php echo str_replace(" ", "%20", $data_search_threads[gambar_headline]) ?>);">
                    &nbsp;
                </div>
                <div class="card-body">
                    <h6 class="card-title text-center"><?php echo ucwords($data_search_threads[judul]) ?></h6>
                    <a href="<?php echo $base_url.'/forum/'.$nama_kategori.'/'.$data_search_threads[judul_url].'-'.$data_search_threads[kd_thread].'.html' ?>" class="btn btn-primary"><span class="fa fa-eye"></span> Baca Selengkapnya</a>
		        </div>
		        <div class="card-footer text-muted">
		          <span class="fa fa-user"></span> <a class="text-muted" href="<?php echo $base_url ?>/user/akun/<?php echo $data_search_threads[kd_user] ?>"><?php echo ucwords($data_search_threads[nama_lengkap]); ?></a>
		        </div>
	          </div>
	        </div>
	        <?php } ?>
			<?php }else{ ?>
			<div class="col-lg-12 text-center bg-light p-5 border border-dark">
				<h2>Oops hasil pencarian Anda tidak dapat ditemukan.</h2>
				<p class="text-muted">Silakan melakukan pencarian kembali dengan menggunakan kata kunci lain.</p>
			</div>
			<?php } ?>
	    </div>
	    <div class="row justify-content-center">
	    	<nav aria-label="Page navigation example">
		        <ul class="pagination ">  
		            <?php
		            if ( $page1 > 1 ) {
		              $link = $page1-1;
		              echo "<li class='page-item'><a class='page-link' href='?search=$_GET[search]&hal=$link' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
		            } else {
		              echo "<li class='page-item disabled'><a class='page-link' href='#' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
		            }
		          ?>
		          <?php   
		              if($pages1 >= 1 && $page1 <= $pages1){
		                for($x=1; $x<=$pages1; $x++){
		                  echo ($x == $page1) ?
		                  '<li class="page-item active"><a class="page-link" href="#">'.$x.'<span class="sr-only">'.$x.'</span></a></li>' : '<li class="page-item"><a class="page-link" href="?search='.$_GET[search].'&hal='.$x.'">'.$x.'</a></li>'; 
		                }
		            }
		          ?>  
		            <?php 
		              if ( $page1 < $pages1 ) {
		                $link = $page1 + 1;
		                echo "<li class='page-item'><a class='page-link' href='?search=$_GET[search]&hal=$link' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
		              } else {
		                echo "<li class='page-item disabled'><a class='page-link' href='#' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
		              }
		            ?>   
		        </ul>
			</nav>
		</div>
	</div>
	<div class="tab-pane fade" id="berita" role="tabpanel" aria-labelledby="berita-tab">
	<?php
	    $per_page=12; /* Jumlah Data yang ditampilkan Setiap Page*/  
	    $page_query=mysqli_query($conn, "SELECT COUNT(*) from berita WHERE judul LIKE '%$_GET[search]%'");
	    $pages1 = ceil(mysqli_result($page_query) / $per_page);
	    $page1 = (isset($_GET['hal'])) ? (int)$_GET['hal'] : 1;
	    $start = ($page1 - 1) * $per_page; 
	    $sql_search_berita=mysqli_query($conn, "SELECT * FROM berita left join user on user.kd_user=berita.kd_user left join kategori on berita.kd_kategori=kategori.kd_kategori WHERE judul LIKE '%$_GET[search]%' order by kd_berita DESC LIMIT $start, $per_page");
    ?>
		<div class="row">
			<div class="col-lg-4">
				<h5>Search Results for: <?php echo $_GET[search] ?></h5>
				<p class="text-muted"><?php echo mysqli_num_rows($sql_search_berita) ?> Item Ditemukan</p>
			</div>
		</div>
		<hr>	
		<div class="row mb-5">
			<?php if(mysqli_num_rows($sql_search_berita)<1 ){ ?>
			<div class="col-lg-12 text-center bg-light p-5 border border-dark">
				<h2>Oops hasil pencarian Anda tidak dapat ditemukan.</h2>
				<p class="text-muted">Silakan melakukan pencarian kembali dengan menggunakan kata kunci lain.</p>
			</div>
			<?php }else{ ?>
			<?php while($data_search_berita=mysqli_fetch_array($sql_search_berita)){ ?>
			<?php $nama_kategori=str_replace(" ","-",$data_search_berita[nama_kategori]); ?>
	        <div class="col-lg-3">
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
	        <?php } } ?>
    	</div>
    	<div class="row justify-content-center">
	    	<nav aria-label="Page navigation example">
		        <ul class="pagination ">  
		            <?php
		            if ( $page1 > 1 ) {
		              $link = $page1-1;
		              echo "<li class='page-item'><a class='page-link' href='?search=$_GET[search]&hal=$link' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
		            } else {
		              echo "<li class='page-item disabled'><a class='page-link' href='#' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
		            }
		          ?>
		          <?php   
		              if($pages1 >= 1 && $page1 <= $pages1){
		                for($x=1; $x<=$pages1; $x++){
		                  echo ($x == $page1) ?
		                  '<li class="page-item active"><a class="page-link" href="#">'.$x.'<span class="sr-only">'.$x.'</span></a></li>' : '<li class="page-item"><a class="page-link" href="?search='.$_GET[search].'&hal='.$x.'">'.$x.'</a></li>'; 
		                }
		            }
		          ?>  
		            <?php 
		              if ( $page1 < $pages1 ) {
		                $link = $page1 + 1;
		                echo "<li class='page-item'><a class='page-link' href='?search=$_GET[search]&hal=$link' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
		              } else {
		                echo "<li class='page-item disabled'><a class='page-link' href='#' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
		              }
		            ?>   
		        </ul>
			</nav>
		</div>
	</div>
</div>