<div class="row mt-5 mb-3">
  <div class="col-lg-12">
    <nav aria-label="breadcrumb" role="navigation">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Budidaya Ikan</li>
      </ol>
    </nav>
  </div>
</div>
<div class="row">
  <div class="col-lg-3">
    <div class="form-group">
      <label>Pilih Jenis Ikan*</label>
      <select name="jenis" class="form-control pilih-jenis" data-plugin="select2" id="select2">
        <option value="">--Pilih Jenis Ikan--</option>
        <?php
            $sql_jenis = mysqli_query($conn, "SELECT * FROM jenis_ikan");
            while($data_jenis=mysqli_fetch_array($sql_jenis)){
        ?>
            <option value="<?php echo $data_jenis['kd_jenis_ikan'] ?>"><?php echo ucwords($data_jenis['jenis_ikan']) ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
</div>
<div class="tempat-ikan">
  <?php include "./pages/user/modul/ikan-empty.php" ?>
</div>