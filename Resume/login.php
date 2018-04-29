<!--
Author: Syed Alfran Ali
 ID : 2015Kucp1032
  Work: The login page
-->

<?php
	include "getConnection.php";
  //starting session
  session_start();

  //declaring a string that will hold the errors
  $passErr = "";

  if(isset($_SESSION['name']))
  {
    //if session is set redirect to index page
	header("Location: index.php");
  }

  //when Login button is clicked this is executed
  else if(isset($_POST['login']))
  {

	//change collections to user collection
	$collection = $db->users;

	//convert the passwords to md5 hash
    $pass = md5($_POST['password']);

	//search condition in the collection
	$search = array("username"=>$_POST['username'],"pass"=>$pass);

	//if login is successful i.e. user exists in collection create sessions and redirect to index.php
	$result = $collection->find($search);

	//make the cursor object as returned by find() to an array
	$document = iterator_to_array($result,false);

	if($document != null)
	{
		$_SESSION['name'] = $_POST['username'];
		header("Location: index.php");
	}

	else
	{
	// if login unsuccessful show error
	  $passErr = "* Invalid credentials";
	}

  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Login</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


  </head>
  <body>

    <!--making a container for the page this div will have all the html of trhe page and give appropriate margins-->
      <div class="container">
		<div class="col-md-8 col-md-offset-4">
			<h2>Please Login</h2>
        </div>

		<!--to give a line before the form -->

		<div class="row">
			<div class="col-md-12">
				<br/>
				<hr>
				<br/>
			</div>
		</div>

		<div class="col-md-9 col-md-offset-3">
			<!-- form that sends the data to the same file using post method -->
			<form class="form" method="post" action="">
			  <!--using the grid system of bootstrap-->

			  <!--The input element for username-->
			  <div class="row">
				<div class="col-md-6">
				  <div class="form-group">
					<input type="text" class="form-control" name="username" id="username" placeholder="User Name" required>
				  </div>
				</div>
			  </div>

			<!--The input element for password-->
			  <div class="row">
				<div class="col-md-6">
				  <div class="form-group">
					<input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
				  </div>
				</div>
			  </div>

			  <!--The place where errors (if any) are displayed-->
			  <div class="row">
				<div class="col-md-3">
				  <!-- an empty span to show the errors that occur when php code runs-->
				  <span class="text-danger"><?php echo $passErr; ?></span>
				</div>
			  </div>

			  <!--the form submit button and register link-->
			  <div class="row">
				<div class="col-md-3">
				  <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
				</div>

				<div class="col-md-3">
				  <a href="register.php" class="btn btn-primary btn-block">Register</a>
				</div>

			 </div>
			</form><!--End of form-->
		</div><!-- End of col-md-9 -->
	</div><!--End of container-->



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
