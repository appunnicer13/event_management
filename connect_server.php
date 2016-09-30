<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="event_management";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	// // create DataBase if not present already


	// $sql = "CREATE DATABASE IF NOT EXISTS event_management";

	// if($conn->query($sql)!==TRUE)
	// {
	// 	echo("DataBase does not exists"."<br/>");
	// }


?>