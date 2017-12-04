<?php


require 'db_conn.php';


$link = db_connect();
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql= "CREATE TABLE IF NOT EXISTS `user_profile` ( `completed_q_array` VARCHAR(5000) NULL , `solved_count_array` VARCHAR(200) NULL , `preferred_categories` VARCHAR(200) NULL , `TS_last_ques` VARCHAR(5000) NULL , `name` VARCHAR(500) NOT NULL , `username` VARCHAR(40) NOT NULL , `password` VARCHAR(40) NOT NULL , `incorrectly_count_array` VARCHAR(200) NULL , `incompleted_q_array` VARCHAR(5000) NULL, `module_level` VARCHAR(200) , `score` VARCHAR(500), PRIMARY KEY (`Username`)) ENGINE = InnoDB;";

 if(mysqli_query($link, $sql)){
     echo "Table created successfully.";

 } else {
     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
 }


?>