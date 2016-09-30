

<?php
	
	require "../connect_server.php";
	session_start();
	// $_SESSION['event_mgmt_username']=;
	// echo($_SESSION['event_mgmt_username']);
?>



<?php


		// included code from db_connion.php 

	$login_message="";


	if($_SERVER['REQUEST_METHOD']=='POST')    			// check if method request is POST
	{
			
		if(login_isset() && !login_empty())						// call _isset and _empty to check if all the input fields are filled and set
		 	  {
		 	  	
			//echo("login_FORM");
												
				 	 $username=$_POST['username'];
				 	 $password1=md5($_POST['password']);
				
				 	
				 	 {
				 	 	$password=$password1;
				 	 	$check_duplicate="SELECT username FROM Users WHERE username='$username' AND password='$password'";
				 	 	$run_query=$conn->query($check_duplicate);

				 	 	if($run_query->num_rows>0)
				 	 	{
				 	 		$_SESSION['event_mgmt_username']=$username;
				 	 		$login_message="login successfully";
				 	 		// echo($login_message);
				 	 		unset($_POST);
				 	 		$str="<meta http-equiv=\"refresh\" content=\"0; URL=../index.php\">";

				 	 		// $str="<meta http-equiv=\"refresh\" content=\"0; URL=../index.php\">";
		 	  				echo($str);
				 	 		//echo($_POST['username']);
				 	 		
				 	 	}


				 	 	else 						// call insert_user to insert user in database
				 	 	{	
				 	 		$login_message="username or password not correct";
				 	 		// echo($login_message);
				 	 		$str="<meta http-equiv=\"refresh\" content=\"0; URL=../login_Users.php?login_message=".$login_message."\">";
				 	 		echo($str);

				 	 		// die($login_message);
				 	 		
				 	 	}

				 	 }



		 	  }

		 	  // echo $login_message;

		 	  // if($login_message!="login successfully")
		 	  // {
		 	  // 	$str="<meta http-equiv=\"refresh\" content=\"0; URL=../login_Users.php?login_message=\"".$login_message.">";
		 	  // 	// echo($str);
		 	  // }

		 	  // else
		 	  // {
		 	  // 	$str="<meta http-equiv=\"refresh\" content=\"0; URL=../index.php\">";
		 	  // }
	}

	////////////////////////////////////////////////////////////////////
	//// function _isset check if all the input fields are filled or not
	////////////////////////////////////////////////////////////////////

	function login_isset()
	{
		 if(										
			 	(
			 	  isset($_POST['username']) && isset($_POST['password'])
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

	function login_empty()
	{
		  if(										
			 	(
			 	  !empty($_POST['username']) && !empty($_POST['password'])
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

	

?>





<!-- <meta http-equiv="refresh" content="0;url=index.php" /> -->
