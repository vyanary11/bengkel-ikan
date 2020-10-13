<?php

include("koneksi.php");

$email = $_POST['email'];
$pass = md5($_POST['password']);

if(isset($_POST['masuk'])){
    $sql = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' and password='$pass' and level_user!='user'");
    $data = mysqli_fetch_array($sql);
    $num = mysqli_num_rows($sql);
    
    if($num==0 or $data['password']!=$pass or $data[kode_aktivasi]!=0){
        ?>
            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/masuk/msg=gagalmasuk">  
        <?php 
    }else{
        $_SESSION['loginadmin'] = $data['kd_user'];
        ?>
            <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/">  
        <?php 
    } 
} 

?>