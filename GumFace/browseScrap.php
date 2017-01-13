<?php include('includes/header.html'); ?>
<?php include('includes/headerBrowse.html'); ?>
<?php include('includes/connect.php');?>

<style>

img{
border:1px solid #;
-webkit-border-radius: 20px;
-moz-border-radius: 20px;
border-radius: 20px;

}
</style>

<?php

#SAVE THE FOLLOWING INTO AN ARRAY
 $query = "SELECT category,course_link,course_image FROM course_data GROUP BY category HAVING ( COUNT(category) > 1 )";
	$category =   array();
	$link =  array();
	$images =   array(); 
	$newcategory = array();

#SUBMIT QUERY
 $result = mysql_query($query);
 while($person = mysql_fetch_array($result))
 {
 	array_push($category,$person['category']);
 	array_push($link,$person['course_link']);
 	array_push($images,$person['course_image']);
 }

#MAKE THE EMPTY CATERYGO AS UNCATEGORIZED
$category[0] = "Uncategorized";


echo "<table width=\"400\" border=\"0\" cellpadding=\"5\" style=\"margin-right:50px\"> <tr>";
for ($counter = 0 ; $counter < count($category) ; $counter++) 
{

		array_push($newcategory,$category[$counter]);
		$category[$counter]= preg_replace('/\s+/', '', $category[$counter]);

		// ECHO CATEGORIES TO SCREEN
		if($counter % 3 == 0 && $counter >= 2)
		{
			echo "</tr>";
			echo "<tr>";

			echo	"<td align=\"center\" valign=\"center\">";
   			echo    "<a href=".$category[$counter].".php target=\"_blank\">";
			echo	"<img src=".$images[$counter]." width=\"300\" height=\"300\"  alt=\"description here\" /></a>";
			echo	"<br />";
			echo    $newcategory[$counter];
			echo    "</td>";

			$myFile = $category[$counter].".php";
			$fh = fopen($myFile, 'w');

			// WRITE HEADERS FILES
			fwrite($fh,"<?php include('includes/header.html'); ?>" );
			fwrite($fh, "<?php include('includes/headerBrowse.html'); ?>");

			// PUSH coursese by categories to an indivual array
			$query2 = "SELECT title,course_link,short_desc,course_image FROM course_data WHERE course_data.category like '%".$newcategory[$counter]."%'";
			$title =   array();
			$course_descrition =  array();
			$course_link =   array(); 
			$course_image = array();

			#SUBMIT QUERY
			 $result2 = mysql_query($query2);
			 while($person2 = mysql_fetch_array($result2))
			 {

			 	array_push($title,$person2['title']);
			 	//		$category[$counter]= preg_replace('/\s+/', '', $category[$counter]);

			 	array_push($course_link,$person2['course_link']);
			 	//array_push($course_descrition,$person2['short_desc']);
			 	array_push($course_descrition,preg_replace("/\"/", '', $person2['short_desc']));
			 	array_push($course_image,$person2['course_image']);

			 }

			

			// START WRITING TABLE IN PHP FILE
			fwrite($fh,"<style>
				img.resize{
   					width:300px;
   					height:230px;
   
					}

										img{
					border:1px solid #;
					-webkit-border-radius: 20px;
					-moz-border-radius: 20px;
					border-radius: 20px;

}


					</style>
				");
			fwrite($fh, "<?php ");

				for ($counter2 = 0 ; $counter2 < count($title) ; $counter2++)
				{

				fwrite($fh,"
				echo \"<a href=\".\"".$course_link[$counter2]."\".\">\ <br>\";
				echo \"<img class=\".\"resize \" .\"src=\".\"".$course_image[$counter2]."\".\"/></a>\";
				echo \"$course_descrition[$counter2]\";
				echo \"<br>\";
				echo \"$title[$counter2]\".\"<br>\";

				");


				}


				#fwrite($fh, "echo \"".$title[$counter2].".\";");
					#fwrite($fh,"<br> ");
					#fwrite($fh,"echo \"<tr>\";");
					#fwrite($fh,"echo<td> ");
					#fwrite($fh,"echo \"<a href=\"".$course_link[$counter2].">\";");
					#fwrite($fh,"<img src= \"".$course_image[$counter2]."\"style=\"width:304px;height:228px;>\"");
					#fwrite($fh,"echo \"</a>\";");
					#fwrite($fh,"echo \" </td>\";");
					#fwrite($fh,"echo \"<td>\";");
					#fwrite($fh,"</tr>");

			fwrite($fh," ?> ");
			fwrite($fh, "<?php include('includes/footer.html'); ?>");
			fclose($fh);
		}
    	else 
    	{
   			echo	"<td align=\"center\" valign=\"center\">";
   			echo    "<a href=".$category[$counter].".php target=\"_blank\">";
			echo	"<img src=".$images[$counter]. " width=\"300\" height=\"300\" alt=\"description here\" /></a>";
			echo	"<br />";
			echo    $newcategory[$counter];
			echo    "</td>";

			// START WRITING TO TABLE
			$myFile = $category[$counter].".php";
			$fh = fopen($myFile, 'w');
			fwrite($fh,"<?php include('includes/header.html'); ?>" );
			fwrite($fh, "<?php include('includes/headerBrowse.html'); ?>");

			$query2 = "SELECT title,course_link,short_desc,course_image FROM course_data WHERE course_data.category like '%".$newcategory[$counter]."%'";
			$title =   array();
			$course_descrition =  array();
			$course_link =   array(); 
			$course_image = array();

			#SUBMIT QUERY
			 $result2 = mysql_query($query2);
			 while($person2 = mysql_fetch_array($result2))
			 {
			 	array_push($title,$person2['title']);
			 	array_push($course_link,$person2['course_link']);
			 	//array_push($course_descrition,$person2['short_desc']);
			 	array_push($course_descrition,preg_replace("/\"/", '', $person2['short_desc']));

			 	array_push($course_image,$person2['course_image']);

			 }

			fwrite($fh,"<style>
				img.resize{
   					width:300px;
   					height:230px;
   
					}

					img{
						border:1px solid #;
						-webkit-border-radius: 20px;
						-moz-border-radius: 20px;
						border-radius: 20px;

					}


					</style>
				");
			 #fwrite ($fh,count($title));
			
			fwrite($fh, "<?php ");
			//fwrite($fh," <table> ");
				for ($counter2 = 0 ; $counter2 < count($title) ; $counter2++)
				{
				fwrite($fh,"
				echo \"<a href=\".\"".$course_link[$counter2]."\".\">\ <br>\";
				echo \"<img class=\".\"resize \" .\"src=\".\"".$course_image[$counter2]."\".\"/></a>\";
				echo \"$course_descrition[$counter2]\";
				echo \"<br>\";
				echo \"$title[$counter2]\".\"<br>\";

				");	
				}
			fwrite($fh," ?> ");
			fwrite($fh, "<?php include('includes/footer.html'); ?>");
			fclose($fh);

		}
}

			echo "</tr>";
			echo "</table>";
?>


<?php include('includes/footer.html'); ?>