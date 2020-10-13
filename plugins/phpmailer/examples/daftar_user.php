<?php
$emailuser=$data_user[email];
$namauser=$data_user[nama];
if ($data_user[level_user]=="seller") {
  $url_aktivasi='<a href="'.$base_url.'/dashboard/bin/aktivasi.php?kd_user='.$data_user[kd_user].'&kode_aktivasi='.$data_user[kode_aktivasi].'" class="btn btn-primary">Aktivasi Akun</a>';
}else{
   $url_aktivasi='<a href="'.$base_url.'/bin/aktivasi.php?kd_user='.$data_user[kd_user].'&kode_aktivasi='.$data_user[kode_aktivasi].'" class="btn btn-primary">Aktivasi Akun</a>';
}
$msg = '
<!DOCTYPE html>
<html>
<head>
  <title>Selamat datang di Bengkel Ikan</title>
  <style type="text/css">
    .card {
      position: relative;
      display: -ms-flexbox;
      display: flex;
      -ms-flex-direction: column;
          flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 1px solid rgba(0, 0, 0, 0.125);
      border-radius: 0.25rem;
    }

    .card-body {
      -ms-flex: 1 1 auto;
          flex: 1 1 auto;
      padding: 1.25rem;
    }

    .card-title {
      margin-bottom: 0.75rem;
    }

    .card-text:last-child {
      margin-bottom: 0;
    }

    .card-header {
      padding: 0.75rem 1.25rem;
      margin-bottom: 0;
      background-color: rgba(0, 0, 0, 0.03);
      border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }

    .card-header:first-child {
      border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
    }
    .container {
      margin-right: auto;
      margin-left: auto;
      padding-right: 15px;
      padding-left: 15px;
      width: 100%;
    }

    @media (min-width: 576px) {
      .container {
        max-width: 540px;
      }
    }

    @media (min-width: 768px) {
      .container {
        max-width: 720px;
      }
    }

    @media (min-width: 992px) {
      .container {
        max-width: 960px;
      }
    }

    @media (min-width: 1200px) {
      .container {
        max-width: 1140px;
      }
    }

    .row {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-wrap: wrap;
          flex-wrap: wrap;
      margin-right: -15px;
      margin-left: -15px;
    }
    .justify-content-center {
      -ms-flex-pack: center !important;
          justify-content: center !important;
    }
    .my-5 {
      margin-top: 3rem !important;
      margin-bottom: 3rem !important;
    }
    .mb-5 {
      margin-bottom: 3rem !important;
    }
    .mt-5 {
      margin-top: 3rem !important;
    }
    .mt-3 {
      margin-top: 1rem !important;
    }
    .bg-primary {
      background-color: #007bff !important;
    }
    .btn {
      display: inline-block;
      font-weight: normal;
      text-align: center;
      white-space: nowrap;
      vertical-align: middle;
      -webkit-user-select: none;
         -moz-user-select: none;
          -ms-user-select: none;
              user-select: none;
      border: 1px solid transparent;
      padding: 0.5rem 0.75rem;
      font-size: 1rem;
      line-height: 1.25;
      border-radius: 0.25rem;
      transition: all 0.15s ease-in-out;
    }
    .btn:focus, .btn:hover {
      text-decoration: none;
    }

    .btn:focus, .btn.focus {
      outline: 0;
      box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
    }

    .btn.disabled, .btn:disabled {
      opacity: .65;
    }

    .btn:active, .btn.active {
      background-image: none;
    }

    a.btn.disabled,
    fieldset[disabled] a.btn {
      pointer-events: none;
    }
    .btn-primary {
      color: #fff;
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      color: #fff;
      background-color: #0069d9;
      border-color: #0062cc;
    }

    .btn-primary:focus, .btn-primary.focus {
      box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.5);
    }

    .btn-primary.disabled, .btn-primary:disabled {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:active, .btn-primary.active,
    .show > .btn-primary.dropdown-toggle {
      background-color: #0069d9;
      background-image: none;
      border-color: #0062cc;
    }
    p {
      margin-top: 0;
      margin-bottom: 1rem;
    }
    a {
      color: #007bff;
      text-decoration: none;
      background-color: transparent;
      -webkit-text-decoration-skip: objects;
    }

    a:hover {
      color: #0056b3;
      text-decoration: underline;
    }

    a:not([href]):not([tabindex]) {
      color: inherit;
      text-decoration: none;
    }

    a:not([href]):not([tabindex]):focus, a:not([href]):not([tabindex]):hover {
      color: inherit;
      text-decoration: none;
    }

    a:not([href]):not([tabindex]):focus {
      outline: 0;
    }
    h1, h2, h3, h4, h5, h6,
    .h1, .h2, .h3, .h4, .h5, .h6 {
      margin-bottom: 0.5rem;
      font-family: inherit;
      font-weight: 500;
      line-height: 1.1;
      color: inherit;
    }

    h4, .h4 {
      font-size: 1.5rem;
    }
    .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col,
    .col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm,
    .col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md,
    .col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg,
    .col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl,
    .col-xl-auto {
      position: relative;
      width: 100%;
      min-height: 1px;
      padding-right: 15px;
      padding-left: 15px;
    }
    .col-6 {
      -ms-flex: 0 0 50%;
          flex: 0 0 50%;
      max-width: 50%;
    }
    .text-white {
      color: #fff !important;
    }
    .font-weight-bold {
      font-weight: bold;
    }
    .text-center {
      text-align: center !important;
    }
    .col-4 {
      -ms-flex: 0 0 33.333333%;
          flex: 0 0 33.333333%;
      max-width: 33.333333%;
    }
    html {
      box-sizing: border-box;
      font-family: sans-serif;
      line-height: 1.15;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
      -ms-overflow-style: scrollbar;
      -webkit-tap-highlight-color: transparent;
    }
    body {
      margin: 0;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      font-size: 1rem;
      font-weight: normal;
      line-height: 1.5;
      color: #212529;
      background-color: #fff;
    }
    </style>  
</head>
<body>
	<div class="container">
    <div class="row justify-content-center my-5">
      <div class="col-6" style="margin:0 auto;">
        <div class="card border-bottom-0">
          <div class="card-header bg-primary text-white text-center" style="width:100%;">
              <h4 class="card-title">Selamat datang di Bengkel Ikan</h4>
          </div>
        </div>
        <div class="card border-top-0">
           <div class="card-body">
            <p class="card-text">Terima kasih telah bergabung dengan Bengkel Ikan. Berikut adalah detail akun Anda. Pastikan Anda menyimpannya dengan aman.</p>
            <table>
            <tr>
              <td class="font-weight-bold">Nama</td>
              <td>:</td>
              <td>'.$data_user[nama_lengkap].'</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Alamat Email</td>
              <td>:</td>
              <td>'.$data_user[email].'</td>
            </tr>
            <tr>
              <td class="font-weight-bold">No Telp</td>
              <td>:</td>
              <td>'.$data_user[no_telp].'</td>
            </tr>
            </table>
             <p class="card-text mb-5">Namun, sebelum Anda menggunakan akun tersebut, harap lakukan aktivasi dengan mengklik tombol di bawah ini:</p>
             <div class="row justify-content-center">
               <div class="col-4">'.$url_aktivasi.'</div>
             </div>
             <p class="card-text mt-5">Salam sukses, <br> Tim Bengkel Ikan</p>
             <p class="card-text mt-3"><i>Copyright</i> &copy; 2017 BengkeIkan.com</p>
          </div>
        </div>
      </div>
    </div>
	</div>
</body>
</html>
';

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Asia/Jakarta');

if ($data_user[level_user]=="seller") {
  require '../../plugins/phpmailer/PHPMailerAutoload.php';
}else{
  require '../plugins/phpmailer/PHPMailerAutoload.php';
}

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "officialbengkelikan@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "bengkelikan11";

//Set who the message is to be sent from
$mail->setFrom('noreply-officialbengkelikan@gmail.com', 'Bengkel Ikan');

//Set an alternative reply-to address
$mail->addReplyTo('noreply-officialbengkelikan@gmail.com', 'Bengkel Ikan');

//Set who the message is to be sent to
$mail->addAddress($emailuser, $nama);

//Set the subject line
$mail->Subject = 'Selamat Datang di Bengkel Ikan';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($msg);

//Replace the plain text body with one created manually
//$mail->AltBody = 'scdsddsdsd';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  if ($data_user[level_user]=="seller") {
    ?>
      <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/masuk/msg=berhasildaftar">  
    <?php 
  }else{
	?>
    	<meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/masuk/msg=berhasildaftar">  
	<?php 
  }
}
