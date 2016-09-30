


	<?php

    require "connect_server.php";

    $category=$_GET['search_input'];
    $cat="";
    for($i=0;$i<strlen($category);$i++)
    {
       $cat=$cat.'%'.$category[$i];
    }

    $cat=$cat.'%';

    // work to be done
		$sql="SELECT * from Events where category like '$cat' ";
		$events=$conn->query($sql);

    if(!$conn->query($sql))
    {
        die($sql." ".$conn->error);
    }
    else
    {
      // echo($sql." ".$events->num_rows);
    }
	?>


 	
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

