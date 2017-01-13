<?php
	try
	{
		$commID = filter_input(INPUT_POST, "cID");
		$positive = filter_input(INPUT_POST, "positive");
		$negative = filter_input(INPUT_POST, "negative");
		$press = filter_input(INPUT_POST, "press");



		$con = new PDO("mysql:host=localhost;dbname=moocs160;charset=utf8mb4", "root", "biddle");
			$con->exec("set names utf8");
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if($positive == 1 && $press != 1)
		{
			$query = "UPDATE comm_rate SET positive=(positive + 1) WHERE comment_id=".$commID;
			$result = $con->exec($query);

		}
	 	if($negative == 1 && $press != 2)
		{
			$query = "UPDATE comm_rate SET negative=(negative + 1) WHERE comment_id=".$commID;
			$result = $con->exec($query);

		}
		if($press == 1 && $positive != 1)
		{
			$query = "UPDATE comm_rate SET positive=(positive - 1) WHERE comment_id=".$commID;
			$result = $con->exec($query);

		}
		if($press == 2 && $negative != 1)
		{
			$query = "UPDATE comm_rate SET negative=(negative - 1) WHERE comment_id=".$commID;
			$result = $con->exec($query);
		}
	}
	catch(PDOException $ex)
	{
		echo 'ERROR: '.$ex->getMessage();
	}
?>