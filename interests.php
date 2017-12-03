
<?php 

	require ('populateuserprofile.php');
	session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['check'])) {
    	turnOnInterest($_SESSION['username'],$_POST['check']);
	} else if (isset($_POST['uncheck'])) {
		turnOffInterest($_SESSION['username'],$_POST['uncheck']);
	}
} else {
	echo json_encode(unserialize(getUserObject($_SESSION['username'])->preferred_categories));
}
function turnOnInterest($userId, $category) {
	$user = getUserObject($userId);
	$interests = unserialize($user->preferred_categories);
	$interests[$category] = true;
	updateInterests($userId,$interests);
}

function turnOffInterest($userId, $category) {
	$user = getUserObject($userId);
	$interests = unserialize($user->preferred_categories);
	$interests[$category] = false;
	updateInterests($userId,$interests);
}


?>