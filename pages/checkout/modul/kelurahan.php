<?php 
    include "../../../bin/koneksi.php";
?> 

<div class="form-group row">
    <label for="Kelurahan" class="col-lg-4 col-form-label">Desa / Kelurahan</label>
    <div class="col-lg-8">
        <select name="desa" required class="form-control" data-plugin="select2" id="select9" style="width: 100%;">
        <option value="">---&nbsp;&nbsp;&nbsp;  Pilih Kelurahan  &nbsp;&nbsp;&nbsp;---</option>
        <?php
            $sql_kelurahan = mysqli_query($conn, "select * from kelurahan where kodeKecamatan='$_POST[kodeKecamatan]'");
            while($data_kelurahan=mysqli_fetch_array($sql_kelurahan)){
        ?>
            <option value="<?php echo $data_kelurahan['kodeKelurahan'] ?>"><?php echo $data_kelurahan['namaKelurahan'] ?></option>
        <?php } ?>
    </select>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="<?php echo $base_url; ?>/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#select9").select2();
    });
</script>