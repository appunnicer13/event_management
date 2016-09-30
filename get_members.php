<?php
	require "connect_server.php"
?>


<?php
	$id=$_GET['event_id'];

	$sql="SELECT name from Members where id=$id order by name";

	$result=$conn->query($sql);

	while($member=$result->fetch_assoc())
	{
		echo($member['name']."<br>");
	}

?>