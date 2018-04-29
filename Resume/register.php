<!--
  Author: Sumir Mathur 
  ID: 2015KUCP1017
  Work: The registration page
-->

<?php
	include "getConnection.php";
	
  //starting session
  session_start();

  //declaring a string that will hold the errors
  $passErr = "";
  if(isset($_SESSION['name']))
  {
    //if session is set redirect to index.php page
    header("Location: index.php");
  }

  //when Register button is clicked this is executed
  else if(isset($_POST['register']))
  {
    //convert the passwords to md5 hash
    $pass = md5($_POST['password']);
    $passConfirm = md5($_POST['confirmPassword']);

    //if they are not identical display error
    if($pass != $passConfirm)
    {
      $passErr = "* Passwords do not match";
    }
	
    //if they are identical execute this block
    else
	{
		$collection = $db->users;
		
		//if connection established insert the details entered by user in database
        $document = array("username"=>$_POST["username"],"pass"=>$pass);
		if($collection->insert($document))
        {
          header("Location: login.php");
        }      
		//if any error is recieved
		else
		{
			$passErr = "* This is username already exits";
		}
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
    <title>Register</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


  </head>
  <body>

    <!--making a container for the page this div will have all the html of trhe page and give appropriate margins-->
      <div class="container">
		<div class="col-md-8 col-md-offset-4">
        <h2>Please Sign Up</h2>
        <!-- .text-danger class gives red colour to the text-->
          <div>Already a member?<a href="login.php" class="text-danger">Login</a></div>
        </div>
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
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
              </div>
            </div>
          </div>

          <!--The input element for password-->
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
              </div>
            </div>

          <!--The input element for confirm password-->
            <div class="col-md-3">
              <div class="form-group">
                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required>
              </div>
            </div>
          </div>

          <!--The place where errors (if any) are displayed-->
          <div class="row">
            <div class="col-md-3">
              <!-- an empty span to show the errors that occur when php code runs-->
              <span style="color:#cc0d0d;"><?php echo $passErr; ?></span>
            </div>
          </div>

          <!--the form submit button-->
          <div class="row">
            <div class="col-md-3">
              <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
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
