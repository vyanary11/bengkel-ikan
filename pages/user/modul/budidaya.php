<?php 
    include "../../../bin/koneksi.php";
    $sql=mysqli_query($conn, "SELECT * FROM budidaya_ikan left join ikan on ikan.kd_ikan=budidaya_ikan.kd_ikan WHERE ikan.kd_ikan=$_POST[kdikan]");
    $data=mysqli_fetch_assoc($sql);
?> 
<div class="row mb-5 bg-white">
  <div class="col-lg-12 p-5">
    <h2><?php echo $data[nama_ikan]; ?></h2>
    <img src="<?php echo $base_url ?>/assets/images/ikan/<?php echo $data[gambar_ikan] ?>" class="img-thumbnail">
    <h4 class="mt-5">Deskripsi</h4>
    <p class="text-justify">
      <?php echo $data[deskripsi]; ?>
    </p>
    <h4 class="mt-5">Cara Budidaya</h4>
    <p class="text-justify">
      <?php echo $data[budidaya]; ?>
    </p>
  </div>
</div>