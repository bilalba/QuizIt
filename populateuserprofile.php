<?php

require 'db_conn.php';

$GLOBALS['easyScore'] = 1;
$GLOBALS['mediumScore'] = 2;
$GLOBALS['hardScore'] = 5;
setMaxScores();





function getMasteredTopics($userId) {
	$module_arr = unserialize(getUserObject($userId)->module_level);
	$count = 0;
	foreach($module_arr as $val) if ($val == 3) $count ++;
	
	return $count;
}

function getTotalScore($userId) {
	$userScores = unserialize(getUserObject($userId)->score);
	$total = 0;
	foreach($userScores as $score) $total += $score;
	return $total;
		
}

function getPercentile($userId, $category) {
	$userScore = unserialize(getUserObject($userId)->score)[$category];
	

	$link = db_connect();
	$sql = "SELECT score FROM user_profile WHERE username != '$userId'";
	$lesserScoreUsers = 0;
	$result = mysqli_query($link,$sql);
	$totalUsers=mysqli_num_rows($result);

	foreach($result as $user) {
		$score = unserialize($user['score'])[$category];
		if ($score <= $userScore && $userScore != 0) $lesserScoreUsers++; 
	}
	echo "lesser people: $lesserScoreUsers \n";
	return $lesserScoreUsers/$totalUsers * 100;


}

function gettotalPercentile($userId) {

	$myScore = getTotalScore($userId);
	$link = db_connect();
	$sql = "SELECT username FROM user_profile WHERE username != '$userId'";
	$result = mysqli_query($link,$sql);
	$totalUsers= mysqli_num_rows($result);
	$lesserScoreUsers = 0;
	foreach($result as $user) {
		$score = getTotalScore($user['username']);
		if ($score <= $myScore && $myScore != 0) $lesserScoreUsers++; 
	}
	return $lesserScoreUsers/$totalUsers * 100;
}

function getAverage($category) {
	

	$link = db_connect();
	$sql = "SELECT score FROM user_profile WHERE 1";
	$result = mysqli_query($link,$sql);
	$totalUsers=mysqli_num_rows($result);
	$total = 0;

	foreach($result as $user)
		$total += unserialize($user['score'])[$category];
	
	return $total/$totalUsers;


}

function setMaxScores() {
	$scoring = array();
	$link = db_connect();
	$scoring[1] = $GLOBALS['easyScore'];
	$scoring[2] = $GLOBALS['mediumScore'];
	$scoring[3] = $GLOBALS['hardScore'];
	$elems = 12;
	$maxScores = array_fill(0,$elems,0);
	for ($i = 0; $i<$elems;$i++) {
		for ($j = 1; $j<= 3; $j++) {
			$sql = "SELECT COUNT(*) as count FROM questions WHERE overall_category = $i AND difficulty = $j";
			$result = mysqli_query($link,$sql);
			$row = mysqli_fetch_assoc($result);
			$maxScores[$i] += $row['count'] * $scoring[$j];
		}
			
	}
	$GLOBALS['maxScores']=$maxScores;
	
}

function getQuestionScore($interests, $module_level, $q_difficulty, $q_category) {
	$score = 1;

	// 0- 3
	$personCategoryLevel = $module_level[$q_category];

	$q_val = 4;
	for ($i = 1; $i<$q_difficulty;$i++ )
		$q_val/=2;

	$p_difficulty = $personCategoryLevel;
	if ($p_difficulty >=3)
		return -1; // Guy has done everything.
	$p_val = 1;
	for ($i =0; $i < $p_difficulty; $i++)
		$p_val *= 2;
	
	$score *= $p_val * $q_val;
	if ($score > 4){
		echo "ERROR! Attempting easier question!";
		return -1;
	}
	if ($interests[$q_category]) {
		$score *= 2;
	}

	$score *= mt_rand() / mt_getrandmax();
	return $score;
}

function getUser($userId) {
// return user moduleLevel and interests
	$link = db_connect();

    $sql = "select preferred_categories,module_level from user_profile where username='".$userId."'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    $preferred_categories= unserialize($row['preferred_categories']);
    $module_level= unserialize($row['module_level']);

    return array($preferred_categories,$module_level);

}

function getCompletedQuestions($userId) {
	$link = db_connect();
    $sql = "select completed_q_array from user_profile where username='".$userId."'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    return unserialize($row['completed_q_array']);
}

function getUserUnansweredQuestions($userId) { // functions return object of questions.
	$link = db_connect();
    $completed_q_array= getCompletedQuestions($userId);
    if (count($completed_q_array) > 0)
    $sql1= "select * from questions where id not in (".implode(',',$completed_q_array).");";  
	else
		$sql1= "select * from questions where 1;";
    $result = mysqli_query($link,$sql1); 
        $arr =array(); 
        while($row = mysqli_fetch_object($result)){
                 array_push($arr, $row);    
         }
         return $arr;

}

function incrementLevel($userId,  $category) { # increments IFF no questions for this level.
	// $completed_q_array= getCompletedQuestions($userId);
	$link = db_connect();
	$userObject = getUserObject($userId);
	$completed_q_array = unserialize($userObject->completed_q_array);
	$level = unserialize($userObject->module_level)[$category]+1;
	if ($level > 3)
		return false;
	$sql = "SELECT COUNT(*) as total FROM questions WHERE difficulty =". $level . " AND overall_category = '".$category."' AND id not in (" . implode(",", $completed_q_array). ");";
	$result = mysqli_query($link,$sql);
	$data=mysqli_fetch_assoc($result);

	if ($data['total'] == 0){
		echo "\n\nINCREASING LEVEL!!!!\n\n";
		$module_level = unserialize($userObject->module_level);
		$module_level[$category]++;
		$sql1 = "UPDATE user_profile SET module_level='".serialize($module_level)."' WHERE username='". $userId ."';";
		$result = mysqli_query($link,$sql1);
		incrementLevel($userId, $category);	 
}
	// if NO questions for this level.
	// user.module_level[category]++;
	
}

function push_question_completed($userObject,$questionId, $overall_category, $difficulty){
	/*
		1. push question completed in user_profile.
		2. Increment solve counter.
		3. Update TS of last category.  
	*/
    $link = db_connect();
    $completed_q_array = unserialize($userObject->completed_q_array);
    $solved_count_array = unserialize($userObject->solved_count_array);
    $TS_array = unserialize($userObject->ts_last_ques);
    $score = unserialize($userObject->score);
    if($difficulty ==1){
    	$score[$overall_category] += (100/$GLOBALS['maxScores'][$overall_category]) * $GLOBALS['easyScore'];
    } else if($difficulty == 2){
    	$score[$overall_category] += (100/$GLOBALS['maxScores'][$overall_category]) * $GLOBALS['mediumScore'];
    } else if($difficulty == 3){
    	$score[$overall_category] += (100/$GLOBALS['maxScores'][$overall_category]) * $GLOBALS['hardScore'];
    }
    $solved_count_array[$overall_category]++;
	$TS_array[$overall_category] = time();
	array_push($completed_q_array, $questionId);

    $sql = "UPDATE user_profile set completed_q_array='". serialize($completed_q_array)."', solved_count_array='". serialize($solved_count_array). 
    "',ts_last_ques='". serialize($TS_array)."',score='". serialize($score)."' WHERE username ='" . $userObject->username . "'";
    $result = mysqli_query($link,$sql);

    //echo $sql;
}

function push_question_incompleted($userObject,$questionId, $overall_category){
	/*
		1. push question completed in user_profile.
		2. Increment solve counter.
		3. Update TS of last category.  
	*/
    $link = db_connect();
    $incompleted_q_array = unserialize($userObject->incompleted_q_array);
    $incorrectly_count_array = unserialize($userObject->incorrectly_count_array);
    //$TS_array = unserialize($userObject->ts_last_ques);

    $incorrectly_count_array[$overall_category]++;
	//$TS_array[$overall_category] = time();
	array_push($incompleted_q_array, $questionId);

    $sql = "UPDATE user_profile set incompleted_q_array='". serialize($incompleted_q_array)."', incorrectly_count_array='". serialize($incorrectly_count_array)."' WHERE username ='" . $userObject->username . "'";
    $result = mysqli_query($link,$sql);

    //echo $sql;
}


function getUserObject($userId) {
	$link = db_connect();
	$sql = "SELECT * FROM user_profile WHERE username = '" . $userId . "'";	
	$result = mysqli_query($link,$sql);
    return mysqli_fetch_object($result);

}

// Question object.
function answerQuestion($userId, $question, $choice, $timeTaken) {
		$link = db_connect();
        $userObject = getUserObject($userId);
		$category = $question->overall_category;
		if ($choice == $question->correct_option) {
			//echo "anwered correctly!!!";
			push_question_completed($userObject, $question->id, $category,$question->difficulty);
			incrementLevel($userId, $category); // check if there exists more q of this user level.
			$totalTime= ($question->correct_attempts * $question->avg_time_correct ) + $timeTaken;
			$new_Avg_Time = $totalTime/($question->correct_attempts +1);
			$sql = "UPDATE questions SET avg_time_correct = ".$new_Avg_Time." ,correct_attempts =".($question->correct_attempts +1). " WHERE id =".$question->id;
			$result = mysqli_query($link,$sql);
		/*	allTime = q_id.correctattempts * q_id.avg_time_correct + $timeTaken
			q_id.correctattempts++
			q_id.avg_time_correct = allTime/ q_id.correctAttempts
			*/
		} else {
			//echo "anwered incorrectly!!!";
			push_question_incompleted($userObject, $question->id, $category);
			$totalTime= ($question->incorrect_attempts * $question->avg_time_incorrect ) + $timeTaken;
			$new_Avg_Time = $totalTime/($question->incorrect_attempts +1);
			$sql = "UPDATE questions SET avg_time_incorrect = ".$new_Avg_Time." ,incorrect_attempts =".($question->incorrect_attempts +1). " WHERE id =".$question->id;
			$result = mysqli_query($link,$sql);
			/*
			allTime = q_id.incorrectattempts * q_id.avg_time_incorrect + $timeTaken
			q_id.incorrectattempts++
			q_id.avg_time_incorrect = allTime/ q_id.incorrectAttempts */
		} 
	
}
//overwrites the complete array
function updateInterests($userId, $interests) { 
   $link = db_connect();
   $sql= "update user_profile set preferred_categories = '".serialize($interests)."' where username='".$userId."'";
   if(mysqli_query($link, $sql)){

     
     echo $sql;
    } else{
     //echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
     // echo $insert;
    }

}

function generateQuestions($userId) {
	//echo "here";
	$questions = getUserUnansweredQuestions($userId);
	//echo "there";
	list($interests,$module_level) =getUser($userId);
	//echo "now";
	$question_scores= array();
	$all_question = array();
	foreach($questions as $question){
		$all_question[$question->id] = $question;
		// get q_difficulty level and q_category.
		$question_scores[$question->id] = getQuestionScore($interests,$module_level,$question->difficulty,$question->overall_category);	
	}
	arsort($question_scores);
	$result_questions = array();
	for($i=0;$i<10;$i++) {
		//echo key($question_scores). "=>". $question_scores[key($question_scores)] ."\n";
		// getQuestionDetails(key($question_scores));
		array_push($result_questions, $all_question[key($question_scores)]);
		next($question_scores);
	}

	return $result_questions;
}


function createUser($userId, $password, $name) {
	//echo "in createUser";
	$link = db_connect();
	$solved_count_array = $module = $TS_array = $incorrectly_count_array= $score=array_fill(0, 12, 0);
	//echo "why";
	$categories = array_fill(0, 12, false);
	$completed_q_array = $incompleted_q_array =array();
    $sql = "insert into user_profile (name, username, password,module_level, completed_q_array, solved_count_array, ts_last_ques, incompleted_q_array, incorrectly_count_array,preferred_categories,score) Values ('".$name."','".$userId."','".$password."','".serialize($module)."','".serialize($completed_q_array)."','".serialize($solved_count_array)."','".serialize($TS_array)."','".serialize($incompleted_q_array)."','".serialize($incorrectly_count_array)."','".serialize($categories)."','".serialize($score)."')";
    //echo "this";
	if(mysqli_query($link, $sql)){
      //echo "Row inserted.";
		return true;
    } else{
     return "ERROR: Could not able to execute $sql. " . mysqli_error($link);
     // echo $insert;
    }
}



// /
//echo "Welcome to Java Quiz\n";
//$username = "bil";
  // echo "Enter Username";
  //$handle = fopen ("php://stdin","r");
   //$username = fgets($handle);
   //echo "Enter Password";
   //$pwd = fgets($handle);
   //echo "Enter Name";
//   $name = fgets($handle);
// //  //echo "first";
//  createUser(trim($username),trim($pwd),trim($name));
//echo "second";
// $interests = array_fill(0, 12, false);
// $interests[3] = true;
// $interests[5] = true;
// $interests[8] = true;
// updateInterests(trim($username),$interests);
//list($interest,$module_level) =getUser(trim($username));
//print_r($interest);
//print_r($module_level);
// $unanswered = getUserUnansweredQuestions(trim($username));

 // $questions = generateQuestions(trim($username));
 // foreach($questions as $item){
 // 	echo "\n";
 // 	echo $item->question_text."\n";
 // 	echo "actual answer:" . $item->correct_option. " \n";
 // 	echo "enter choice";
 //     $choice = intval(trim(fgets($handle)));
 //     $time = 3; 
 //     answerQuestion(trim($username),$item,$choice,$time);
 //}


// for($i; $i<12;$i++) {
// 	echo "Category:$i Percentile:", getPercentile("mno", $i), "\n";

// }
// test push question completed
?>