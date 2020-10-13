<div class="row mt-5 mb-3">
  <div class="col-lg-12">
    <nav aria-label="breadcrumb" role="navigation">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kandungan Gizi Ikan</li>
      </ol>
    </nav>
  </div>
</div>
<div class="row">
  <div class="col-lg-3">
    <label>Pilih Ikan *</label>
    <select name="ikan" class="form-control pilih-ikan" data-plugin="select2" id="select2">
      <option value="">--Pilih Ikan--</option>
      <?php
          $sql_ikan = mysqli_query($conn, "SELECT * FROM ikan WHERE kd_jenis_ikan=1");
          while($data_ikan=mysqli_fetch_array($sql_ikan)){
            $sql_budidaya=mysqli_query($conn, "SELECT * FROM gizi_ikan where kd_ikan='$data_ikan[kd_ikan]'");
              ?>
                  <option <?php if(mysqli_num_rows($sql_budidaya)==0){ echo "disabled"; } ?> value="<?php echo $data_ikan['kd_ikan'] ?>"><?php echo ucwords($data_ikan['nama_ikan']) ?> <?php if(mysqli_num_rows($sql_budidaya)==0){ echo "( Belum Terdata )"; } ?></option>
      <?php } ?>
    </select>
  </div>
</div> 
<div id="loading" style="margin-top: 15px;">
  <img src="<?php echo $base_url ?>/assets/images/loading.gif" width="18"> <small>Loading...</small>
</div>
<div class="row bg-white tempat-gizi my-5">
  <?php include "./pages/user/modul/gizi-empty.php" ?>
</div>

