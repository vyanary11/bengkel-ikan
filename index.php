<?php 
error_reporting(0);
  include "bin/koneksi.php";
  $pages=$_GET['page'];
  $action=$_GET['action'];
  $sqluser=mysqli_query($conn, "SELECT * FROM user where kd_user='$_SESSION[loginuser]'");
  $datauser=mysqli_fetch_assoc($sqluser);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Website tentang sebuah Marketplace dan forum Seputar dunia perikanan">
    <meta name="author" content="teambengkelikan">
    <meta name="keywords" content="Marketplace, e-commerce, toko online, startup, forum perikanan, jual beli ikan, budidaya ikan, gizi ikan, tips perikanan, berita perikanan,bengkel ikan">
    <link rel="icon" href="<?php echo $base_url; ?>/assets/images/favicon.png" >

    <title>
      <?php 
        if(isset($pages)){ 
          if (isset($_GET[url])) {
            echo ucwords(str_replace("-"," ", $_GET[url]))." | Bengkel Ikan";
          }else{
            echo ucwords(str_replace("-"," ", $pages))." | Bengkel Ikan";
          } 
        }else{  
          echo "Bengkel Ikan | Marketplace dan forum seputar dunia perikanan"; 
        } 
      ?>
    </title>

    <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url ?>/assets/css/star-rating2.min.css">
    <link href="<?php echo $base_url; ?>/plugins/select2/select2.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/assets/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/assets/css/animate.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/css/custom.css" rel="stylesheet">
    <style type="text/css">
      body{
        font-family: 'Josefin Sans', sans-serif;
      }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
  </head>
  <body>
    
    <!-- <div class="screen-loader" style="background: #fff url(<?php echo $base_url; ?>/assets/images/Preloader.gif) no-repeat center center;"></div> -->
    
    <!-- <div id="preload">
        <div id="preload-status" style="background: #fff url(<?php echo $base_url; ?>/assets/images/Preloader.gif) no-repeat center center;"></div>
    </div> -->

    <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-header bg-white" id="menutengah1">
      <div class="container">
        <span class="navbar-brand">
            <i class="fa fa-phone"> </i> +6282 147 613 330 
            <i class="fa fa-envelope ml-3"> </i> officialbengkelikan@gmail.com
        </span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ml-auto">
            <?php if (!$_SESSION[loginuser]) { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $base_url; ?>/masuk">Masuk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $base_url; ?>/daftar">Daftar</a>
            </li>
            <?php }else{ ?>
             <li class="nav-item">
              <a href="<?php echo $base_url; ?>/forum/tulis-thread" class="nav-link"><span class="fa fa-edit"></span> Tulis Thread</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link active dropdown-toggle" href="" id="akunsaya" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-user-o"></span> <?php echo ucwords($datauser['nama_lengkap']); ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="akunsaya">
                  <a class="dropdown-item" href="<?php echo $base_url; ?>/user/akun/<?php echo $_SESSION[loginuser] ?>"><i class="fa fa-smile-o"></i> Panel Akun
                  </a>
                  <a class="dropdown-item" href="<?php echo $base_url; ?>/bin/logout.php"><i class="fa fa-sign-out"></i> Logout
                  </a>
              </div>
            </li>
            <li class="nav-item">
              <a href="<?php echo $base_url; ?>/jual-beli/cart" class="nav-link"><span class="fa fa-shopping-cart"></span> Keranjang ( <?php echo mysqli_num_rows(mysqli_query($conn,"SELECT * FROM cart WHERE kd_user='$_SESSION[loginuser]'")); ?> )</a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row my-2">
        <div class="col-12">
          <div class="row brand align-items-center">
            <div class="col-lg-3">
              <h1><img alt="brand" src="<?php echo $base_url ?>/assets/images/brand.png" class="img-fluid my-3 w-100"></h1>
            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-5">
              <form action="<?php echo $base_url; ?>" method="get">
                <div class="input-group ml-auto" >
                  <input type="search" name="search" class="form-control" placeholder="Search for..." aria-label="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit"><span class="fa fa-search"></span></button>
                  </span>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row" id="menutengah">
        <div class="col-xl-3 menu1">
          <nav class="navbar navbar-expand-xl navbar-dark">
            <div class="<?php if (isset($pages) or isset($_GET[search])) { echo 'brand-kate'; }else{ } ?>">
              <a class="navbar-toggler" data-toggle="collapse" href="#navbarCollapse1" aria-controls="navbarCollapse1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
              </a> 
              <?php if (isset($pages) or isset($_GET[search])) { ?>
              <a class="navbar-brand kategori kategorimega" href="#">
                <font><span class="fa fa-bars"></span> KATEGORI</font>
              </a>
              <div class="row megamenu">
                <div class="triangle demo-arrow-up float-right"></div>
                <?php 
                  $sql=mysqli_query($conn, "SELECT * FROM kategori_utama");
                  while ($data=mysqli_fetch_assoc($sql)) {
                ?>
                <div class="nav-column col-lg-3 mb-3">
                      <h6 class="font-weight-bold mt-3" style="min-width: 150px;"><?php echo ucwords($data['nama_kategori_utama']); ?></h6>
                      <ul class="nav flex-column">
                      <?php 
                        $sql1=mysqli_query($conn, "SELECT * FROM kategori where kd_kategori_utama='$data[kd_kategori_utama]'");
                        while ($data1=mysqli_fetch_assoc($sql1)) {
                      ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>/<?php echo str_replace(" ", "-", $data[nama_kategori_utama] )?>/<?php echo str_replace(" ", "-", $data1[nama_kategori] )?>"><?php echo ucwords($data1['nama_kategori']); ?></a></li>
                      <?php } ?>
                    </ul>
                </div>
                <?php } ?>
              </div>
              <?php }else{ ?>
              <a class="navbar-brand kategori" href="#">
                <font><span class="fa fa-bars"></span> KATEGORI</font>
              </a>
              <?php } ?>
            </div>
          </nav>
        </div>
        <div class="col-xl-9 menu">
          <nav class="navbar navbar-expand-xl navbar-dark">
            <div class="collapse navbar-collapse" id="navbarCollapse1">
              <ul class="navbar-nav font-weight-bold">
                <li class="nav-item">
                  <a class="nav-link <?php if(!$pages){ echo "active"; } ?>" href="<?php echo $base_url; ?>/">HOME</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php if($pages=="forum"){ echo "active"; } ?>" href="<?php echo $base_url; ?>/forum">FORUM</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php if($pages=="jual-beli"){ echo "active"; } ?>" href="<?php echo $base_url; ?>/jual-beli">JUAL BELI</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php if($pages=="berita"){ echo "active"; } ?>" href="<?php echo $base_url; ?>/berita">BERITA</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php if($pages=="kandungan-gizi-ikan"){ echo "active"; } ?>" href="<?php echo $base_url; ?>/gizi">KANDUNGAN GIZI IKAN</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php if($pages=="budidaya-ikan"){ echo "active"; } ?>" href="<?php echo $base_url; ?>/budidaya">BUDIDAYA IKAN</a>
                </li>
                <li class="nav-item dropdown kate1 d-xl-none">
                  <a class="nav-link dropdown-toggle" href="" id="kate1" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                    KATEGORI
                  </a>
                  <div class="dropdown-menu" aria-labelledby="kate1">
                    <?php 
                      $sql=mysqli_query($conn, "SELECT * FROM kategori_utama");
                      while ($data=mysqli_fetch_assoc($sql)) {
                    ?>
                    <h6 class="dropdown-header" ><?php echo ucwords($data['nama_kategori_utama']); ?></h6>
                    <?php 
                      $sql1=mysqli_query($conn, "SELECT * FROM kategori where kd_kategori_utama='$data[kd_kategori_utama]'");
                      while ($data1=mysqli_fetch_assoc($sql1)) {
                    ?>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/<?php echo str_replace(" ", "-", $data[nama_kategori_utama] )?>/<?php echo str_replace(" ", "-", $data1[nama_kategori] )?>"><?php echo ucwords($data1['nama_kategori']); ?></a>
                    <?php } } ?>
                  </div>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div><!-- container -->
    <!-- header -->
    <!-- konten -->
    <div class="container">
      <?php
        if ($pages=="masuk") {
          include "pages/masuk.php"; 
        }elseif($pages=="daftar"){
          include "pages/daftar.php";
        }elseif($pages=="lupa-password"){
          if ($action=="reset-password") {
            include "pages/reset-password.php";
          }else{ 
            include "pages/lupa-password.php";
          }
        }elseif($pages=="user"){
          if ($action=="akun") {
            include "pages/profil-user.php";
          }else{
            include "pages/profil-user.php";
          }
        }elseif($pages=="berita"){
          if (isset($_GET[kategori])) {
            if (isset($_GET[url])) {
              include "pages/single-berita.php";
            }else{
              include "pages/kategori-berita.php";
            }
          }else{
            include "pages/berita.php";
          }
        }elseif($pages=="forum"){
          if ($action=="tulis-thread") {
            include "pages/tulis-thread.php";
          }elseif ($action=="edit-thread") {
            include "pages/tulis-thread.php";
          }elseif ($action=="reply-thread") {
            include "pages/reply-thread.php";
          }elseif ($action=="edit-reply-thread") {
            include "pages/reply-thread.php";
          }elseif (isset($_GET[kategori])) {
            if (isset($_GET[url])) {
              include "pages/single-threads.php";
            }else{
              include "pages/kategori-forum.php";
            }
          }else{
            include "pages/forum.php";
          }
        }elseif($pages=="jual-beli"){
          if (isset($_GET[kategori])) {
            if (isset($_GET[url])) {
              include "pages/detail-jual-beli.php";
            }else{
              include "pages/kategori-jual-beli.php";
            }
          }elseif($action=="cart"){
            include "pages/cart.php";
          }elseif($action=="checkout"){
            include "pages/checkout.php";
          }elseif($action=="invoice"){
            include "pages/invoice.php";
          }else{
            include "pages/jual-beli.php";
          }
        }elseif($pages=="kandungan-gizi-ikan"){
          include "pages/kandungan-gizi-ikan.php";
        }elseif($pages=="budidaya-ikan"){
          include "pages/budidaya-ikan.php";
        }elseif($pages=="kategori"){
          include "pages/kategori.php";
        }elseif(isset($_GET[search])){
          include "pages/search.php";
        }elseif(!$pages or !$_GET[search]){
      ?>
      <div class="row">
        <div class="col-lg-3 kate bg-white pb-3 pl-4">
          <div class="triangle demo-arrow-up float-right"></div>
          <ul class="nav flex-column">
            <?php 
              $sql=mysqli_query($conn, "SELECT * FROM kategori_utama");
              while ($data=mysqli_fetch_assoc($sql)) {
            ?>
              <h6 class="font-weight-bold mt-3"><?php echo ucwords($data['nama_kategori_utama']); ?></h6>
            <?php 
              $sql1=mysqli_query($conn, "SELECT * FROM kategori where kd_kategori_utama='$data[kd_kategori_utama]' order by kd_kategori desc LIMIT 2");
              while ($data1=mysqli_fetch_assoc($sql1)) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $base_url; ?>/<?php echo str_replace(" ", "-", $data[nama_kategori_utama] )?>/<?php echo str_replace(" ", "-", $data1[nama_kategori] )?>"><?php echo ucwords($data1['nama_kategori']); ?></a>
            </li>
            <?php } } ?>
          </ul>
        </div>
        <div class="col-xl-9 col-lg-12 mt-3">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" style="height:auto;" src="assets/images/slides/header2.png" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" style="height:auto;" src="assets/images/slides/header1.png" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" style="height:auto;" src="assets/images/slides/header4.png" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div><!-- container -->
    <div class="container"> 
      <?php 
        $sql=mysqli_query($conn, "SELECT * FROM kategori_utama order by kd_kategori_utama desc");
        while ($data=mysqli_fetch_assoc($sql)) {
      ?>
      <div class="card border-0 my-5 rounded-0 rounded-top"> 
        <div class="card-header text-primary text-center" style="background-color: #F5F5F5">
          <h2 class="h2"><span class="fa <?php echo $data[icon_fa] ?>"></span> <?php if($data[nama_kategori_utama]=="forum"){ echo "Hot Threads";}elseif($data[nama_kategori_utama]=="berita"){ echo "Hot News";}else{ echo ucwords($data['nama_kategori_utama']) ; } ?></h2>
        </div>
        <div class="card-body" style="background-color: #F5F5F5">
          <div class="row">
            <?php if ($data[kd_kategori_utama]==1) { ?>
            <?php 
              $sql_home_berita=mysqli_query($conn, "SELECT * FROM berita left join kategori on kategori.kd_kategori=berita.kd_kategori order by jumlah_view DESC LIMIT 4");
              while($data_home_berita=mysqli_fetch_assoc($sql_home_berita)){
                $nama_kategori=str_replace(" ","-",$data_home_berita[nama_kategori]);
            ?>
            <div class="col-lg-3 wow fadeInUp" data-wow-delay="<?php echo $delay1+=0.5 ?>s">
              <div class="card mb-3">
               <div class="card-img-top gambar" style="background-image:url(./assets/images/berita/<?php echo str_replace(" ", "%20", $data_home_berita[gambar_headline]) ?>);">
                    &nbsp;
                </div>
                <div class="card-body">
                    <h6 class="card-title text-center"><?php echo ucwords($data_home_berita[judul])?></h6>
                    <a href="<?php echo $base_url.'/berita/'.$nama_kategori.'/'.$data_home_berita[judul_url].'-'.$data_home_berita[kd_berita].'.html' ?>" class="btn btn-primary"><span class="fa fa-eye"></span> Baca Selengkapnya</a>
                </div>
              </div>
            </div>
            <?php } ?>
            <?php }elseif ($data[kd_kategori_utama]==2) { ?>
            <?php 
              $sql_home_threads=mysqli_query($conn, "SELECT * FROM threads left join kategori on kategori.kd_kategori=threads.kd_kategori left join user on user.kd_user=threads.kd_user order by jumlah_view DESC LIMIT 4");
              while($data_home_threads=mysqli_fetch_assoc($sql_home_threads)){
                $nama_kategori=str_replace(" ","-",$data_home_threads[nama_kategori]);
            ?>
            <div class="col-lg-3 wow fadeInUp" data-wow-delay="<?php echo $delay2+=0.5 ?>s">
              <div class="card mb-3">
                <div class="card-img-top gambar" style="background-image:url(./assets/images/threads/<?php echo str_replace(" ", "%20", $data_home_threads[gambar_headline]) ?>);">
                    &nbsp;
                </div>
                <div class="card-body">
                    <h6 class="card-title text-center"><?php echo ucwords($data_home_threads[judul])?></h6>
                    <a href="<?php echo $base_url.'/forum/'.$nama_kategori.'/'.$data_home_threads[judul_url].'-'.$data_home_threads[kd_thread].'.html' ?>" class="btn btn-primary"><span class="fa fa-eye"></span> Baca Selengkapnya</a>
                </div>
                <div class="card-footer text-muted">
                  <span class="fa fa-user"></span> <a class="text-muted" href="<?php echo $base_url ?>/user/akun/<?php echo $data_home_threads[kd_user] ?>"><?php echo ucwords($data_home_threads[nama_lengkap ]); ?></a>
                </div>
              </div>
            </div>
            <?php } ?>
            <?php }else{ ?>
            <?php 
              $sql_home_barang=mysqli_query($conn, "SELECT * FROM barang left join user on user.kd_user=barang.kd_user left join kategori on kategori.kd_kategori=barang.kd_kategori order by RAND() LIMIT 4");
              while($data_home_barang=mysqli_fetch_assoc($sql_home_barang)){
                  $nama_kategori=str_replace(" ","-",$data_home_barang[nama_kategori]);
                  $sql1=mysqli_query($conn, "SELECT SUM(rating), count(kd_review) FROM review where kd_barang='$data_home_barang[kd_barang]'");
                  $dttotal=mysqli_fetch_array($sql1);
                  if ($dttotal[1]==0) {
                    $total=0;
                  }else{
                    $total=$dttotal[0]/$dttotal[1];
                  }
                  $total1=ceil($total); 
                  $sql_review=mysqli_query($conn, "SELECT * FROM review WHERE kd_barang='$data_home_barang[kd_barang]'");
            ?>
            <div class="col-lg-3 wow fadeInUp" data-wow-delay="<?php echo $delay+=0.5 ?>s">
              <div class="card mb-3">
                <div class="card-img-top gambar" style="background-image:url(./assets/images/barang/<?php echo str_replace(" ", "%20", $data_home_barang[gambar_barang]) ?>);">
                    &nbsp;
                </div>
                <div class="card-body text-center">
                    <h6 class="card-title text-center"><?php echo ucwords($data_home_barang[nama_barang]) ?></h6>
                    <p class="card-text text-primary">Rp. <?php echo str_replace(",", ".",number_format($data_home_barang[harga])) ?></p>
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
                    <a href="<?php echo $base_url ?>/bin/cart.php?id=<?php echo $data_home_barang[kd_barang] ?>" class="btn btn-primary"><span class="fa fa-shopping-cart"></span> Beli</a>
                    <a href="<?php echo $base_url.'/jual-beli/'.$nama_kategori.'/'.$data_home_barang[judul_url].'-'.$data_home_barang[kd_barang].'.html' ?>" class="btn btn-primary"><span class="fa fa-eye"></span> Detail</a>
                </div>
                <div class="card-footer text-muted">
                  <span class="fa fa-odnoklassniki"></span> <a class="text-muted" href="<?php echo $base_url ?>/user/akun/<?php echo $data_home_barang[kd_user] ?>"><?php echo ucwords($data_home_barang[nama_lengkap ]); ?></a>
                </div>
              </div>
            </div>
            <?php } } ?>
          </div><!-- row -->
        </div><!-- card-body -->
      </div><!-- card -->
      <?php } }else{ include "pages/404.php"; } ?>
    </div><!-- container -->
    <!-- konten -->
    <!-- footer -->
    <div class="footer">
      <div class="container">
        <div class="row py-4">
          <div class="col-lg-3">
            <h5>Bengkel Ikan</h5>
            <ul class="nav flex-column mt-3">
              <li class="nav-item"><a style="color: #ecf0f1" href="<?php echo $base_url; ?>/gizi">Kandungan Gizi Ikan</a></li>
              <li class="nav-item"><a style="color: #ecf0f1" href="<?php echo $base_url; ?>/budidaya">Budidaya Ikan</a></li>
               <li class="nav-item"><a style="color: #ecf0f1" href="<?php echo $base_url; ?>/dashboard/daftar-seller">Menjadi Seller</a></li>
            </ul>
            <div id="histats_counter"></div>
          </div>
          <div class="col-lg-3 mt-lg-0 mt-4">
            <h5>Kategori</h5>
            <ul class="nav flex-column mt-3">
              <?php 
              $sql1=mysqli_query($conn, "SELECT * FROM kategori_utama");
              while ($data1=mysqli_fetch_assoc($sql1)) {
            ?>
            <li class="nav-item">
              <a  style="color: #ecf0f1"  href="<?php echo $base_url; ?>/<?php echo str_replace(" ","-", $data1[nama_kategori_utama]); ?>"><?php echo ucwords($data1['nama_kategori_utama']); ?></a>
            </li>
            <?php }  ?>
            </ul>
          </div>
          <div class="col-lg-3 mt-lg-0 mt-4">
            <h5 >Sosial</h5>
            <ul class="nav mt-3">
              <li class="nav-item pr-2"><a style="color: #ecf0f1" class="btn btn-primary" href="https://www.facebook.com/Bengkel-Ikan-345191455955252/"><span class="fa fa-facebook"></span></a></li>
              <li class="nav-item pr-2"><a class="btn btn-primary" style="color: #ecf0f1" href="https://plus.google.com/u/0/105556190294215458588"><span class="fa fa-google-plus"></span></a></li>
              <li class="nav-item pr-2"><a class="btn btn-primary" style="color: #ecf0f1" href="https://www.instagram.com/officialbengkelikan/?hl=id"><span class="fa fa-instagram"></span></a></li>
              <li class="nav-item pr-2"><a class="btn btn-primary" style="color: #ecf0f1" href="https://twitter.com/Bengkelikan11"><span class="fa fa-twitter"></span> </a></li>
            </ul>
          </div>
          <div class="col-lg-3 mt-lg-0 mt-4">
            <h5>Hubungi Kami</h5>
            <ul class="nav mt-3">
              <p class="text-white">officialbengkelikan@gmail.com</p>
              <p class="text-white">Gedung Jurusan TI Politeknik Negeri Jember Jl. Mastrip PO.BOX 164 Jember Jawa Timur 68101 Indonesia </p>
              <p class="text-white">+6282 147 613 330 </p>
            </ul>
          </div>
        </div>
      </div><!-- /.container -->
    </div>
    <div class="footer-bawah">
      <div class="container">
        <div class="row py-2 justify-content-center">
          <div class="col-lg-6">
            <p class="text-center ">Copyright &copy; 2017 <a style="color: #ecf0f1" href="">BengkelIkan.com</a> - Design by Team Bengkel Ikan</p>
          </div>
        </div> 
      </div><!-- /.container -->
    </div>
    <!-- footer -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/js/vendor/popper.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/js/vendor/holder.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/js/vendor/wow.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/js/vendor/star-rating2.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/js/custom.min.js"></script>
    <script src="<?php echo $base_url; ?>/plugins/select2/select2.full.min.js"></script>
    <script type="text/javascript">
      /*// screen loader
      $(window).load(function() {
          "use strict";
          $('.screen-loader').fadeOut('slow');
      });

      // preload
      $(document).ready(function() {
          "use strict";
          $('#preload').css({
              display: 'table'
          });
      });

      // preload function
      $(window).load(preLoader);
      "use strict";
      function preLoader() {
          setTimeout(function() {
              $('#preload').delay(1000).fadeOut(1500);
          });
      };*/
    </script>
    <script type="text/javascript">
      var url = "<?php echo $base_url ?>";
      $(function () {
          $('.ptooltip').tooltip();
          $("#select1").select2();
          $("#select2").select2();
          $("#select3").select2();
          $("#select4").select2();
          $('#wysiwyg').froalaEditor({
          // Set the file upload URL.
          imageUploadURL: url+'/upload_image.php',
   
          imageUploadParams: {
            id: 'my_editor'
          },
          heightMin: 200
        });
      });

      $(document).ready(function($) {
        $(window).scroll(function(){
          setTimeout(function() { 
            var scroll = $(window).scrollTop();
            console.log(scroll);
            if (scroll < 1) {
              $("#menutengah1").removeClass("fixed-top");
            }else if (scroll > 0) {
              $("#menutengah1").addClass("fixed-top");
            }
          },0);
        });
      });
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
          var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
          s1.async=true;
          s1.src='https://embed.tawk.to/5a27b9ecd0795768aaf8da4b/default';
          s1.charset='UTF-8';
          s1.setAttribute('crossorigin','*');
          s0.parentNode.insertBefore(s1,s0);
      })();
    </script>
    <!--End of Tawk.to Script-->
    <script type="text/javascript">
      var base_url = "<?php echo $base_url ?>";
      $(document).ready(function(){ 
        $('[data-plugin="select2"]').select2();
        $("#loading").hide();
        <?php if($datauser[kabupaten]==""){ ?>
          $(".pilih-kabupaten-user").hide();
          $(".label-kab").hide();
        <?php } ?>
        <?php if($datauser[kecamatan]==""){ ?>
          $(".pilih-kecamatan-user").hide();
          $(".label-kec").hide();
        <?php } ?>
        <?php if($datauser[desa]==""){ ?>
          $(".pilih-kelurahan-user").hide();
          $(".label-kel").hide();
        <?php } ?>
        $(".pilih-propinsi-user").change(function(){  
          $("#loading").show(); 
          $.ajax({
            type: "POST", 
            url: base_url+"/pages/user/modul/kabupaten.php", 
            data: {provinsi : $(".pilih-propinsi-user").val()}, 
            dataType: "json",
            beforeSend: function(e) {
              if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
              }
            },
            success: function(response){ 
              setTimeout(function(){
                $('[data-plugin="select3"]').select2();
                $("#loading").hide(); 
                $(".label-kab").show();
                $(".pilih-kabupaten-user").html(response.data_kota_user).show();
              }, 3000);
            },
            error: function (xhr, ajaxOptions, thrownError) { 
              alert(thrownError); 
            }
          });
        });

        $(".pilih-kabupaten-user").change(function(){  
          $("#loading").show(); 
          $.ajax({
            type: "POST", 
            url: base_url+"/pages/user/modul/kecamatan.php", 
            data: {kabupaten : $(".pilih-kabupaten-user").val()}, 
            dataType: "json",
            beforeSend: function(e) {
              if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
              }
            },
            success: function(response){ 
              setTimeout(function(){
                $('[data-plugin="select4"]').select2();
                $("#loading").hide(); 
                $(".label-kec").show();
                $(".pilih-kecamatan-user").html(response.data_kec_user).show();
              }, 3000);
            },
            error: function (xhr, ajaxOptions, thrownError) { 
              alert(thrownError); 
            }
          });
        });

        $(".pilih-kecamatan-user").change(function(){  
          $("#loading").show(); 
          $.ajax({
            type: "POST", 
            url: base_url+"/pages/user/modul/kelurahan.php", 
            data: {kecamatan : $(".pilih-kecamatan-user").val()}, 
            dataType: "json",
            beforeSend: function(e) {
              if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
              }
            },
            success: function(response){ 
              setTimeout(function(){
                $('[data-plugin="select5"]').select2();
                $("#loading").hide(); 
                $(".label-kel").show();
                $(".pilih-kelurahan-user").html(response.data_desa_user).show();
              }, 3000);
            },
            error: function (xhr, ajaxOptions, thrownError) { 
              alert(thrownError); 
            }
          });
        });
      });
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112005679-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-112005679-1');
    </script>
    <!-- Histats.com  START  (aync)-->
    <script type="text/javascript">
      var _Hasync= _Hasync|| [];
      _Hasync.push(['Histats.start', '1,3984869,4,2038,130,60,00010010']);
      _Hasync.push(['Histats.fasi', '1']);
      _Hasync.push(['Histats.track_hits', '']);
      (function() {
        var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
        hs.src = ('//s10.histats.com/js15_as.js');
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
      })();
    </script>
    <noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?3984869&101" alt="cool hit counter" border="0"></a></noscript>
    <!-- Histats.com  END  -->
  </body>
</html>