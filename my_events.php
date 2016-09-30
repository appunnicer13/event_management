<?php
  require "connect_server.php";
    session_start();
    if(!isset($_SESSION['event_mgmt_username']))
    {
         echo('<meta http-equiv="refresh" content="0;url=login_signup.php" /> ');

    }
?>
<head>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<html>
    <head>
        <!-- <link rel="stylesheet" type="text/css" href="user_sidebar.css"> -->
            <!-- Latest compiled and minified CSS -->

                  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="bootstrap/jquery-2.1.3.min.js"></script>

            
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <style type="text/css">
        a{
            cursor: pointer;
        }
        </style>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>



<script type="text/javascript">

	var event_id=0;
	function add_member(id)
	{
		event_id=id;
	}

	function add()
	{
		var name=document.getElementById('member_name').value;
    event_id=document.getElementById('id').value;
		
		var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		     document.getElementById("demo").innerHTML = this.responseText;
		    }
		  };
		  xhttp.open("GET", "add_member.php?member_name="+name+"&event_id="+event_id, true);
		  xhttp.send();

      return false;
	}


  function get_members(id)
  {
    
     var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
        document.getElementById("members").innerHTML = this.responseText;
       }
     };
     xhttp.open("GET", "get_members.php?event_id="+id, true);
     xhttp.send();

  }


	function show_event(category,heading,description,id)
	{
		// console.log(description);
		document.getElementById('cat').innerHTML=category;
		document.getElementById('head').innerHTML=heading;
		document.getElementById('desc').innerHTML=description;
		document.getElementById('image').src="event_images/"+id;
		document.getElementById('id').value=id;
    get_members(id);
		document.getElementById('event_details').style.display="block";
		document.getElementById('blur').style.display="block";


		// document.getElementById('')
	}

	function  hide_event() {
		document.getElementById('event_details').style.display="none";
		document.getElementById('blur').style.display="none";
		// body...
	}



</script>


    

    </head>

<div id="blur" style="position: fixed;width: 100%;height: 100%;background: rgba(0,0,0,0.7);display: none"></div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style="margin-right: 100px">Event Management</a>
      <form class="navbar-brand"style="margin-top:-15px;margin-bottom: 0px;color:black"> <input type="text" name="search" placeholder="Search.."></form>
    </div>

    <ul class="nav navbar-nav" style="margin-left: 200px">


      <li class="active"><a href="index.php">Home </a></li> 
      <!-- <li></li> -->
      <li><a onclick="show_event_creater()">Create Event</a></li>
      <li><a href="my_events.php">My Events</a></li>
      <li><a href="login_signup/logout.php">Logout</a></li>
    </ul>
  </div>
</nav>


<?php
	require "connect_server.php";
	session_start();
?>


<div id="demo"></div>
<!-- 
<input type="text" id="member_name"><button onclick="add()"> Add</button>
 -->
<?php
	
	$username=$_SESSION['event_mgmt_username'];
	$sql="SELECT * from Events where creater ='$username'
			";

	$events=$conn->query($sql);
	if(!$events)
	{
		echo($conn->error);
	}

	// if($events->num_rows>0)
	// {
	// 	while($row=$events->fetch_assoc())
	// 	{
	// 		echo("<button onclick='add_member(this.id)' id='".$row['id']."'>" . " Add Member </button>");
	// 		$div="<div id='' >";
	// 		echo($row['heading'] ." " . $row['category'] ." ".$row['creater'] ."<br>");
	// 	}
	// }
?>


 	<div>
      <div class="table-responsive">
      <table class="table table-hover" style="font-size: 18px">
      <tr>
      	<td>S.No </td>
      	<td> Category </td>
      	<td> Heading </td>
      	<td> Location </td>
      	<td> Action </td>
      </tr>
		<?php
        $i=0;
        while($event_ob=$events->fetch_assoc())
        {
          $i++;
          $row="
          <tr>
            <td>".$i."</td>
            <td>".$event_ob['category']."</td>
            <td>".$event_ob['heading']." </td>
            <td> ".$event_ob['location']."</td>
            <td> <button class='btn btn-success' 
            onclick=\"show_event("."'".$event_ob['category']."','".$event_ob['heading']."','".$event_ob['description']."',".$event_ob['id'].")\"> view </button></td>
         
          </tr>";

          echo($row);
            
        }

        echo("</table>");
      
        ?>

     </table>
     </div>
     </div>


   <div id="event_details" style="margin-top:-600px;display: none">

	  <div  style="display:block; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Event Deatils</div>
                        </div>  
                        <div class="panel-body" >
                            <div id="" class="form-horizontal">
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                    
                                
                                  
                                <div class="form-group">
                                    <label for="Playlist Category" class="col-md-3 control-label">Category</label>
                                    <div class="col-md-9" id="cat">
                                       	
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="event details" class="col-md-3 control-label">Heading</label>
                                    <div class="col-md-9" id="head">
                                      
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="Singer" class="col-md-3 control-label">Description</label>
                                    <div class="col-md-9" id="desc">
                                        
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label for="image" class="col-md-3 control-label">Related Image</label>
                                    <div class="col-md-9">
                                       <img src="" id="image" height="300px" width="300px">
                                    </div>
                                </div>
                                    

                                <div class="form-group">
                                    <label for="event details" class="col-md-3 control-label">Description</label>
                                    <div clas s="col-md-9" id="desc">
                                       <!--  type="text" class="form-control" name="heading" placeholder="Heading" required> -->
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="event details" class="col-md-3 control-label">Add Member</label>
                                    <div class="col-md-9" id="">
                                        <form  onsubmit="return add()"><input type="text" id="member_name" class="form-control" name="member_name" placeholder="member name" required>
                                        <input type="hidden" id="id" name="event_id"></input>
                                        </form>
                                    </div>
                                </div>
                               

                                <div class="form-group">
                                    <label for="event details" class="col-md-3 control-label">Members</label>
                                    <div class="col-md-9" id="members">
                                        
                                    </div>
                                </div>

                                
                              
                                

                                <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">                                          
                                        
                                <!-- <div class="form-group"> -->
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <!-- <input id="btn-signup" value="Upload" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> -->
                                       &nbsp &nbsp &nbsp <button id="btn-signup" type="button" class="btn btn-info" onclick ="hide_event()">Cancel</button>
                                    </div>
                                <!-- </div> -->
                                </div>
                                
                                                          
                            </div>
                         </div>
                    </div>
           
         </div> 
 </div>