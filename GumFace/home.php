<?php include('includes/header.html'); ?>
<?php include('includes/headerHome.html'); ?>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript">
$(function() {
	$("#tabs").tabs();
});
</script>
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
	<section class="backgroundPic">
		<img src="./images_files/banner3.jpg" width="600" alt="" class="background_pic">
	</section>

	<div class="searchBar">
		<form action="search.php" method="post">
			<div class="search_bar">
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

<div class="page">
	<!-- ==== START MAIN ==== -->
	<main role="main">
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Courses</a></li>
				<li><a href="#tabs-2">Professions</a></li>
				<li><a href="#tabs-3">MOOCS</a></li>
			</ul>
			<div id="tabs-1">
				<h2>Available Courses</h2>
				<p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
			</div>
			<div id="tabs-2">
				<h2>High Demand Professions</h2>
				<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
			</div>
			<div id="tabs-3">
				<h2>Course Listings' Locations</h2>
				<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
				<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
			</div>
		</div><!--end tab-->

		<section class="post">
			<h1>Our Goal</h1>
			<div class="post-blurb">
				<p>We seek to encourage the will to learn. With courses that range from history to biology, we strive to offer a collection of thousands of readily available online-courses for all users.</p>
			</div>
		</section>

		<section class="post">
			<h1> Our Services</h1>
			<div class="post-blurb">
				<p>Those who sign up will have access to several of our great features and services like: roadmaps course planning, forum discussion boards and much more!. Come join our community of academics and have fun learning.</p>
			</div>
		</section>
	</main>
	<!-- end main -->

</div>
<!-- end sidebar -->

</div>
<!-- end container -->

<?php include('includes/footer.html'); ?>