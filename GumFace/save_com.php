<?php
	try
	{
		$courseID = filter_input(INPUT_POST, "courseID");
		$rating = filter_input(INPUT_POST, "rating");
		$title = filter_input(INPUT_POST, "title");
		$comment = filter_input(INPUT_POST, "comment");

		$con = new PDO("mysql:host=localhost;dbname=moocs160;charset=utf8mb4", "root", "biddle");
			$con->exec("set names utf8");
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = "INSERT INTO  course_ratings (course_id, rating) VALUES (".$courseID.", ".$rating.")";
		$result = $con->exec($query);

		if(strlen($comment) > 0)
		{
			//$queryRID = "SELECT id FROM course_ratings WHERE course_id=".$courseID;
			//$idval = $con->query($queryRID);
			if(strlen($title) == 0)
				$title = "--untitled--";
			$query2 = "INSERT INTO course_comments (course_id, subject, comment) VALUES (".$courseID.", '".$title."', '".$comment."')";
			$result2 = $con->exec($query2);
		}
	}
	catch(PDOException $ex)
	{
		echo 'ERROR: '.$ex->getMessage();
	}
?>