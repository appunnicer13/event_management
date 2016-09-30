<?php
	require "../connect_server.php";
?>

<?php

session_start();



	$Users_message="Not a POST request ";
	$correct="You have been successfully registered to this web site";


	if($_SERVER['REQUEST_METHOD']=='POST')    			// check if method request is POST
	{
			
			//echo("Users_FORM");
		if(_isset() && !_empty())						// call _isset and _empty to check if all the input fields are filled and set
		 	  {
		 	  	
												
				 	 $username=$_POST['username'];
				 	 $password1=md5($_POST['password']);
				 	 $password2=md5($_POST['confirm_password']);
				 	 //$password2=md5($_POST['password2']);

				 	 $email=$_POST['email'];
				 	 $name=$_POST['name'];
				 	 // $gender=htmlentities($_POST['gender'], ENT_QUOTES, "UTF-8");
				 	 // $country=htmlentities($_POST['country'], ENT_QUOTES, "UTF-8");
				 	 // $date_of_birth=$_POST['date_of_birth'];
				
				 	 // if($password1!=$password2)			// input passwords donot match
				 	 // {

				 	 // 	$Users_message="Password and confirm password did not match";
				 	 	
				 	 // }

				 	if($password1==$password2)
				 	 {
				 	 	$password=$password1;
				 	 	$check_duplicate="SELECT username FROM Users WHERE username='$username'";
				 	 	$run_query=$conn->query($check_duplicate);

				 	 	if($run_query->num_rows>0)
				 	 	{
				 	 		$Users_message="Username ".$username." already exists";
				 	 		// die($Users_message);
				 	 		
				 	 	}


				 	 	else 						// call insert_user to insert user in database
				 	 	{	
				 	 		$Users_message= insert_user($name,$username,$password,$email,$conn,$Users_message);
				 	 		
				 	 	}

				 	 }

				 	 else
				 	 {
				 	 	$Users_message="password and confirmed password does not match";
				 	 }



		 	  }

		 	//  echo $Users_message;

		 	  if($Users_message!=$correct)
		 	  {
		 	  		
		 	  		 echo("<head>");
			        // echo($login_message);
			        echo(" <meta http-equiv=\"refresh\" content=\"0; URL=../signup.php?Users_error=" .$Users_message ."\" />");
			        echo("</head>");
		 	  }

		 	  else
		 	  {
  				echo(" <meta http-equiv=\"refresh\" content=\"0; URL=../index.php\" />");		 	
  			  }

	}





	////////////////////////////////////////////////////////////////////
	//// function _isset check if all the input fields are filled or not
	////////////////////////////////////////////////////////////////////

	function _isset()
	{
		 if(										
			 	(
			 	  isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])
						 && isset($_POST['name'])
			  	)
		   )
		 {

		 	return true;
		 }

		 else{
		 	$GLOBALS['Users_message']="Fields are not set";
		 	return false;
		 }
			
	}

	////////////////////////////////////////////////////////////////////
	////// function _empty check if all the input fields are filled or not
	////////////////////////////////////////////////////////////////////

	function _empty()
	{
		  if(										
			 	(
			 	  !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])
			  	  && !empty($_POST['name']) 
			  	)
		   )
		 {

		 	return false;
		 }

		 else{
			$GLOBALS['Users_message']="Fields are not filled";
		 	
			return true;
		}
	}


	////////////////////////////////////////////////////////////////////
	// function to insert user into the database
	////////////////////////////////////////////////////////////////////

	function insert_user($name,$username,$password,$email,$conn,$Users_message)  				
	{		
		
		$sql="INSERT INTO Users (name,username,email,password) VALUES 
	  	('".mysql_real_escape_string($name)."','".mysql_real_escape_string($username)."','".mysql_real_escape_string($email)."',
		'".mysql_real_escape_string($password)."')";	
		
		if($conn->query($sql))
		{
			
			$_SESSION['mm_username']=$username;
			unset($_POST);
			return "You have been successfully registered to this web site";

		}

		else
		{
			// die("database insertion problem function insert_user");
			die($conn->error);
			return "database insertion problem function insert_user";

		}
						 	 		
	}




?>




<!-- <meta http-equiv="refresh" content="0;url=index.php" /> -->
