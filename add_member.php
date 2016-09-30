<?php
	require "connect_server.php";
?>

<?php
	// if(isset() && !empty())
	
	{	
		$member=$_GET['member_name'];
		$event_id=$_GET['event_id'];
	}

	$sql="INSERT INTO Members (id , name )
			values ('".$event_id."' , '".$member."')
		";

		

	if($conn->query($sql))
	{
		$message="member added successfully";
	}

	else
	{
		$message=$conn->error;
	}

	echo($message);


?>


<meta http-equiv="refresh" content="0;url=my_events.php" />
