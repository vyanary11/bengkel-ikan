<?php 
    include "../../../bin/koneksi.php";
    $sql=mysqli_query($conn, "SELECT * FROM gizi_ikan left join ikan on ikan.kd_ikan=gizi_ikan.kd_ikan WHERE gizi_ikan.kd_ikan='$_POST[kdikan]'");
    $data=mysqli_fetch_assoc($sql);
?>
  <div class="col-lg-12 p-5 ">
  <h3>Berikut Tabel Kandungan Gizi <font class="font-weight-bold"><?php echo $data[nama_ikan]; ?></font></h3>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-5 pl-0 my-3">
      <img src="<?php echo $base_url ?>/assets/images/ikan/<?php echo $data[gambar_ikan] ?>" class="img-thumbnail">
    </div>
    <div class="col-lg-7 pl-0 pt-3">
      <table class="table table-bordered">
        <thead class="table-active">
          <tr>
            <th scope="col">Komposisi</th>
            <th scope="col">Kadar (%)</th>
            <th scope="col">Satuan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Kalori</th>
            <td><?php 
            echo $data[kalori]; ?> %</td>
            <td>(kal)</td>
          </tr>
          <tr>
            <th scope="row">Protein</th>
            <td><?php 
            echo $data[protein]; ?> %</td>
            <td>(g)</td>
          </tr>
          <tr>
            <th scope="row">Lemak</th>
            <td><?php 
            echo $data[lemak]; ?> %</td>
            <td>(g)</td>
          </tr>
          <tr>
            <th scope="row">Karbohidrat</th>
            <td><?php 
            echo $data[karbohidrat]; ?> %</td>
            <td>(g)</td>
          </tr>
          <tr>
            <th scope="row">Kalsium</th>
            <td><?php 
            echo $data[kalsium]; ?> %</td>
            <td>(mg)</td>
          </tr>
          <tr>
            <th scope="row">Fosfor</th>
            <td><?php 
            echo $data[fosfor]; ?> %</td>
            <td>(mg)</td>
          </tr>
          <tr>
            <th scope="row">Besi</th>
            <td><?php 
            echo $data[besi]; ?> %</td>
            <td>(g)</td>
          </tr>
          <tr>
            <th scope="row">Vitamin A</th>
            <td><?php 
            echo $data[vit_a]; ?> %</td>
            <td>A (SI)</td>
          </tr>
          <tr>
            <th scope="row">Vitamin B1</th>
            <td><?php 
            echo $data[vit_b1]; ?> %</td>
            <td>B1 (mg)</td>
          </tr>
          <tr>
            <th scope="row">Vitamin C</th>
            <td><?php 
            echo $data[vit_c]; ?> %</td>
            <td>C (mg)</td>
          </tr>
        </tbody>
      </table>
    </div>
      </div>
    </div>
  </div>