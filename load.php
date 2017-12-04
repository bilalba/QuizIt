<?php

require 'db_conn.php';

function readCSV($csvFile){
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle) ) {
        $line_of_text[] = fgetcsv($file_handle, 1024);
    }
    fclose($file_handle);
    return $line_of_text;
}
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = db_connect();
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Attempt create table query execution
$sql = "CREATE TABLE `quiz`.`questions` ( `id` INT NOT NULL AUTO_INCREMENT , `difficulty` DECIMAL NOT NULL , `question_text` VARCHAR(500) NOT NULL , `num_choices` INT NOT NULL , `option1` VARCHAR(200) NOT NULL , `option2` VARCHAR(200) NOT NULL , `option3` VARCHAR(200) , `option4` VARCHAR(200) , `option5` VARCHAR(200) , `correct_option` INT NOT NULL , `original_category` VARCHAR(20) NOT NULL , `overall_category` INT NOT NULL , `original_difficulty` DECIMAL NOT NULL , `correct_attempts` INT NOT NULL , `incorrect_attempts` INT NOT NULL , `avg_time_correct` DECIMAL NOT NULL , `avg_time_incorrect` DECIMAL NOT NULL , `helpFile` VARCHAR(200), PRIMARY KEY (`id`)) ENGINE = InnoDB;";
 if(mysqli_query($link, $sql)){
     echo "Table created successfully.";
 } else {
     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
 }
// echo $sql;



$csv = readCSV('Java__Quiz_Questions.csv');
// // $csv = array_map('fgetcsv', file('Java__Quiz_Questions.csv'));
// $length = count($csv)
// $arr = 

// print_r ($csv);
//$insert = "INSERT INTO questions (difficulty,qustion_text,num_choices,option1,option2,option3,option4,option5,correct_option, original_difficulty, correct_attempts, incorrect_attempts, avg_time_correct, avg_time_incorrect) VALUES ('". $item[0] . "', 'Doe', 'john@example.com')";

foreach($csv as $item) {
	$difficulty = 0.0;
	if ($item[9] == "Easy"){
		$difficulty = 1.0;
	} elseif ($item[9] == "Moderate"){
		$difficulty = 2.0;
	} elseif ($item[9] == "Difficult"){
		$difficulty = 3.0;
	} else {
		echo "ERROR";
		continue;
	}
	$opt2 = "";
	$opt1 = "";
	$opt3 = "";
	$opt4 = "";
	$opt5 = "";
	$overall_category=0;
	if ($item[7] < 5) {
		$opt5 = "NULL";
	} else {
		$opt5 = "'".addslashes($item[6])."'";
	} 
	if ($item[7] < 4) {
		$opt4 = "NULL";
	} else {
		$opt4 = "'".addslashes($item[5])."'";
	} 
	if ($item[7] < 3) {
		$opt3 = "NULL";
	} else {
		$opt3 = "'".addslashes($item[4])."'";
	} 
	$opt2 = "'".addslashes($item[3])."'";
	$opt1 = "'".addslashes($item[2])."'";
	$choice = ord(substr($item[8],-1)) - ord('A') + 1;

	if($item[1] =="2D_Arrays" || $item[1] =="Arrays"){
		if ($item[1] =="2D_Arrays") {
			if ($difficulty <3.0) $difficulty++;
		}
		$overall_category=0;
	} elseif ($item[1] =="Variables"){
		$overall_category=1;
	} elseif ($item[1] =="Control" || $item[1] =="Decisions" ){
		$overall_category=2;
	} elseif ($item[1] =="Arithmetics" || $item[1] =="Expression" ){
		$overall_category=3;
	} elseif ($item[1] =="Classes" || $item[1] =="Objects" || $item[1] =="Constructor" ){
		if ($item[1] =="Constructor") {
			if ($difficulty <3.0) $difficulty++;
		}
		$overall_category=4;
	} elseif ($item[1] =="Method" ){
		$overall_category=5;
	} elseif ($item[1] =="Strings" ){
		$overall_category=6;
	} elseif ($item[1] =="Java" ){
		$overall_category=7;
	} elseif ($item[1] =="InputOutput" ){
		$overall_category=8;
	} elseif ($item[1] =="DataType" || $item[1] =="Primitive Data Type" ){
		if ($item[1] =="DataType") {
			if ($difficulty <3.0) $difficulty++;
		}
		$overall_category=9;
	} elseif ($item[1] =="Operator" ){
		$overall_category=10;
	} elseif ($item[1] =="Loops" ){
		$overall_category=11;
	} 



	$insert = "INSERT INTO questions (difficulty,question_text,num_choices,option1,option2,option3,option4,option5,correct_option,original_category,overall_category, original_difficulty, correct_attempts, incorrect_attempts, avg_time_correct, avg_time_incorrect, helpFile) VALUES (". $difficulty .",'". addslashes($item[0]) . "', ". $item[7] . ",". $opt1 ."," . $opt2 .",".$opt3 .",".$opt4 .",".$opt5 .",". $choice .",'" . $item[1] ."',".$overall_category.",".$difficulty . "," . 0 .  "," . 0 . ",". 0.0 ."," . 0.0 .", '". $item[10] ."')";
	// echo $insert;
	if(mysqli_query($link, $insert)){
     // echo "Row inserted.";
 } else{
     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
     // echo $insert;
 }

}



// Close connection
mysqli_close($link);
?>