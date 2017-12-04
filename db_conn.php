<?php 


function db_connect() {
	static $connection;
	$envvar = getenv("JAWSDB_URL");
	if (!isset($connection)) {
		if ($envvar == false) {
			$server = "127.0.0.1";
			$username = "root";
			$password = "";
			$db = "quiz";
		} else {
			$url = parse_url($envvar);
			$server = $url["host"];
			$username = $url["user"];
			$password = $url["pass"];
			$db = substr($url["path"], 1);
			$conn = new mysqli($server, $username, $password, $db);
		}
		$connection = new mysqli($server, $username, $password, $db);	
	}
	if ($connection === false)
		return mysqli_connect_error();
	return $connection;

	
}

?>
