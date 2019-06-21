<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

	define('DB_HOST', '25.68.45.54');
	define('DB_USER', 'root');
	define('DB_PASS', 'pato6464');
	define('DB_NAME', 'computo');

	function connect()
	{
  		$connect = mysqli_connect(DB_HOST ,DB_USER ,DB_PASS ,DB_NAME);

  		if (mysqli_connect_errno($connect)) {
    		die("Failed to connect:" . mysqli_connect_error());
  		}

  		mysqli_set_charset($connect, "utf8");

  		return $connect;
	}

	$con = connect();
?>