<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>QuizIT Register</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="v/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="v/font-awesome/css/font-awesome.min.css">
    <!-- Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="v/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <?php
require('populateuserprofile.php');
if (isset($_POST['registerUsername'])){
    $username = $_POST['registerUsername'];
    $password = $_POST['registerPassword'];
    $name = $_POST['registerEmail'];

    $result = createUser($username,$password,$name);
        
        if($result){
            echo "<div class='form'>
<h3>Account has been created</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center justify-content-center">
          <div class="form-inner">
            <div class="logo text-uppercase"><span>Adaptive</span><strong class="text-primary">Quiz</strong></div>
            <p>Signup to continue</p>
            <form action="" method="post" id="register-form">
              <div class="form-group">
                <label for="register-username" class="label-custom">User Name</label>
                <input id="register-username" type="text" name="registerUsername" required>
              </div>
              <div class="form-group">
                <label for="register-email" class="label-custom">Name      </label>
                <input id="register-email" type="text" name="registerEmail" required>
              </div>
              <div class="form-group">
                <label for="register-passowrd" class="label-custom">Password        </label>
                <input id="register-passowrd" type="password" name="registerPassword" required>
              </div>
              <div class="terms-conditions d-flex justify-content-center">
                <input id="license" type="checkbox" class="form-control-custom">
                <label for="license">Agree the terms and policy</label>
              </div>
              <input id="register" type="submit" value="Register" class="btn btn-primary">
            </form><small>Already have an account? </small><a href="login.php" class="signup">Login</a>
          </div>
          <div class="copyrights text-center">
            <p>Design by <a href="https://bootstrapious.com" class="external">Bootstrapious</a></p>
            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
          </div>
        </div>
      </div>
    </div>
    <!-- Javascript files-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"> </script>
    <script src="v/bootstrap/js/bootstrap.min.js"></script>
    <script src="v/jquery.cookie/jquery.cookie.js"> </script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="v/jquery-validation/jquery.validate.min.js"></script>
    <script src="v/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/front.js"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <!---->
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
  <?php } ?>  
  </body>
</html>