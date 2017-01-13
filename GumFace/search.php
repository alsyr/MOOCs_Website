<?php include('includes/header.html'); ?>
<?php include('includes/headerHome.html'); ?>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/result.css">
<link rel="stylesheet" href="css/search.css">

<style>
#dropdown_search{
	float: right;
	clear: both;
	width: 100%;
	height: 25px;
	width: auto;
	background-color: #913A8B;
	color: white;
}
#dropdown_search select
{
	border: 0;
	width: 100%;
	height: 100%;
	background-color: #913A8B;
	color: white;
	outline: none;
	font-size: 12pt;
}
#dropdown_search option
{
	border: 0;
	background-color: #913A8B;
	color: white;
}
#dropdown_search option:hover
{
	background-color: white;
	color: #913A8B;
}
</style>

<div class="backgroundBanner">

	<div class="searchBar">
		<iframe name="myIframe" style="visibility:hidden">
		</iframe>
		
		<form action="search.php" method="post">
			<div class="search_bar2">
				<input type="search" placeholder = "what would you like to learn about?" id = "search" name="SearchBar_Text" />
				<button class="icon" style="color: white"><i class="fa fa-search"></i></button>
				
				<!--added the category here-->
				<div id="dropdown_search">
					<select name = "Search_Categories">
						<option selected="selected" value='all' >All Choices</option>
						<option value='title'>Course Title</option>
						<option value='category'>Course Category</option>
						<option value='university'>University</option>
						<option value='website'>Website</option>
						<option value='professor'>Professor</option>
						<option value='description'>Course Description</option>
						<option value='language'>Language Taught In</option>
					</select>
				</div>
				
			</div>
		</form>
	</div>
</div>

<div id="container">
	<?php


	$SearchBarInput="";	

	/*get user's category of choice from drop down menu*/	
	$SearchCategory=filter_input(INPUT_POST, "Search_Categories");
	$SearchBarInput=filter_input(INPUT_POST, "SearchBar_Text");

	/*if user did not enter anything, return all results*/	
	if(strlen($SearchBarInput) <= 0) {
		$query = "SELECT * FROM course_data";		

		/*create the correct query based on user input of category*/
	} else {
		switch ($SearchCategory) {
			case "all":
			$query = "SELECT * FROM course_data WHERE title LIKE '%$SearchBarInput%' OR ".
			"short_desc LIKE '%$SearchBarInput%' OR ".
			"long_desc LIKE '%$SearchBarInput%' OR ".
			"start_date LIKE '%$SearchBarInput%' OR ".
			"category LIKE '%$SearchBarInput%' OR ".
			"language LIKE '%$SearchBarInput%' OR ".
			"university LIKE '%$SearchBarInput%' OR ".				 
			"site LIKE '%$SearchBarInput%' OR ".				 
			"EXISTS (SELECT * FROM coursedetails WHERE ".
				"course_data.id=coursedetails.course_id AND profname LIKE '%$SearchBarInput%')";
break;
case "title":
$query = "SELECT * FROM course_data WHERE title LIKE '%$SearchBarInput%'";
break;			
case "category":
$query = "SELECT * FROM course_data WHERE category LIKE '%$SearchBarInput%'"; 
break;
case "university":
$query = "SELECT * FROM course_data WHERE university LIKE '%$SearchBarInput%'";
break;
case "website":
$query = "SELECT * FROM course_data WHERE site LIKE '%$SearchBarInput%'";
break;
case "professor":
$query = "SELECT * FROM course_data WHERE EXISTS (SELECT * FROM coursedetails WHERE ".
	"course_data.id=coursedetails.course_id AND profname LIKE '%$SearchBarInput%')";
break;
case "description":
$query = "SELECT * FROM course_data WHERE (short_desc LIKE '%$SearchBarInput%') OR (long_desc LIKE '%$SearchBarInput%')";
break;
case "language":
$query = "SELECT * FROM course_data WHERE language LIKE '%$SearchBarInput%'";
break;
}
}

/*Print out the courses based on user's selection query*/
try
{
	/*Connect to MySQL DataBase*/
	$con = new PDO("mysql:host=localhost;dbname=moocs160;charset=utf8mb4", "root", "biddle");
	$con->exec("set names utf8");
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		


	print "<div class='course_page_container'>";

	$data = $con->query($query);
	$data->setFetchMode(PDO::FETCH_ASSOC);

	foreach($data as $row)
	{
		$id = $row["id"];
		$query2 = "SELECT profname, profimage ".
		"FROM coursedetails, course_data ".
		"WHERE coursedetails.course_id = ".$id." ".
		"GROUP BY profname";
		$profData = $con->query($query2);
		$profData->setFetchMode(PDO::FETCH_ASSOC);

		$row["site"] = str_replace(".com", "", $row["site"]);
		$row["site"] = str_replace("/", "", $row["site"]);
		$row["site"] = strtoupper(str_replace("http:www.", "", $row["site"]));
		$row["site"] = str_replace("", "", $row["site"]);

					//FULL CONTAINER
		print "<div class='course_container'>\n";
						//print "<h4><a style='color: #913A8B' href='".$row["course_link"]."'>".$row["title"]."</a></h4>";
		print "<h4><a style='color: #913A8B' href='course_page.php?id=".$row["id"]."'>".$row["title"]."</a></h4>";
		print "<p style='padding: 0; margin: 0; margin-left: 20px; margin-bottom: 10px; font-style: italic'>".$row["category"]."</p>";

						//LEFT CONTENT
		print "<a href='course_page.php?id=".$row["id"]."'><img src='".$row["course_image"]."'/></a>";

						//CENTER CONTENT
		print "<div class='course_description'>\n";
		print "<p style='color: #913A8B'>Short Description</p>";
		print "<p>".$row["short_desc"]."</p>";
							//print "<p style='color: #913A8B'>Long Description</p>";
							//print "<p>".$row["long_desc"]."</p>";
		print "</div>\n";

						//RIGHT CONTENT
		print "<div class='course_info'>\n";
		print "<p style='font-weight: bold; vertical-align: top'>".$row["site"]."</p>";
							//print "<p style='overflow: hidden'>".$row["university"]."</p>";
		if($row["certificate"] == "yes")
			print "<p style='font-style: italic; font-size: 10px;'>Eligible for Certificate</p>";
		print "<br/>";
		if(($row["start_date"] == 0000-00-00))
		{
			print "<p>Self-Paced</p>";
		}
		else
		{
			print "<p>Begins: ".$row["start_date"]."</p>";
		}
		if($row["course_length"] > 0)
			print "<p>".$row["course_length"]." weeks</p><br/>";
							//$row["language"] = strtoupper($row["language"]);
							//print "<p style='font-style: italic; color: #913A8B'>".$row["language"]."</p>";
		if(($row["course_fee"] == 0) or ($row["course_fee"] == -1))
		{
			print "<p style='color: green'>Free</p>\n";
		}
		else
		{
			print "<p style='color: green'>$ ".$row["course_fee"]."</p>\n";
		}
							//if(strlen($row["video_link"]) > 0)
								//print "<br/><a href='".$row["video_link"]."'><p>Video</p></a>";
						print "</div>"; // Closes Right-Side Course Content

						// BOTTOM CONTENT
						/*print "<div class='professors_container'>";
							foreach($profData as $row2)
							{
								$row2["profname"] = str_replace(" ", "<br/>", $row2["profname"]);

								print "<div class='course_professor'>";
									print "<p><img src='".$row2["profimage"]."'></p>";
									print "<p>".$row2["profname"]."</p>";	
								print "</div>";	
							}
						print "</div>"; // Closes professor-container
						*/
					print "</div>\n"; // Close course-container
				}
			print "</div>"; // Close course-page-container
		}
		catch(PDOException $ex)
		{
			echo 'ERROR: '.$ex->getMessage();
		}	
		?>
	</div>