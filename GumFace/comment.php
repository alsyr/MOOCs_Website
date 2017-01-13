<?php include('includes/header.html'); ?>
<?php include('includes/headerHome.html'); ?>

<link rel="stylesheet" href="css/result.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script src="http://malsup.github.com/jquery.form.js"></script> 

<script>
	function savecom()
	{	
		$('#Cancel').attr("value", "Return");
		$('#Post').css("background-color", "gray");
		$('#Post').css("color", "black");
		$('#Post').css("cursor", "not-allowed");
		$('#Post .hover').css("background-color", "gray");
		$('#Post .hover').css("color", "black");
		$('#Post .hover').css("cursor", "not-allowed");
		document.getElementById("Post").disabled = true;

		var js_id = document.getElementById('idval').value;
		var js_title = document.getElementById('title').value;
		var js_comment = document.getElementById('comment').value;
		var ratings = document.getElementsByName('rating');
		var js_rating;

		for(var i = 0; i < ratings.length; i++)
		{
			if(ratings[i].checked)
			{
				js_rating = ratings[i].value;
				break;
			}
		}

		//alert("HERE: \n" + js_id  + "\n" + js_title + "\n" + js_comment + "\n" + js_rating);
		$.post("save_com.php", {"courseID":js_id, "title": js_title, "comment": js_comment,  "rating": js_rating}, commentHandler);
	}

	function commentHandler(data, status)
	{
		$('#txt_status').html("Success! Thank you for your input!");
	}
</script>

<style>
	h2, hr
	{
		color: #913A8B;
		border-color: #913A8B;
		text-align: center;
	}
	#course_info
	{
		margin: auto;
		padding: 20px;
		width: 75%;		
		text-align: center;
	}
	#course_info img
	{
		margin: 5px;
		padding: 0;
		width: 100px;
		height: 100px;
	}
	#comment_box
	{
		margin: auto;
		padding: 50px;
		width: 500px;
		height: 500px;
		text-align: center;
	}
	#rating_container
	{
		padding: 20px;
		text-align: center;
	}
	#rate_val
	{
		display: inline-block;
		margin: 0 20px;
	}
	#input_container
	{
		padding: 20px;
		border: 1px solid;
		border-color: #913A8B;
		border-radius: 10px;
		background-color: #913A8B;
		color: white;
		text-align: left;
	}
	input
	{
		display: inline-block;
		margin-bottom: 20px;
	}
	input[type=radio]
	{
		margin: 0;
		padding: 0;
	}
	input[type=text]
	{
		padding: 3px;
		border: 0;
		border-radius: 2px;
		width: 100%;
		font-size: 14pt;
	}
	textarea
	{
		padding: 3px;
		border: 0;
		border-radius: 2px;
		width: 100%;
		font-size: 14pt;
	}
	input[type=submit], input[type=button]
	{
		border: none;
		border-radius: 5px;
		margin: 20px;
		padding: 10px;
		width: 100px;
		color: #913A8B;
		background-color: #59BFCF;
		font-size: 14pt;
		font-weight: bold;
	}
	input[type=submit]:hover, input[type=button]:hover
	{
		background-color: #913A8B;
		color: white;
		cursor: pointer;
	}
</style>

	<div id="container">
		<?php
			$courseID = $_GET['id'];
			//print "<h1>".$courseID."</h1";

			try
			{
				$con = new PDO("mysql:host=localhost;dbname=moocs160;charset=utf8mb4", "root", "biddle");
			$con->exec("set names utf8");
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$query = "SELECT * FROM course_data WHERE id=".$courseID;
				$result = $con->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);

				print "<div id='course_info'>";
					print "<h2>".$row["title"]."</h2>";
					print "<img src='".$row["course_image"]."' alt='Image of ".$row["title"]."' />";
					print "<p>".$row["short_desc"]."</p>";
					print "<hr />";
				print "</div>";

				print "<div id='comment_box'>";
					/*----------------------------- FORM ---------------------------*/
					print "<form id='com' method='post' action='course_page.php?id=".$courseID."'>";
						
						// Input Rating (radio buttons)
						print "<div id='rating_container'>";
							print "<h2>Rate Course</h2>";
							print "<div id='rate_val'>";
								print "<input id='rating1' type='radio' name='rating' value='1'><br />";
								print "<label for='rating1'>1</label>";
							print "</div>";
							print "<div id='rate_val'>";
								print "<input id='rating2' type='radio' name='rating' value='2'><br />";
								print "<label for='rating2'>2</label>";
							print "</div>";
							print "<div id='rate_val'>";
								print "<input id='rating3' type='radio' name='rating' value='3' checked><br />";
								print "<label for='rating3'>3</label>";
							print "</div>";
							print "<div id='rate_val'>";
								print "<input id='rating4' type='radio' name='rating' value='4'><br />";
								print "<label for='rating4'>4</label>";
							print "</div>";
							print "<div id='rate_val'>";
								print "<input id='rating5' type='radio' name='rating' value='5'><br />";
								print "<label for='rating5'>5</label>";
							print "</div>";
						print "</div>";

						// Input Texts
						print "<div id='input_container'>";
							print "<label>Title</label><br />";
							print "<input type='text' name='title' id='title' maxLength='40'><br />";
							print "<label>Comment (250 char limit)</label><br />";
							print "<textarea form='com' name='comment' id='comment' rows='7' cols='60' maxLength='250' wrap='hard' ></textarea><br />";
							//$time = date('Y-m-d G-i-s');
							//print "<p id='txt_status'>".$time."</p>";
							print "<p id='txt_status'></p>";
						print "</div>";
						print "<input type='submit' id='Cancel' value='Cancel'>";
						print "<input type='button' id='Post' value='Post' onclick='savecom()'>";
						print "<input type='hidden' id='idval' value='".$courseID."'>";
						//print "<input type='hidden' id='time' value='".$time."'>";
					print "</form>";
				print "</div>";
			}
			catch(PDOException $ex)
			{
				echo 'ERROR: '.$ex->getMessage();
			}
		?>
	</div>