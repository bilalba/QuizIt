<?php include("populateuserprofile.php");
 session_start();
 $result = generateQuestions($_SESSION['username']);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>QuizIt!</title>
    <!-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script> -->
    <!-- <script src="scripts.js"></script> -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500|Open+Sans:400,600" rel="stylesheet" />
    <link rel="stylesheet" href="finalquiz.css" />
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
    <div class="container">
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
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
  <script type="text/javascript" src="finalquiz.js"></script>
  </body>
</html>