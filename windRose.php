<?php

require 'populateuserprofile.php';

    //print_r(getWindRose(getUserObject("pqr")));

	# 36 values./
	# WE WANT PERCENTAGE completed from easy/medium/hard for each category.
	# 
	function getWindRose($userObject) {
		$totalPercentage = array();
		$totalSum = array();
		for ($i = 0; $i <12; $i++){
			array_push($totalSum, array_fill(1, 3, 0));
			array_push($totalPercentage, array_fill(1, 3, 0));		
		} 
		$sql = "Select count(*) as count ,overall_category, difficulty FROM questions where 1 GROUP BY overall_category, difficulty";
		$link = db_connect();
		$result = mysqli_query($link,$sql);
		if (!$result) {
    die(mysqli_error($link));
}
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    		$totalSum[$row['overall_category']][$row['difficulty']] = $row['count'];
		}
		

		$completed_q_array = unserialize($userObject->completed_q_array);

		$module_level = unserialize($userObject->module_level);
		
		for($i =0; $i <12; $i++) {

			$x = $module_level[$i] + 1;
			for ($j = $x - 1; $j>0; $j--) $totalPercentage[$i][$j] = 1;
			if ($x == 4) break;
			$solvedCorrectlyForthisCategory = 0;
			if (count($completed_q_array) > 0) {
    			$sql = "SELECT COUNT(*) as count from questions WHERE id in (".implode(',',$completed_q_array).") and difficulty =$x and overall_category = $i;";
				$result = mysqli_query($link,$sql);
				$row = mysqli_fetch_array($result, MYSQL_ASSOC);
				$solvedCorrectlyForthisCategory = $row['count'];
			}
			$totalPercentage[$i][$x] = $solvedCorrectlyForthisCategory/$totalSum[$i][$x];
		}

		return $totalPercentage;
	}
?>