<?php
require 'windRose.php';
	session_start();

$wind = getWindRose(getUserObject($_SESSION['username']));
print_r($wind);

?>