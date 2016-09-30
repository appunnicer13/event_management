<?php
	require "connect_server.php";
	session_start();
?>
<?php
	// create the event
	
	// if(correct_request() && values_set())
	{
		$category=$_POST['category'];
		$heading=$_POST['heading'];
		$location=$_POST['location'];
		$description=$_POST['description'];
		$message="Error in creating event";
		$username=$_SESSION['event_mgmt_username'];
		// $img_name= // heading id;

		$sql="INSERT INTO Events (category,heading,creater,description,location)
			 values ('".mysql_real_escape_string($category)."' , '".mysql_real_escape_string($heading)."' , '".mysql_real_escape_string($username)."' , '".mysql_real_escape_string($description)."' , '".mysql_real_escape_string($location)."' ) ";

		if($conn->query($sql))
		{
			$event_id=$conn->insert_id;

			$message="Database updated successfully";
		}
		
		else
		{
			echo($conn->error);
		}
	



		// store image 
		$directory="event_images";
		if(!file_exists($directory))
		{
			mkdir($directory);
		}



		$image_name=$event_id;

		$target_file=$directory."/".$image_name;

		if(!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
		{
			echo("Error while uploading image");
		}

		else
		{
			$message="Event created successfully";
		}


			if($message!="Event created successfully")
			{
				die($message);
			}
	}

?>

<meta http-equiv="refresh" content="0;url=index.php" />