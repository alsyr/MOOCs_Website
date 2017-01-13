<?php include('includes/header.html'); ?>
<?php include('includes/headerHome.html'); ?>
<iframe name="myIframe" style="visibility:hidden;display:none">
</iframe>
<link rel="stylesheet" href="css/result.css">

<style>
#course_head
{
	background-color: gray;
	background-repeat: repeat-x;
	background-size: 50% 100%;
	text-align: center;
	vertical-align: bottom;
	min-height: 300px;
}
h1
{
	font-size: 30pt;
	font-weight: bold;
	text-align: center;
	color: #913A8B;
}
h2
{
	color:#913A8B;
	text-align: center;
}
h4
{
	color:#913A8B;
	text-align: center;
	margin: 0;
	padding: 0;
}
#course_link
{
	text-align: center;
}
#plus_sign
{
	text-align: center;
}
input[type=submit]
{
	border: none;
	border-radius: 5px;
	padding: 10px;
	color: #913A8B;
	background-color: #59BFCF;
	font-size: 14pt;
	font-weight: bold;
}
input[type=submit]:hover
{
	background-color: #913A8B;
	color: white;
	cursor: pointer;
}
hr
{
	background-color: #913A8B;
	height: 3px;
}
#info_container
{
	margin: 0;
	padding: 0;
	padding: 20px;
	clear: both;
	text-align: center;
}
#info_rating
{
	
}
#info_rating p 
{
	color: #913A8B;
}
#info_element
{
	display: inline-block;
	border: 1px solid;
	border-color: #913A8B;
	border-radius: 5px;
	background-color: #913A8B;
	margin: 10px;
	padding: 5px;
	width: 180px;
	height: 120px;
	text-align: center;
	vertical-align: middle;
	color: white;
}
#info_element a, #info_element p, #info_element h4
{
	margin: 0;
	padding: 0;
	color: white;
	text-align: center;
}
#info_element hr
{
	margin: 0;
	height: 0;
	height: 0;
	color: white;
}
#course_summary
{
	margin: 0;
	padding: 10px 50px;
}
#course_summary p
{
	text-align: left;
	color: black;
}
.professors_container
{
	padding: 0;
	margin: 0;
	text-align: center;
	vertical-align: bottom;
}
.course_professor
{
	display: inline-block;
	margin: 0 10px;
	padding: 10px;
	text-align: center;
}
.course_professor img
{
	margin: 0;
	padding: 0;
	margin-left: auto;
	margin-right: auto;
	width: 80px;
	height: 80px;
}
.course_professor p
{
	margin: 0;
	padding: 0;
	margin-left: auto;
	margin-right: auto;
	font-size: 14pt;
	color: #913A8B;
}
#video_container
{
	margin: auto;
	padding: 0 50px;
	padding-bottom: 50px;
	text-align: center;
	vertical-align: middle;
}
#new_comment
{
	margin: auto;
	padding: 10px;
	width: 80%;
	text-align: center;
	vertical-align: middle;
}
#comments_container
{
	margin: auto;
	padding: 25px;
	border-radius: 5px;
	width: 80%;
	text-align: center;
	vertical-align: middle;
	background-color: #913A8B;
	color: white;
}
#comment
{
	margin: 30px auto;
	padding: 10px;
	border: 1px solid;
	border-color: #913A8B;
	border-radius: 5px;
	width: 80%;
	background-color: white;
	padding-color: #CD92C8;
	color: white;
}
#comment p
{
	text-align: left;
	color: black;
	font-family: arial, helvetica;
}
#comment hr
{
	margin: 0;
	padding: 0;
	height: 2px;
	color: #913A8B;
}

#com_header
{
	margin: 0;
	padding: 0;
	width: 100%;
	height: 3%;
}
#com_header p 
{
	margin: 0;
	padding: 0;
	display: inline-block;
	clear: right;
	height: 2px;
	color: #913A8B;
	position: relative;
	font: 'Gill Sans MT';
	font-weight: bold;
	bottom: 4px;
	font-size: 22;

}
#com_rate 
{
	margin:0;
	padding:0;
	float:right;
	height: 2px;
	color: #913A8B;
	position: relative;
	font: 'Gill Sans MT';
	font-weight: bold;
	bottom: 2px;
	font-size: 22;
}
#com_header h4
{
	margin: 0;
	padding: 0;
	display: inline-block;
	float: left;
	clear: left;
}
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script src="http://malsup.github.com/jquery.form.js"></script> 

<script>
var pressed = 0;
function upvote(idinput, positive, negative, posInc, negInc)
{	
	document.getElementById("upvoteb").disabled = true;
	document.getElementById("downvoteb").disabled = false;
	var temp = pressed;
	pressed = 1;
	$.post("com_rating.php", {"cID":idinput, "positive":positive, "negative":negative, "press":temp}, ratingHandler(idinput, positive, negative, posInc, negInc, pressed));

}
function downvote(idinput, positive, negative, posInc, negInc)
{	
	document.getElementById("downvoteb").disabled = true;
	document.getElementById("upvoteb").disabled = false;
	var temp = pressed;
	pressed = 2;
	$.post("com_rating.php", {"cID":idinput, "positive":positive, "negative":negative, "press":temp}, ratingHandler(idinput, positive, negative, posInc, negInc, pressed));
		//$('#negb').html("Comment rated!");
	}

	function ratingHandler(idinput, positive, negative, posInc, negInc, history)
	{
		//alert("HERE: \n" + idinput  + "\n" + positive + "\n" + negative);
		if(positive == 1)
		{
			$(("#posb" + idinput)).html(posInc + 1);
			if (history == 1)
			{
				$(("#negb" + idinput)).html(negInc);
			}
			//$('#posb').html((toInc + 1)+" <img src='./images_files/thumbs_up.png' bottom='0px' width='25' height='25'>");
		}
		if(negative == 1)
		{
			$(("#negb" + idinput)).html(negInc + 1);
			if (history == 2)
			{
				$(("#posb" + idinput)).html(posInc);
			}
			

		}
		//alert("HERE: \n" + $input  + "\n" + $positive + "\n" + $negative);
	}	
	</script>


	<div id="container">
		<?php
		$courseID = $_GET['id'];
			//print "<h1>".$courseID."</h1";

		try
		{
			$con = new PDO("mysql:host=localhost;dbname=moocs160;charset=utf8mb4", "root", "biddle");
			$con->exec("set names utf8");
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$qCourse = "SELECT * FROM course_data WHERE id=".$courseID;
			$result = $con->query($qCourse);
			$row = $result->fetch(PDO::FETCH_ASSOC);

			$qProf = "SELECT * FROM coursedetails WHERE course_id=".$courseID;
			$professors = $con->query($qProf);

			$qRate = "SELECT count(id) as c, avg(rating) as r FROM course_ratings WHERE course_id=".$courseID;
			$result3 = $con->query($qRate);
			$rate = $result3->fetch(PDO::FETCH_ASSOC);

			$qCom = "SELECT * FROM course_comments WHERE course_id=".$courseID;
			$comments = $con->query($qCom);
				//$comments->setFetchMode(PDO::FETCH_ASSOC);

			$row["title"] = ucwords($row["title"]);
			$row["site"] = str_replace('http://', "", $row["site"]);
			$row["site"] = str_replace('/', "", $row["site"]);
			$row["site"] = str_replace('www.', "", $row["site"]);
			$row["site"] = str_replace('.com', "", $row["site"]);

			/*-------------------------- COURSE PAGE HEADER ---------------------------*/
			print "<div id='course_head' style='background-image: url(".$row["course_image"].")'>";
			print "</div>";
			print "<h1>".$row["title"]."</h1>";

			print "<div id='plus_sign'>";
			print "<form method='post' action='addToRoadmap.php?id=".$courseID."' target='myIframe'>";
			print "<input type='submit' value='+'>";
			print "</form>";
			print "</div>";
			
			print "<div id='course_link'>";
			print "<form action='".$row["course_link"]."'>";
			print "<input type='submit' value='Original Course Page'>";
			print "</form>";
			print "</div>";
			print "<h4>Hosted by </h4><p style='text-align: center'>".$row["university"]."</p>";
			print "<hr /><br />";

			/*--------------------------- COURSE CONTENT ----------------------------*/
			print "<div id='info_container'>";

					// Course Rating
			print "<div id='info_rating'>";
			if($rate["c"] > 0)
				print "<p>".$rate["c"]." reviews | ".round($rate["r"], 1)." out of 5</p>";
			print "</div>";

					// Course Information
			print "<div id='info_element'>";
			print "<h4>Origin</h4><hr /><br />";
			print "<a href='https://www.".$row["site"].".com'><p>".$row["site"]."</p></a>";
			print "</div>";
			print "<div id='info_element'>";
			print "<h4>Language</h4><hr /><br />";
			print "<p>".$row["language"]."</p>";
			print "</div>";
			print "<div id='info_element'>";
			print "<h4>Duration</h4><hr /><br />";
			if($row["start_date"] == "0000-00-00")
				print "<p>Self-Paced</p>";
			else
				print "<p>Begins: ".$row["start_date"]."</p>";
			print "<br /><p>".$row["course_length"]." weeks</p>";
			print "</div>";
			print "<div id='info_element'>";
			print "<h4>Cost</h4><hr /><br />";
			if($row["course_fee"] == 0)
				print "<p>Free</p>";
			else
				print "<p>$".$row["course_fee"]."</p>";
			print "</div>";
			print "</div>";

				// Course Summary
			print "<div id='course_summary'>";
			print "<h2>About This Course</h2>";
			print "<p>".$row["long_desc"]."</p>";
			print "</div>";

				// Course Instructors
			print "<div class='professors_container'>";
			foreach($professors as $prof)
			{
						//$prof["profname"] = str_replace(" ", "<br/>", $prof["profname"]);

				print "<div class='course_professor'>";
				print "<p><img src='".$prof["profimage"]."'></p>";
				print "<p>".$prof["profname"]."</p>";	
				print "</div>";	
			}
			print "</div>";

				// Course Video
			if(strlen($row["video_link"]) > 0)
			{
				print "<div id='video_container'>";
				print "<video width='500px' height='400px' controls>";
				print "<source src='".$row["video_link"]."'>";
				print  "Browser doesn't support video tag.";
				print "</video>";
				print "</div>";
			}
			print "<hr /><br />";

			/*------------------------ ADD COMMENT ----------------------------*/
			print "<div id='new_comment'>";
			print "<h2>Post A New Comment</h2>";
			print "<form method='post' action='comment.php?id=".$courseID."'>";
			print "<input type='submit' value='Rate & Comment'>";
			print "</form>";
			print "</div>";

			/*-------------------------- COMMENTS -------------------------------*/
			print "<div id='comments_container'>";
			print "<h2  style='color: white'>Comments</h2>";
			foreach($comments as $com)
			{
				$comId = "SELECT * FROM comm_rate WHERE comment_id=".$com["id"];
				$result = $con->query($comId);
				$likes = $result->fetch(PDO::FETCH_ASSOC);

				if(!$likes)
				{
					$query = 'INSERT INTO comm_rate(comment_id, positive, negative) VALUES ('.$com["id"].', 0, 0)';
					$result = $con->exec($query);
				}
				$comId = "SELECT * FROM comm_rate WHERE comment_id=".$com["id"];
				$result = $con->query($comId);
				$likes = $result->fetch(PDO::FETCH_ASSOC);
				$time = date("M d, Y", strtotime($com["time"]));

				print "<div id='comment'>";
				print "<div id='com_header'>";
				print "<h4>".$com["subject"]."</h4>";
				print "<div id='com_rate'>";
				print "<p id='posb".$com['id']."'>".$likes["positive"]."</p>";
				print "<button type='input' id='upvoteb' style='border: 0; background: transparent'>";
				print "<img src='./images_files/thumbs_up.png' bottom='0px' width='25' height='25' ";
				print "onclick='upvote(".$com['id'].", 1, 0, ".$likes["positive"].", ".$likes["negative"].")'/>";
				print "</button>";

				print "<p id='negb".$com['id']."'>".$likes["negative"]."</p>";
				print "<button id='downvoteb' type='input' style='border: 0; background: transparent'>";
				print "<img src='./images_files/thumbs_down.png' bottom='0px' width='25' height='25' ";
				print "onclick='downvote(".$com['id'].", 0, 1, ".$likes["positive"].", ".$likes["negative"].")'/>";
				print "</button>";
				print "</div>";
				print "</div>";
				print "<hr />";
				print "<p>".$com["comment"]."</p>";
				print "<p style='font-size: 10pt; font-style: italic; color: #928D92'>on ".$time."</p>";
				print "</div>";
			}
			print "</div>";
		}
		catch(PDOException $ex)
		{
			echo 'ERROR: '.$ex->getMessage();
		}
		?>
	</div>
