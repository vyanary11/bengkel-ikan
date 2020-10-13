<?php 
  $sql=mysqli_query($conn, "SELECT * FROM user WHERE kd_user='$_SESSION[loginadmin]'");
  $data=mysqli_fetch_assoc($sql);
?>
<form action="<?php echo $base_url ?>/dashboard/bin/user/ubah-profil.php?id=<?php echo $_SESSION[loginadmin]; ?>" enctype="multipart/form-data" method="post">
  <div class="row my-5 justify-content-center">
    <div class="col-lg-2 fp-setting">
      <img src="<?php echo $base_url ?>/assets/images/user/<?php echo $data[fp] ?>" class="img-fluid">
      <div class="fp-setting-blur" data-toggle="modal" data-target="#gantifoto">Ganti Foto</div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-user"></i> Informasi Pribadi</div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" id="nama" required placeholder="Masukkan Nama Lengkap" value="<?php echo $data[nama_lengkap] ?>">
              </div>
              <div class="form-group">
                  <label for="tgl-lahir">Tanggal Lahir</label>
                  <input type="date" class="form-control" name="tgl_lahir" id="tgl-lahir" value="<?php echo date($data[tanggal_lahir]);?>">
              </div>
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" data-plugin="select2" type="text" class="form-control" style="width: 100%">
                    <?php if($data['jenis_kelamin']=="Laki-Laki"){ ?>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    <?php }elseif($data['jenis_kelamin']=="Perempuan"){ ?>
                        <option value="Perempuan">Perempuan</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                    <?php }else{ ?>
                      <option value="">--Pilih Jenis Kelamin--</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="no_telp">No Telpon</label>
                <input type="text" class="form-control" name="no_telp" id="no_telp" required value="<?php echo $data[no_telp] ?>" placeholder="Masukkan No. Telpon">
              </div>
              <div class="form-group">
                    <label>Bio</label>
                    <textarea name="bio" required class="form-control" rows="3" placeholder="Masukkan Bio / Tentang Anda"><?php echo $data['bio'] ?></textarea>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-lock"></i> Konfirmasi Perubahan</div>
            <div class="card-body">
              <div class="row mt-3 mb-3">
                <div class="col-lg-12">
                  <div class="form-group">
                    <input name="password1" type="password" class="form-control" placeholder="Masukkan password" required>
                  </div>
                </div>
              </div>
              <button type="submit" name="ubah_info" class="btn btn-primary"><span class="fa fa-save"></span> Simpan Perubahan</button>
              <a href="#ubahpass" class="btn btn-danger" data-toggle="modal"><span class="fa fa-key"></span> Ubah Password</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-map-marker"></i> Alamat</div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Provinsi</label>
                <select name="provinsi" data-plugin="select2" class="form-control pilih-propinsi-dashboard" style="width: 100%">
                    <option value="">--Pilih Provinsi--</option>
                    <?php
                        $sql_proponsi = mysqli_query($conn, "SELECT * FROM propinsi");
                        while($data_propinsi=mysqli_fetch_array($sql_proponsi)){
                    ?>
                        <option <?php if($data['provinsi']==$data_propinsi['kodePropinsi']){ ?> selected=selected <?php } ?> value="<?php echo $data_propinsi['kodePropinsi'] ?>"><?php echo $data_propinsi['namaPropinsi'] ?></option>
                    <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="label-kab">Kabupaten / Kota</label>
                <select name="kabupaten" data-plugin="select<?php if($data[kabupaten]==""){echo 3;}else{echo 2;} ?>" class="form-control pilih-kabupaten-dashboard" style="width: 100%;">
                    <option value="">- Pilih Kabupaten -</option>
                    <?php if($data['kabupaten']!=""){ 
                      $sql_kabupaten = mysqli_query($conn, "SELECT * from kabupaten where kodeKabKota='$data[kabupaten]'");
                      while($data_kabupaten=mysqli_fetch_array($sql_kabupaten)){
                    ?>
                      <option <?php if($data['kabupaten']==$data_kabupaten['kodeKabKota']){ ?> selected=selected <?php } ?> value="<?php echo $data_kabupaten['kodeKabKota'] ?>"><?php echo $data_kabupaten['namaKabKota'] ?></option>
                    <?php } } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="label-kec">Kecamatan</label>
                <select name="kecamatan" data-plugin="select<?php if($data[kecamatan]==""){echo 4;}else{echo 2;} ?>" class="form-control pilih-kecamatan-dashboard" style="width: 100%;">
                    <option value="">- Pilih Kecamatan -</option>
                    <?php if($data['kecamatan']!=""){ 
                      $sql_kecamatan = mysqli_query($conn, "SELECT * from kecamatan where kodeKecamatan='$data[kecamatan]'");
                      while($data_kecamatan=mysqli_fetch_array($sql_kecamatan)){
                    ?>
                      <option <?php if($data['kecamatan']==$data_kecamatan['kodeKecamatan']){ ?> selected=selected <?php } ?> value="<?php echo $data_kecamatan['kodeKecamatan'] ?>"><?php echo $data_kecamatan['namaKecamatan'] ?></option>
                    <?php } } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="label-kel">Desa / Kelurahan</label>
                <select name="desa" data-plugin="select<?php if($data[desa]==""){echo 5;}else{echo 2;} ?>" class="form-control pilih-kelurahan-dashboard" style="width: 100%;">
                  <option value="">- Pilih Desa / Kelurahan -</option>
                    <?php if($data['desa']!=""){
                        $sql_kelurahan = mysqli_query($conn, "SELECT * from kelurahan where kodeKelurahan='$data[desa]'");
                        while($data_kelurahan=mysqli_fetch_array($sql_kelurahan)){
                    ?>
                        <option <?php if($data['desa']==$data_kelurahan['kodeKelurahan']){ ?> selected=selected <?php } ?> value="<?php echo $data_kelurahan['kodeKelurahan'] ?>"><?php echo $data_kelurahan['namaKelurahan'] ?></option>
                    <?php } } ?>
                </select>
              </div>
              <div id="loading" style="margin-top: 15px;">
                <img src="<?php echo $base_url ?>/assets/images/loading.gif" width="18"> <small>Loading...</small>
              </div>
              <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea name="alamat" required class="form-control" rows="3" placeholder="Alamat Lengkap"><?php echo $data['alamat'] ?></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- modal -->
<div class="modal fade" id="gantifoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganti Foto Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo $base_url ?>/dashboard/bin/user/ubah-profil.php?id=<?php echo $_SESSION[loginadmin] ?>" enctype="multipart/form-data" method="post">
      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-lg-3">
            <img class="card-img-top img-fluid mb-5" src="<?php echo $base_url; ?>/assets/images/user/<?php echo $data[fp]; ?>" alt="Card image cap" id="preview_fp">
          </div>
        </div>
        <div class="row justify-content-center mb-3">
          <div class="col-lg-6">
            <label class="custom-file">
          <input type="file" id="file2" name="fp" accept="image/*"  onchange="tampilkanPreview(this,'preview_fp')" class="custom-file-input">
          <span class="custom-file-control"></span>
        </label>
          </div>
        </div>
        <label>Konvirmasi Perubahan</label>
    <input name="password1" type="password" class="form-control" placeholder="Masukkan password" style="width:60%" required>
      </div>
      <div class="modal-footer">
        <button type="submit" name="simpan_foto" class="btn btn-primary">Simpan Perubahan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ubahpass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo $base_url ?>/dashboard/bin/user/ubah-password.php?id=<?php echo $_SESSION[loginadmin]; ?>" enctype="multipart/form-data" method="post">
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
            <label for="passbaru">Password Baru</label>
            <input type="password" class="form-control" name="passbaru" id="passbaru" required placeholder="Masukkan Password Baru">
          </div>
          <div class="form-group">
            <label for="ulangipassbaru">Ulangi Password Baru</label>
            <input type="password" class="form-control" name="passbaru1" id="ulangipassbaru" required placeholder="Ulangi Password Baru">
          </div>
          <div class="form-group">
            <label>Konfirmasi Perubahan</label>
          <input name="password1" type="password" class="form-control" placeholder="Masukkan password lama" required>
          </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="ubah_pass" class="btn btn-primary">Simpan Perubahan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
  </div>
</div>