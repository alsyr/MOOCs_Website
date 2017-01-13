<?php

$courseID = $_GET['id'];

try {
	$con = new PDO("mysql:host=localhost;dbname=moocs160;charset=utf8mb4", "root", "biddle");
			$con->exec("set names utf8");
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO roadmap_data (course_id)
	VALUES (".$courseID.")";
    // use exec() because no results are returned
	$con->exec($sql);

	$message1 = "New course added successfully to your roadmap";
	echo "<script type='text/javascript'>alert('$message1');</script>";
}
catch(PDOException $e)
{
	$message2 = "already in your roadmap";
	echo "<script type='text/javascript'>alert('$message2');</script>";
}

?>