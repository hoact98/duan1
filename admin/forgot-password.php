<?php 
use PHPMailer\PHPMailer\PHPMailer;

require_once '../golbal.php';
require_once '../libs/members.php';
require_once "../phpmailer/PHPMailer.php";
require_once "../phpmailer/SMTP.php";
extract($_REQUEST);

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PolyBarber - Forgot Password</title>

<!-- Custom fonts for this template-->
<link href="resource/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="resource/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Quên mật khẩu</h1>
                    <p class="mb-4">Chỉ cần nhập địa chỉ email của bạn dưới đây và chúng tôi sẽ gửi cho bạn một liên kết để đặt lại mật khẩu của bạn!</p>
                  </div>
                  <form class="user needs-validation" action=""  method="POST" novalidate>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." required>
                      <div class="invalid-feedback">
                                Vui lòng nhập địa chỉ email
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block text-uppercase">
                     Đặt lại mật khẩu
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="login.php">Bạn có một tài khoản? Đăng nhập!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="resource/vendor/jquery/jquery.min.js"></script>
  <script src="resource/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="resource/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="resource/js/sb-admin-2.js"></script>
<script>
   (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>
</body>

</html>