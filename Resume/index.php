<!-- Author: Syed Alfran Ali
	ID : 2015Kucp1032
	Work: The page to display the resume and the logout button
-->

<?php

	//include the connection file
	include "getConnection.php";

	//start the session
	session_start();

	//redirect to login if session is not set
	if(!isset($_SESSION["name"]))
	{
		header("Location: login.php");
	}

	//select the collection resume
	$collection = $db->resume;
	//running a find query on the collection and taking the result in $result
	$result = $collection->find();
	//convert the cursor object returned by find into an array
	$document = iterator_to_array($result,false);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Resume</title>
    <meta charset="UTF-8">
	<!-- include the jquery, bootstrap and css files -->
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/work.css">
    <link rel="stylesheet" href="css/project.css">
    <link rel="stylesheet" href="css/education.css">
    <link rel="stylesheet" href="css/map.css">
    <link rel="stylesheet" href="css/footer.css">
</head>

<body>
	<!-- the header subsection -->
    <div class="container-fluid header">
        <div class="page-header">
						<!-- the logout button-->
						<div class="row">
							<div class="col-md-1 col-md-offset-11">
								<a class="btn btn-primary" href="logout.php" style="float:right;">Logout</a>
							</div>
					</div>
					<div class="row">
						<div class="col-md-6 ">
							<h1 id="name"></h1>
						</div>
					</div>
      	</div>
        <div class="row">
            <div class="col-md-2 col-md-offset-1 info">
                <h5>mobile <label id="mobile"></label></h5>
            </div>
            <div class="col-md-2 info">
                <h5>email <label id="email"></label></h5>
            </div>
            <div class="col-md-2 info">
                <h5>github <b><a id="github" href="#" target="_blank"  style="text-decoration:none;color:white;"></a></b></h5>
            </div>
            <div class="col-md-2 info">
                <h5>twitter <b><a id="twitter" href="#" target="_blank" style="text-decoration:none;color:white;"></a></b></h5>
            </div>
            <div class="col-md-2 info">
                <h5>location <label id="location"></label></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-3">
                <img id="image" src="" style="width: 100%;">
            </div>

            <div class="col-md-10 col-xs-11">
                <div class="row">
                    <p><i id="welcomeMessage"></i></p>
                </div>
					<!-- the list of skills -->
                <div class="row skill">
                    <h3><i>Skills at a Glance:</i></h3>
                </div>
                <div class="row">
                    <ul id="skills">

                    </ul>
                </div>
            </div>
        </div>
    </div>
	<!-- script to display bio in header subsection -->
	<script>
		function showBio(){

			document.getElementById("name").innerHTML = "<?php print_r($document[0]["bio"]["name"]);?> <small>  <?php print_r($document[0]["bio"]["role"]);?></small>";

			document.getElementById("mobile").innerHTML = "<?php print_r($document[0]["bio"]["contacts"][0]["mobile"]);?>";
			document.getElementById("email").innerHTML = "<?php print_r($document[0]["bio"]["contacts"][0]["email"]);?>";
			document.getElementById("github").innerHTML = "<?php print_r($document[0]["bio"]["contacts"][0]["github"]);?>";
			document.getElementById("github").href = "<?php echo 'https://bitbucket.org/'.$document[0]["bio"]["contacts"][0]["github"];?>";
			document.getElementById("twitter").innerHTML = "<?php print_r($document[0]["bio"]["contacts"][0]["twitter"]);?>";
			document.getElementById("twitter").href = "<?php echo 'https://twitter.com/'.$document[0]["bio"]["contacts"][0]["twitter"];?>";
			document.getElementById("location").innerHTML = "<?php print_r($document[0]["bio"]["contacts"][0]["location"]);?>";
			document.getElementById("image").src = "<?php print_r($document[0]["bio"]["biopic"]);?>";
			document.getElementById("welcomeMessage").innerHTML = "<?php print_r($document[0]["bio"]["welcomeMessage"]);?>";

			<?php
				for($count=0;$count<count($document[0]["bio"]["skills"]);$count++)
				{
					?>
						document.getElementById("skills").innerHTML += "<li><label><?php print_r($document[0]["bio"]["skills"][$count]);?></li></label>"
					<?php
				}
			?>

		}
	</script>
		<!-- call the function showBio. the name is stored in database  -->
	<?php echo "<script> ".$document[0]["bio"]["display"]."(); </script>";?>


		<!-- the work experience subsection -->
    <div class="container-fluid work">
        <div class="row">
            <h2>Work Experience</h2>
        </div>

	<?php
			/* display the same code for all jobs in the database  */
		for($count =0;$count<count($document[2]["work"]["jobs"]);$count++)
		{
	?>
		<div class="row">
            <div class="row">
                <a href="#" id="<?php echo 'employer'.$count;?>" ></a>
            </div>
            <div class="row">
                <div class="pull-left">
                    <h6><i id="<?php echo 'dates'.$count;?>"></i></h6>
                </div>
                <div class="pull-right">
                    <h6><i id="<?php echo 'location'.$count;?>"></i></h6>
                </div>
            </div>
            <div class="row">
                <p  id="<?php echo 'description'.$count;?>"></p>
            </div>
        </div>
			<!-- the script that puts the values in work experience subsection -->
		<script>
			function showWork()
			{
				document.getElementById("<?php echo 'employer'.$count; ?>").addEventListener("click",function(){console.log("<?php print_r($document[2]["work"]["jobs"][$count]["employer"]);?> - <?php print_r($document[2]["work"]["jobs"][0]["title"])?>");});
				document.getElementById("<?php echo 'employer'.$count; ?>").innerHTML = "<?php print_r($document[2]["work"]["jobs"][$count]["employer"]);?> - <?php print_r($document[2]["work"]["jobs"][0]["title"])?>";
				document.getElementById("<?php echo 'dates'.$count; ?>").innerHTML = "<?php print_r($document[2]["work"]["jobs"][$count]["dates"]);?>";
				document.getElementById("<?php echo 'location'.$count; ?>").innerHTML = "<?php print_r($document[2]["work"]["jobs"][$count]["location"]);?>";
				document.getElementById("<?php echo 'description'.$count; ?>").innerHTML = "<?php print_r($document[2]["work"]["jobs"][$count]["description"]);?>";
			}
		</script>
			<!-- call the showWork function for every job in loop -->
		<?php echo "<script> ".$document[2]["work"]["display"]."(); </script>";?>
	<?php
		}
	?>
	</div>

		<!-- the project subsection -->
    <div class="container-fluid project">
        <div class="row">
            <h2>Projects</h2>
        </div>
     <?php
			/* display the same code for all projects  */
		for($count =0;$count<count($document[3]["projects"]["projects"]);$count++)
		{
	?>
		<div class="row">
            <div class="row">
                <a href="#" id="<?php echo 'projectName'.$count;?>"></a>
            </div>
            <div class="row">
                <h6><i id="<?php echo 'projectDates'.$count;?>"></i></h6>
            </div>
            <div class="row">
                <p id="<?php echo 'projectDescription'.$count;?>"></p>
            </div>
			<!-- img tag to display project images -->
			<div class="row">
				<div class="col-md-4">
					<img id="<?php echo 'projectImage'.$count;?>" src="" style="width: 100%;"><br/><br/>
				</div>
			</div>
        </div>
		<script>
		/* the script that puts the values in projects subsection */
			function showProjects()
			{
				document.getElementById("<?php echo 'projectName'.$count; ?>").innerHTML = "<?php print_r($document[3]["projects"]["projects"][$count]["title"]);?>";
				document.getElementById("<?php echo 'projectDates'.$count; ?>").innerHTML = "<?php print_r($document[3]["projects"]["projects"][$count]["dates"]);?>";
				document.getElementById("<?php echo 'projectDescription'.$count; ?>").innerHTML = "<?php print_r($document[3]["projects"]["projects"][$count]["description"]);?>";
				document.getElementById("<?php echo 'projectImage'.$count; ?>").src = "<?php print_r($document[3]["projects"]["projects"][$count]["images"]);?>";
			}
		</script>
			<!-- call the showProjects function for every project in loop -->
		<?php echo "<script> ".$document[3]["projects"]["display"]."(); </script>";?>

	<?php
		}
	?>
	</div>

	<!-- the education subsection -->
    <div class="container-fluid education">
        <div class="row">
            <h2>Education</h2>
        </div>
     <?php
			/* display the same code for all schools  */
		for($count =0;$count<count($document[1]["education"]["schools"]);$count++)
		{
	?>
		<div class="row">
            <div class="row">
									<!--target="_blank" makes it open in another tab so that console does not refresh-->
                <a href="#" id="<?php echo 'schoolName'.$count;?>" target="_blank"></a>
            </div>
            <div class="row">
                <div class="pull-left">
                    <h6><i id="<?php echo 'schoolDate'.$count;?>"></i></h6>
                </div>
                <div class="pull-right">
                    <h6><i id="<?php echo 'schoolLocation'.$count;?>"></i></h6>
                </div>
            </div>
            <div class="row">
                <p>
                    <strong><i id="<?php echo 'schoolMajor'.$count;?>"></i></strong>
                </p>
            </div>

        </div>

		<script>
		/*the script that puts the values in schools subsection of education*/
			function showSchool()
			{
				document.getElementById("<?php echo 'schoolName'.$count; ?>").innerHTML = "<?php print_r($document[1]["education"]["schools"][$count]["name"]);?> - <?php print_r($document[1]["education"]["schools"][$count]["degree"]);?>";
				document.getElementById("<?php echo 'schoolName'.$count; ?>").href = "<?php print_r($document[1]["education"]["schools"][$count]["url"]);?>"

				document.getElementById("<?php echo 'schoolName'.$count; ?>").addEventListener("click",function(){console.log("<?php print_r($document[1]["education"]["schools"][$count]["url"]);?>");});

				document.getElementById("<?php echo 'schoolDate'.$count; ?>").innerHTML = "<?php print_r($document[1]["education"]["schools"][$count]["dates"]);?>";
				document.getElementById("<?php echo 'schoolLocation'.$count; ?>").innerHTML = "<?php print_r($document[1]["education"]["schools"][$count]["location"]);?>";
				document.getElementById("<?php echo 'schoolMajor'.$count; ?>").innerHTML = "Major: <?php print_r($document[1]["education"]["schools"][$count]["majors"][0]);?>";
			}
		</script>
			<!-- call the showSchools function for every school in loop -->
		<?php echo "<script> ".$document[1]["education"]["display"][0]."(); </script>";?>

	<?php
		}
	?>

        <div class="row" style="margin-bottom:1em;">
            <b><i>Online Classes<i></b>
        </div>
    <?php
			/* display the same code for all onlineCourses  */
		for($count =0;$count<count($document[1]["education"]["onlineCourses"]);$count++)
		{
	?>
		<!--target blank makes it open in another tab so that console does not refresh-->
			<div class="row">
				<a href="#" id="<?php echo 'onlineName'.$count;?>" target="_blank"></a>
			</div>
			<div class="row" >
				<h6><i id="<?php echo 'onlineDate'.$count;?>"></i></h6>
			</div>
			<div class="row">
				<a href="#" id="<?php echo 'onlineUrl'.$count;?>" target="_blank"></a>
			</div>

			<!-- the script that puts the values in onlineCourses subsection of education -->
			<script>
			function showOnlineCourse()
			{
				document.getElementById("<?php echo 'onlineName'.$count; ?>").innerHTML = "<?php print_r($document[1]["education"]["onlineCourses"][$count]["title"]);?> - <?php print_r($document[1]["education"]["onlineCourses"][$count]["school"]);?>";

				document.getElementById("<?php echo 'onlineName'.$count; ?>").href = "<?php print_r($document[1]["education"]["onlineCourses"][$count]["url"]);?>";

				document.getElementById("<?php echo 'onlineName'.$count; ?>").addEventListener("click",function(){console.log("<?php print_r($document[1]["education"]["onlineCourses"][$count]["url"]);?>");});

				document.getElementById("<?php echo 'onlineDate'.$count; ?>").innerHTML = "<?php print_r($document[1]["education"]["onlineCourses"][$count]["date"]);?>";

				document.getElementById("<?php echo 'onlineUrl'.$count; ?>").innerHTML = "<?php print_r($document[1]["education"]["onlineCourses"][$count]["url"]);?>";
				document.getElementById("<?php echo 'onlineUrl'.$count; ?>").href = "<?php print_r($document[1]["education"]["onlineCourses"][$count]["url"]);?>";

			}
		</script>
			<!-- call the showOnlineCourse function for every online course in loop -->
		<?php echo "<script> ".$document[1]["education"]["display"][1]."(); </script>";?>


    <?php
		}
	?>
	</div>

	<!-- the map subsection -->
	<div class="container-fluid map">
        <div class="row">
            <h2>Where I've Lived and Worked</h2>
        </div>
			<!-- map is displayed here -->
		<div id="map"></div>
        <script>
			/* the script that displays the map*/
        function initMap() {
            var myLatLng = {
                lat: 26.862,
                lng: 75.807
            };

				var myHouse = {
					lat: 28.621,
					lng: 77.224
				};

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: myLatLng
        });


				var contentString1 = '<div id="content">'+
 				 '<p>Jaipur. I live here. Done college from here.<br/></p>'+
				 '</div>';

				var contentString2 = '<div id="content">'+
				  '<p>Went here for an amazing trip! :)<br></p>'+
				  '</div>';


				var infowindow = new google.maps.InfoWindow({
					content: contentString1,
					maxWidth: 500
				  });

				var infowindow2 = new google.maps.InfoWindow({
					content: contentString2,
					maxWidth: 500
				  });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Jaipur'
        });

				var marker2 = new google.maps.Marker({
                    position: myHouse,
                    map: map,
                    title: 'Delhi'
                });


			  marker.addListener('click', function() {
				infowindow.open(map, marker); console.log("Jaipur");
			  });


			  marker2.addListener('click', function() {
				infowindow2.open(map, marker2); console.log("Delhi");
			  });


			}
        </script>
		<!-- the google maps API  -->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7vk-UQsqCICwVtsDzo8xCFTbN4zO8VTU&callback=initMap">
        </script>
    </div>

	<!-- the footer subsection -->
    <div class="container-fluid footer">
        <div class="row connect">
            <h2>Let's Connect</h2>
        </div>
		<!-- display the contact details -->
        <div class="row contacts">
            <div class="col-md-2 col-md-offset-1 info">
                <h5>mobile <label><?php print_r($document[0]["bio"]["contacts"][0]["mobile"]);?></label></h5>
            </div>
            <div class="col-md-2 info">
                <h5>email <label><?php print_r($document[0]["bio"]["contacts"][0]["email"]);?></label></h5>
            </div>
            <div class="col-md-2 info">
                <h5>github <b><a href="<?php echo 'https://bitbucket.org/'.$document[0]["bio"]["contacts"][0]["github"];?>" target="_blank"  style="text-decoration:none;color:white;"> <?php print_r($document[0]["bio"]["contacts"][0]["github"]);?></a></b></h5>
            </div>
            <div class="col-md-2 info">
                <h5>twitter <b><a href="<?php echo 'https://twitter.com/'.$document[0]["bio"]["contacts"][0]["twitter"];?>" target="_blank" style="text-decoration:none;color:white;"> <?php print_r($document[0]["bio"]["contacts"][0]["twitter"]);?> </a></b></h5>
            </div>
            <div class="col-md-2 info">
                <h5>location <label><?php print_r($document[0]["bio"]["contacts"][0]["location"]);?></label></h5>
            </div>
        </div>
    </div>

</body>

</html>
