<?php include("populateuserprofile.php");
 session_start();
 $result = generateQuestions($_SESSION['username']);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bootstrap Dashboard by Bootstrapious.com</title>
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
    <link rel="stylesheet" href="finalquiz.css" />
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>

        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
         <script type="text/javascript">
      function myAjax(qId,opt) {
      $.ajax({
           type: "POST",
           url: "populateuserprofile.php",
           //user is hardcoded right now. will change after integrating user session.
           data:{action:'answerQuestion',questionId:qId,option:opt,user:"<?php echo $_SESSION['username'] ?>"},
      });
 } 
      
    </script>
  </head>
  <body>
     <div class="background background-0"></div>
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex justify-content-center align-items-center">
          <div class="form-inner">
<h1>Java Quiz</h1>
      <div class="question-meta" hidden>
        <div class="progress">
          <div class="bar bar-1"><p>1/10</p></div>
        </div>
        <div class="question-score">
          <div class="score" id="right">0</div>
          <div class="score" id="wrong">0</div>
        </div>
      </div>
      <div id="intro" class="intro">
        <p> This quiz contains 10 questions about Java.</p>
        <p> You are required to select one option in each question.</p> 
        <a href="#" class="btn next start">Start</a>
      </div>
        <form action="" class="intro" id="questions" hidden>          
        <?php foreach($result as $index=>$obj): ?>
          <div class="question-content" id=<?php echo '"question-'.($index+1).'"'?> hidden>
            <h2>Question #<strong><?php echo ($index+1)?></strong>: <span><?php echo $obj->question_text?></span></h2>
            <ul class="answers">
              <?php for($i = 1; $i <= $obj->num_choices; ++$i): ?>
                <?php $opt = "option$i"; ?>
                <li>
                  <input type="radio" id=<?php echo '"question-'.$obj->id.'-answer-'.$i.'"'?> name="answer" class=<?php if($obj->correct_option == $i) echo '"answer correct"'; else echo '"answer wrong"';?> />
                  <label for=<?php echo '"question-'.$obj->id.'-answer-'.$i.'"'?>><?php echo $obj->$opt?> <span class="result"><?php if($obj->correct_option == $i) echo '✓'; else echo '✗';?></span></label>
                </li>
              <?php endfor; ?>
            </ul>
            <div class=<?php if($index < count($result) - 1) echo '"action-buttons"'; else echo '"submit"';?>>
              <button class=<?php echo '"btn next question-'.($index+1).'"';?> disabled><?php if($index < count($result) - 1) echo "Next"; else echo "Submit";?>
              </button>
            </div>
          </div>
        <?php endforeach; ?>
      </form>
      <div id="exit" class="intro" hidden>
        <p>Thank you. Here's a summary of what you have done.</p>
        <pre></pre>
        <a href="" class="btn">Retake?</a>
      </div>
      </div>
    </div>
  </div>
</div>
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
  <script type="text/javascript" src="finalquiz.js"></script>
  </body>
</html>