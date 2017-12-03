<?php 
require ('populateuserprofile.php');
session_start();

if (isset($_POST['action']))
if($_POST['action'] == 'answerQuestion') {
	$link = db_connect();
	$sql = "SELECT * FROM `questions` WHERE `id`=".$_POST['questionId'];
	$result = mysqli_query($link,$sql);
	
	answerQuestion($_SESSION['username'], mysqli_fetch_object($result), $_POST['option'], 3);
}
?>