<?php
	require "connect_server.php";
    session_start();
    if(!isset($_SESSION['event_mgmt_username']))
    {
         echo('<meta http-equiv="refresh" content="0;url=login_signup.php" /> ');

    }
?>

<head>
              <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="bootstrap/jquery-2.1.3.min.js"></script>

        <!-- <link rel="stylesheet" type="text/css" href="user_sidebar.css"> -->
            <!-- Latest compiled and minified CSS -->
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
		
			function show_event_creater()
			{
				document.getElementById('event_creater').style.display="block";
				document.getElementById('blur').style.display="block";
			}

			function hide_event_creater()
			{
				document.getElementById('event_creater').style.display="none";
				document.getElementById('blur').style.display="none";
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



	// toggle=0;
	 // function like()
	 // {
	 // 	toggle=(toogle+1)%2;

	 // 	// if(toggle==1)

	 // 	document.getElementById("likes").

	 // }



	function show_event(category,heading,description,id,likes)
	{
		// console.log(description);
		document.getElementById('cat').innerHTML=category;
		document.getElementById('head').innerHTML=heading;
		document.getElementById('desc').innerHTML=description;
		document.getElementById('image').src="event_images/"+id;
		// document.getElementById('likes').innerHTML=likes+"Likes";
		// document.getElementById('id').value=id;
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


 function check_blank_string(search_input)
        {
            var len=search_input.length;
            var spaces=0;
            for(var i=0;i<len;i++)
            {
                if(search_input[i]==' ')
                {
                    spaces++;
                }
            }
            // console.log(spaces+" "+len);
            if(spaces==len)
            return true;

            return false;
        }



  function search(search_input)
        {
            var xmlhttp=new XMLHttpRequest();
            // console.log(check_blank_string(search_input));
            if(!check_blank_string(search_input))
            {
            xmlhttp.open("GET","search_category.php?search_input="+search_input);

            xmlhttp.onreadystatechange=function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // console.log(xmlhttp.responseText);
                    if(xmlhttp.responseText.length>0)
                    document.getElementById('events').innerHTML=xmlhttp.responseText;

                    else 
                    {
                        document.getElementById('search_results').innerHTML="<br><a><li> No such category exists</li></a><br>";
                    }
                }
            }
            xmlhttp.send();
            }

            else
            {
               document.getElementById('search_results').innerHTML="<br><a><li> No such category exists</li></a><br>";
            }
           
        }


		</script>

        <style>

		input[type=text] {
		    width: 250px;
		    box-sizing: border-box;
		    border: 2px solid #ccc;
		    border-radius: 4px;
		   
		    font-size: 15px;
		    background-color: white;
		    background-image: url('searchicon.png');
		    background-position: 10px 10px;
		    background-repeat: no-repeat;
		    padding: 5px 10px 5px 10px;
		    -webkit-transition: width 0.4s ease-in-out;
		    transition: width 0.4s ease-in-out;
		    margin-top:8px;
		    margin-bottom: -10px;
		}

		/*input[type=text]:focus {
		    width: 100%;
		}*/
		</style>


 </head>




<body>

<div id="blur" style="position:fixed;height: 100%;width: 100%; background:rgba(0,0,0,0.7);display: none"></div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style="margin-right: 100px">Event Management</a>
      <div class="navbar-brand"style="margin-top:-15px;margin-bottom: 0px;color:black"> <input type="text" onkeyup="search(this.value)" name="search" placeholder="Search for a category"></div>
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
		$sql="SELECT * from Events order by heading desc limit 10";
		$events=$conn->query($sql);
	?>


 	<div id="events">
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
                            <div class="panel-title">Event Details </div>
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
                                    <label for="Name of song" class="col-md-3 control-label">Heading</label>
                                    <div class="col-md-9" id="head">
                                      
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="Singer" class="col-md-3 control-label">Description</label>
                                    <div class="col-md-9" id="desc">
                                        
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label for="Choose song to upload" class="col-md-3 control-label">Related Image</label>
                                    <div class="col-md-9">
                                       <img src="" id="image" height="300px" width="300px">
                                    </div>
                                </div>
                                    

                                <div class="form-group">
                                    <label for="Name of song" class="col-md-3 control-label">Description</label>
                                    <div clas s="col-md-9" id="desc">
                                       <!--  type="text" class="form-control" name="heading" placeholder="Heading" required> -->
                                    </div>
                                </div>
                               
                                 <div class="form-group">
                                    <label for="Name of song" class="col-md-3 control-label">Members</label>
                                    <div clas s="col-md-9" id="members">
                                       <!--  type="text" class="form-control" name="heading" placeholder="Heading" required> -->
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





<div id="event_creater" style="display: none ; margin-top:-600px">

	  <div  style="display:block; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Create Event</div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="create_event.php">
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                    
                                
                                  
                                <div class="form-group">
                                    <label for="Playlist Category" class="col-md-3 control-label">Category</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="category" required placeholder="Choose a category ">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="Name of song" class="col-md-3 control-label">Heading</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="heading" placeholder="Heading" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Singer" class="col-md-3 control-label">Location</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="location" required placeholder="location ">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Name of song" class="col-md-3 control-label">Description</label>
                                    <div class="col-md-9">
                                        <textarea style="width:350px;height:350px" name="description"></textarea><!--  type="text" class="form-control" name="heading" placeholder="Heading" required> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Choose song to upload" class="col-md-3 control-label">Related Image</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="image" >
                                    </div>
                                </div>
                                    
                               

                                
                              
                                

                                <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">                                          
                                        
                                <!-- <div class="form-group"> -->
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <input id="btn-signup" value="Upload" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>
                                       &nbsp &nbsp &nbsp <button id="btn-signup" type="button" class="btn btn-info" onclick ="hide_event_creater()">Cancel</button>
                                    </div>
                                <!-- </div> -->
                                </div>
                                
                                                          
                            </form>
                         </div>
                    </div>
           
         </div> 
 </div>
 </body>