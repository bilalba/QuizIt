<?php 
require ('populateuserprofile.php');
session_start();
if (isset($_SESSION['username'])) {


}
else{
  header("Location: login.php");
} 

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>QuizIT Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
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
    <!-- Side Navbar -->
  <!--   <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <div class="sidenav-header-inner text-center"><img src="img/avatar-1.jpg" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5 text-uppercase">Anderson Hardy</h2><span class="text-uppercase">Web Developer</span>
          </div>
          <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
        </div>
        <div class="main-menu">
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li class="active"><a href="index.html"> <i class="icon-home"></i><span>Home</span></a></li>
            <li> <a href="forms.html"><i class="icon-form"></i><span>Forms</span></a></li>
            <li> <a href="charts.html"><i class="icon-presentation"></i><span>Charts</span></a></li>
            <li> <a href="tables.html"> <i class="icon-grid"> </i><span>Tables  </span></a></li>
            <li> <a href="login.html"> <i class="icon-interface-windows"></i><span>Login page                        </span></a></li>
            <li> <a href="#"> <i class="icon-mail"></i><span>Demo</span>
                <div class="badge badge-warning">6 New</div></a></li>
          </ul>
        </div>
        <div class="admin-menu">
          <ul id="side-admin-menu" class="side-menu list-unstyled"> 
            <li> <a href="#pages-nav-list" data-toggle="collapse" aria-expanded="false"><i class="icon-interface-windows"></i><span>Dropdown</span>
                <div class="arrow pull-right"><i class="fa fa-angle-down"></i></div></a>
              <ul id="pages-nav-list" class="collapse list-unstyled">
                <li> <a href="#">Page 1</a></li>
                <li> <a href="#">Page 2</a></li>
                <li> <a href="#">Page 3</a></li>
                <li> <a href="#">Page 4</a></li>
              </ul>
            </li>
            <li> <a href="#"> <i class="icon-screen"> </i><span>Demo</span></a></li>
            <li> <a href="#"> <i class="icon-flask"> </i><span>Demo</span>
                <div class="badge badge-info">Special</div></a></li>
            <li> <a href=""> <i class="icon-flask"> </i><span>Demo</span></a></li>
            <li> <a href=""> <i class="icon-picture"> </i><span>Demo</span></a></li>
          </ul>
        </div>
      </div>
    </nav> -->
    <div class="page home-page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a href="index.html" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><span>Hello </span><strong class="text-primary"><?php echo $_SESSION['name']; ?></strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <button type="button" class="btn btn-success" onclick="window.location='quiz3.php';">START QUIZ</button>
                <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-th-large"></i></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <form>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex justify-content-start"  style="padding: 0px"> <div class="msg-body">Arrays                           </div> <div class="ml-auto"> <input type="checkbox" class="tiny-toggle" data-tt-size="large" id="0" > </div> </a> </li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-sm-flex justify-content-start"  style="padding: 0px"> <div class="msg-body">Variables                           </div> <div class="ml-auto"> <input type="checkbox" class="tiny-toggle" data-tt-size="large" id="1" > </div> </a> </li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-sm-flex justify-content-start"  style="padding: 0px"> <div class="msg-body">Decisons                          </div> <div class="ml-auto"> <input type="checkbox" class="tiny-toggle" data-tt-size="large" id="2" > </div> </a> </li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-sm-flex justify-content-start"  style="padding: 0px"> <div class="msg-body">Methods                          </div> <div class="ml-auto"> <input type="checkbox" class="tiny-toggle" data-tt-size="large" id="3" > </div> </a> </li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-sm-flex justify-content-start"  style="padding: 0px"> <div class="msg-body">Loops                           </div> <div class="ml-auto"> <input type="checkbox" class="tiny-toggle" data-tt-size="large" id="4" > </div> </a> </li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-sm-flex justify-content-start"  style="padding: 0px"> <div class="msg-body">Operators                           </div> <div class="ml-auto"> <input type="checkbox" class="tiny-toggle" data-tt-size="large" id="5" > </div> </a> </li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-sm-flex justify-content-start"  style="padding: 0px"> <div class="msg-body">Expressions                           </div> <div class="ml-auto"> <input type="checkbox" class="tiny-toggle" data-tt-size="large" id="6" > </div> </a> </li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-sm-flex justify-content-start"  style="padding: 0px"> <div class="msg-body">Strings                           </div> <div class="ml-auto"> <input type="checkbox" class="tiny-toggle" data-tt-size="large" id="7" > </div> </a> </li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-sm-flex justify-content-start"  style="padding: 0px"> <div class="msg-body">Classes/Objects                          </div> <div class="ml-auto"> <input type="checkbox" class="tiny-toggle" data-tt-size="large" id="8" > </div> </a> </li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-sm-flex justify-content-start"  style="padding: 0px"> <div class="msg-body">Input/Output                           </div> <div class="ml-auto"> <input type="checkbox" class="tiny-toggle" data-tt-size="large" id="9" > </div> </a> </li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-sm-flex justify-content-start"  style="padding: 0px"> <div class="msg-body">DataTypes                           </div> <div class="ml-auto"> <input type="checkbox" class="tiny-toggle" data-tt-size="large" id="10" > </div> </a> </li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-sm-flex justify-content-start"  style="padding: 0px"> <div class="msg-body">Fundamentals                         </div> <div class="ml-auto"> <input type="checkbox" class="tiny-toggle" data-tt-size="large" id="11" > </div> </a> </li>
                    
                    
                  </form>
                  </ul>
                </li>
                <li class="nav-item"><a href="logout.php" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-user"></i></div>
                <div class="name"><strong class="text-uppercase">Score</strong><span>Total Score</span>
                  <div class="count-number"><?php 
                  $_SESSION['nowScore'] = getTotalScore($_SESSION['username']);
                  echo round($_SESSION['nowScore'], 1, PHP_ROUND_HALF_ODD); ?></div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-padnote"></i></div>
                <div class="name"><strong class="text-uppercase">Score</strong><span>In this session</span>
                  <div class="count-number"><div  class="fa fa-long-arrow-up" style="color: green; "> </div><?php echo round($_SESSION['nowScore']-$_SESSION['sessionStartScore'],1,PHP_ROUND_HALF_ODD) ?> </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-check"></i></div>
                <div class="name"><strong class="text-uppercase">Percentile</strong><span>Compared to others</span>
                  <div class="count-number"><?php echo round(gettotalPercentile($_SESSION['username']),1,PHP_ROUND_HALF_ODD); ?></div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-bill"></i></div>
                <div class="name"><strong class="text-uppercase">Qs Attempted</strong><span>Total Q</span>
                  <div class="count-number"><?php echo count(unserialize(getUserObject($_SESSION['username'])->completed_q_array)) + count(unserialize(getUserObject($_SESSION['username'])->incompleted_q_array)); ?></div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-list"></i></div>
                <div class="name"><strong class="text-uppercase">Qs Correct </strong><span>corectly attempted</span>
                  <div class="count-number"><?php echo count(unserialize(getUserObject($_SESSION['username'])->completed_q_array)); ?></div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-list-1"></i></div>
                <div class="name"><strong class="text-uppercase">Mastered Topics</strong><span></span>
                  <div class="count-number"><?php echo getMasteredTopics($_SESSION['username']); ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Header Section-->
      <section class="dashboard-header section-padding">
        <div class="container-fluid">
          <div class="row d-flex align-items-md-stretch">
            <!-- To Do List-->
         <!--    <div class="col-lg-3 col-md-6">
              <div class="wrapper to-do">
                <header>
                  <h2 class="display h4">To do List</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </header>
                <ul class="check-lists list-unstyled">
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-1" name="list-1" class="form-control-custom">
                    <label for="list-1">Similique sunt in culpa qui officia</label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-2" name="list-2" class="form-control-custom">
                    <label for="list-2">Ed ut perspiciatis unde omnis iste</label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-3" name="list-3" class="form-control-custom">
                    <label for="list-3">At vero eos et accusamus et iusto </label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-4" name="list-4" class="form-control-custom">
                    <label for="list-4">Explicabo Nemo ipsam voluptatem</label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-5" name="list-5" class="form-control-custom">
                    <label for="list-5">Similique sunt in culpa qui officia</label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-6" name="list-6" class="form-control-custom">
                    <label for="list-6">At vero eos et accusamus et iusto </label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-7" name="list-7" class="form-control-custom">
                    <label for="list-7">Similique sunt in culpa qui officia</label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-8" name="list-8" class="form-control-custom">
                    <label for="list-8">Ed ut perspiciatis unde omnis iste</label>
                  </li>
                </ul>
              </div>
            </div> -->
            <!-- Pie Chart-->
            <div class="col-lg-6 col-md-6">
              <iframe src="windchart.php" height="450px" frameBorder="0" width="100%"></iframe>
            </div>
            <!-- Line Chart -->
            <div class="col-lg-6 col-md-12 flex-lg-last flex-md-first align-self-baseline">
              <iframe src="averageChartdata.php" height="450px" frameBorder="0" width="100%"></iframe>
            </div>
          </div>
        </div>
      </section>
      <!-- Statistics Section-->
     
      <footer class="main-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p>Your company &copy; 2017-2019</p>
            </div>
            <div class="col-sm-6 text-right">
              <p>Design by <a href="https://bootstrapious.com" class="external">Bootstrapious</a></p>
              <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- Javascript files-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="js/charts-home.js"></script>
    <script src="js/front.js"></script>

    <link href="css/tinytoggle.min.css" rel="stylesheet">
<script src="js/jquery.tinytoggle.min.js"></script>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <!---->
    <script>
      $(".tiny-toggle").tinyToggle({
        onCheck: function() {
          console.log($(this).attr('id'));
          $.post( "interests.php", { check: $(this).attr('id') } );
          console.log("check");
        },
        onUncheck: function() {
          console.log($(this).attr('id'));
          $.post( "interests.php", { uncheck: $(this).attr('id') } );
          console.log("uncheck");
        }


      });
      $.getJSON( "interests.php", function( data ) {
          for (var i =0; i < 12; i++) {
            if (data[i]== true)
              $("#"+i).tinyToggle("check");
          }
      });



      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
  </body>
</html>