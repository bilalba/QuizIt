<?php
require 'populateuserprofile.php';
session_start();
$x =unserialize(getUserObject($_SESSION['username'])->score);
for ($i =0;$i < 12; $i++){
		echo getAverage($i),",";
		
	}
	
for ($i =0;$i < 12; $i++){
		echo $x[$i], ",";
	}
?>
