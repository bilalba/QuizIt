var currentPage=0;
var correctAnswer=0;
var incorrectAnswer=0;
var currentQuestion=1;
var color=0;
var id = null;

$(function () {

  $(".start").click(function (e) {
    e.preventDefault();

    currentPage++;
    console.log(currentPage);
    // bg stuff
     $(".background").fadeOut(function () {
      $(this).removeClass("background-" + (currentPage-1)).addClass("background-" + currentPage).fadeIn();
    });

    $("#intro").fadeOut(function () {
      $(".question-meta, #questions, #question-1").hide().prop("hidden", false).fadeIn();
      
    });
  });

  

  $(".action-buttons .next").click(function (e) {
    e.preventDefault();
    $(this).closest(".question-content")
      .fadeOut(function () {
        // Show the next sibling.

        $(this).next().fadeIn();
      });
       i = currentQuestion;
           id = $(this).closest(".container");
           while(i > 0){
             id = id.next();
             i -= 1;
           }
           id.fadeOut(function () {
        });

      $(".bar").html(currentQuestion+=1)
      $(".bar").addClass("bar bar-" + currentQuestion).text(currentQuestion + "/" + "10");

     });
    $(".answer").on("click", function () {
       $(this).addClass("newClick");
       if($(this).hasClass("newClick") && $(this).hasClass("correct")){
        console.log("correctAnswer");
        $("#right").html(correctAnswer+=1);
      }
      else{
        $("#wrong").html(incorrectAnswer+=1);
       if(currentQuestion == 1){
           $(this).closest(".container").next().fadeIn();
         }
         else{
           i = currentQuestion;
           id = $(this).closest(".container");
           while(i > 1){
             id = id.next();
             i -= 1;
           }
           id.fadeOut(function () {
             // Show the next sibling.
             $(this).next().fadeIn();
         });
       }
 
     }  



     myAjax(this.id.substring(9, this.id.substring(9).indexOf('-')+9), this.id.substring(this.id.lastIndexOf('-')+1));
    // Enable the next button.
    $(this).closest(".question-content").find(".btn.next").prop("disabled", false);
    // Disable all the current view's radio buttons.
    $(this).closest(".answers").find(".answer").prop("disabled", true);
  });


    $(".submit .next").click(function (e) {
    // Prevent the default action.
    e.preventDefault();
    // Traverse to it's parental question content.
    $(this).closest(".question-content")
      // Hide this.
      .fadeOut(function () {
        
        // Fade in the exit page.
        $("#exit").hide().prop("hidden", false).fadeIn();
      });
  });

    var acc = document.getElementsByClassName("accordion");
  var i;

  for (i = 0; i < acc.length; i++) {
      acc[i].onclick = function(){
          this.classList.toggle("active");
          var panel = this.nextElementSibling;
          if (panel.style.display === "block") {
              panel.style.display = "none";
          } else {
              panel.style.display = "block";
          }
      }
  } 
  });

  

  