  <?php 
    $sql_user=mysqli_query($conn, "SELECT * FROM user WHERE kd_user='$_SESSION[loginadmin]'");
    $data_user=mysqli_fetch_assoc($sql_user);
  ?>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="<?php echo $base_url; ?>/dashboard"><?php echo "Dashboard <font class='font-weight-bold'>".ucwords($data_user[level_user]) ?></font></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item <?php echo (!isset($pages)) ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo $base_url; ?>/dashboard/">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <?php if ($data_user[level_user]=="seller") { ?>
        <li class="nav-item <?php echo ($pages=="barang") ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Barang">
          <a class="nav-link" href="<?php echo $base_url; ?>/dashboard/barang">
            <i class="fa fa-fw fa-archive"></i>
            <span class="nav-link-text">Barang</span>
          </a>
        </li>
        <li class="nav-item <?php echo ($pages=="pesanan") ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Pesanan">
          <a class="nav-link" href="<?php echo $base_url; ?>/dashboard/pesanan">
            <i class="fa fa-fw fa-shopping-basket"></i>
            <span class="nav-link-text">Pesanan</span>
          </a>
        </li>
        <?php }else{ ?>
        <li class="nav-item <?php echo ($pages=="berita") ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Berita">
          <a class="nav-link" href="<?php echo $base_url; ?>/dashboard/berita">
            <i class="fa fa-fw fa-newspaper-o"></i>
            <span class="nav-link-text">Berita</span>
          </a>
        </li>
        <li class="nav-item <?php echo ($pages=="gizi") ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Kandungan Gizi Ikan">
          <a class="nav-link" href="<?php echo $base_url; ?>/dashboard/gizi">
            <i class="fa fa-fw fa-medkit"></i>
            <span class="nav-link-text">Kandungan Gizi Ikan</span>
          </a>
        </li>
        <li class="nav-item <?php echo ($pages=="budidaya") ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Budidaya">
          <a class="nav-link" href="<?php echo $base_url; ?>/dashboard/budidaya">
            <i class="fa fa-fw fa-cutlery"></i>
            <span class="nav-link-text">Budidaya Ikan</span>
          </a>
        </li>
        <li class="nav-item <?php echo ($pages=="pesanan") ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Pesanan">
          <a class="nav-link" href="<?php echo $base_url; ?>/dashboard/pesanan">
            <i class="fa fa-fw fa-shopping-basket"></i>
            <span class="nav-link-text">Pesanan</span>
          </a>
        </li>
        <li class="nav-item <?php echo ($pages=="konfirmasi") ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="konfirmasi">
          <a class="nav-link" href="<?php echo $base_url; ?>/dashboard/konfirmasi">
            <i class="fa fa-fw fa-check-square-o"></i>
            <span class="nav-link-text">Konfirmasi Pembayaran</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Data Master">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti1" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-database"></i>
            <span class="nav-link-text">Data Master</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti1">
            <li>
              <a href="<?php echo $base_url; ?>/dashboard/user""><i class="fa fa-fw fa-angle-right"></i>Data Users</a>
            </li>
            <li>
              <a href="<?php echo $base_url; ?>/dashboard/kategori""><i class="fa fa-fw fa-angle-right"></i>Data Kategori</a>
            </li>
            <li>
              <a href="<?php echo $base_url; ?>/dashboard/jenis-ikan""><i class="fa fa-fw fa-angle-right"></i>Data Jenis Ikan</a>
            </li>
            <li>
              <a href="<?php echo $base_url; ?>/dashboard/ikan""><i class="fa fa-fw fa-angle-right"></i>Data Ikan</a>
            </li>
          </ul>
        </li>
        <?php } ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pengaturan">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cogs"></i>
            <span class="nav-link-text">Pengaturan</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a href="<?php echo $base_url ?>/dashboard/setting-profil"><span class="fa fa-fw fa-angle-right"></span>Profil</a>
            </li>
            <li>
              <a data-toggle="modal" href="#exampleModal"><span class="fa fa-fw fa-angle-right"></span>Logout</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $data_user[nama_lengkap]; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="<?php echo $base_url ?>/dashboard/setting-profil">Setting Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" data-toggle="modal" href="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper" style="background-color: #F6F6F6">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo $base_url; ?>/dashboard/">Dashboard</a>
        </li>
        <?php if(isset($action)){ ?>
          <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>/dashboard/<?php echo $pages ?>"><?php echo str_replace("-", " ", ucwords($pages)); ?></a></li>
          <li class="breadcrumb-item active"><?php echo str_replace("-", " ", ucwords($action)); ?></li>
        <?php }else{ ?>
          <li class="breadcrumb-item active"><?php echo (!isset($pages)) ? 'My Dashboard' : str_replace("-", " ", ucwords($pages)) ; ?></li>
        <?php } ?>
      </ol>
      <div class="row justify-content-centers">
        <div class="col-lg-12 coba">
          <?php 
            $msg=ucwords(str_replace("-", " ", $_GET[msg]));
            if (isset($_GET[msg])) {
              if (preg_match('/berhasil/', $_GET[msg])) {
                ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><span class="fa fa-check-circle"></span> Berhasil</strong> <?php echo ucwords(str_replace("Berhasil", " ", $msg)); ?>.
                    <button type="button" class="close" data-dismiss="alert" da aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <?php
              }else{
                ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><span class="fa fa-times-circle"></span> Gagal</strong> <?php echo ucwords(str_replace("Gagal", "", $msg)); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <?php
              }
            }
          ?>
        </div>
      </div>
      <?php 
        if ($data_user[level_user]=="seller") {
          if($pages=="barang"){
            if($action=="tambah"){
              include "./pages/barang/tambah-produk.php";
            }elseif($action=="edit"){
              include "./pages/barang/edit-produk.php";
            }else{
              include "./pages/barang/produk.php";
            }
          }elseif ($pages=="pesanan") {
            if ($action=="detail-pesanan") {
              include "./pages/pesanan/detail-pesanan.php";
            }else{
              include "./pages/pesanan/terima-pesanan.php";
            }
          }elseif($pages=="setting-profil"){
            include "./pages/setting-profil.php";
          }elseif(!isset($pages)){
            include "./pages/dashboard.php";
          }else{
            include "../pages/404.php";
          } 
        }else{
          if ($pages=="pesanan") {
            if ($action=="detail-pesanan") {
              include "./pages/pesanan/detail-pesanan.php";
            }else{
              include "./pages/pesanan/pesanan.php";
            }
          }elseif ($pages=="berita") {
            if ($action=="tambah") {
              include "./pages/berita/tambah-berita.php";
            }elseif($action=="edit"){
              include "./pages/berita/edit-berita.php";
            }elseif($action=="detail"){
              include "./pages/berita/detail-berita.php";
            }else{
              include "./pages/berita/berita.php";
            }
          }elseif($pages=="gizi"){
            if ($action=="tambah") {
              include "./pages/gizi/tambah-gizi.php";
            }elseif($action=="edit"){
              include "./pages/gizi/edit-gizi.php";
            }elseif($action=="detail"){
              include "./pages/gizi/detail-gizi.php";
            }else{
              include "./pages/gizi/gizi.php";
            }
          }elseif($pages=="budidaya"){
            if ($action=="tambah") {
              include "./pages/budidaya/tambah-budidaya.php";
            }elseif($action=="edit"){
              include "./pages/budidaya/edit-budidaya.php";
            }elseif($action=="detail"){
              include "./pages/budidaya/detail-budidaya.php";
            }else{
              include "./pages/budidaya/budidaya.php";
            }
          }elseif($pages=="kategori"){
            if ($action=="tambah") {
              include "./pages/kategori/tambah-kategori.php";
            }elseif($action=="edit"){
              include "./pages/kategori/edit-kategori.php";
            }else{
              include "./pages/kategori/kategori.php";
            }
          }elseif($pages=="jenis-ikan"){
            if ($action=="tambah") {
              include "./pages/jenis-ikan/tambah-jenis-ikan.php";
            }elseif($action=="edit"){
              include "./pages/jenis-ikan/edit-jenis-ikan.php";
            }else{
              include "./pages/jenis-ikan/jenis-ikan.php";
            }
          }elseif($pages=="ikan"){
            if ($action=="tambah") {
              include "./pages/ikan/tambah-ikan.php";
            }elseif($action=="edit"){
              include "./pages/ikan/edit-ikan.php";
            }else{
              include "./pages/ikan/ikan.php";
            }
          }elseif($pages=="konfirmasi"){
            if($action=="detail"){
              include "./pages/konfirmasi/detail.php";
            }else{
              include "./pages/konfirmasi/konfirmasi.php";
            }
          }elseif($pages=="setting-profil"){
            include "./pages/setting-profil.php";
          }elseif(!isset($pages)){
            include "./pages/dashboard.php";
          }elseif($pages=="user"){
            if ($action=="tambah-admin") {
              include "./pages/user/tambah-admin.php";
            }elseif($action=="detail-user"){
              include "./pages/user/detail-user.php";
            }else{
              include "./pages/user/user.php";
            }
          }else{
            include "../pages/404.php";
          } 
        }
      ?>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © BengkelIkan.com 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Keluar ?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Pilih Logout untuk mengakhiri sesi anda.</div>
          <div class="modal-footer">
            <a class="btn btn-primary" href="<?php echo $base_url; ?>/dashboard/bin/logout.php">Logout</a>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>