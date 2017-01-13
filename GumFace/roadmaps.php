<?php include('includes/header.html'); ?>
<?php include('includes/headerRoadmaps.html'); ?>
<iframe name="myIframe" style="visibility:hidden;display:block; height: 10px">
</iframe>
<link rel="stylesheet" href="css/roadmaps.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script></head>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script src="js/jquery-confirm.js" type="text/javascript"></script>

<script language="javascript">
// load jquery here before calling this
$(document).ready(function() {

    // delete the entry once we have confirmed that it should be deleted
    $('.delete').click(function() {
    	var parent = $(this).parent().parent();
    	//closest("div.course_container")
    	//course_container
    	$.ajax({
    		type: 'get',
			url: 'removeFromRoadmap.php', // <- replace this with your url here
			data: 'ajax=1&delete=' + $(this).attr('id'),
			beforeSend: function() {
				parent.animate({'backgroundColor':'#fb6c6c'},300);
			},
			success: function() {
				parent.fadeOut(300,function() {
					parent.remove();
				});
			}
		});	        
    });		
});
</script>

<div id="page">
	<?php
	try
	{
		$con = new PDO("mysql:host=localhost;dbname=moocs160;charset=utf8mb4", "root", "biddle");
			$con->exec("set names utf8");
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = "SELECT id, title ".
		"FROM course_data, roadmap_data ".
		"WHERE course_data.id = roadmap_data.course_id";
		$result = $con->query($query);
		$row = $result->fetch(PDO::FETCH_ASSOC);

		print "<div class='course_page_container'>";

		$data = $con->query($query);
		$data->setFetchMode(PDO::FETCH_ASSOC);

		foreach($data as $row)
		{
			$id = $row["id"];

				//FULL CONTAINER
			print "<div id='course_container'>\n";
			print "<div id='the_course'>";
			print "<h2><a style='color: #913A8B' href='course_page.php?id=".$row["id"]."'>".$row["title"]."</a></h2>";
			print "</div>";
			print "<div id='minus_container'>";
			print "<input type='button' id='$id' class='delete' value='-'>";
			print "</div>";
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
