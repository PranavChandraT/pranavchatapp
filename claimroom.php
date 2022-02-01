<?php

include("connection.php");
$room = $_POST['room'];

  if(strlen($room)>15 or strlen($room)<2)
  {
    $msg = "Please choose room name between 2 to 15 charecters";

    echo '<script language="javascript">';
    echo 'alert("'.$msg.'");';
    echo 'window.location = "http://localhost/Pranav%20Chandra/" ;';
    echo '</script>';
  }

$query = "SELECT * FROM rooms WHERE roomname =  '$room' ";
$result = mysqli_query($conn,$query);

    if($result)
    {
      if(mysqli_num_rows($result)>0)
      {
        $msg = "Room Already in use!. Please choose a different one";

        echo '<script language="javascript">';
        echo 'alert("'.$msg.'");';
        echo 'window.location = "http://localhost/Pranav%20Chandra/" ;';
        echo '</script>';
      } 
      else
      {
        $query = "INSERT INTO rooms(roomname,ctime) VALUES ('$room',CURRENT_TIMESTAMP)";

        if(mysqli_query($conn,$query))
        {
          $msg = "Your room is ready for chat";

          echo '<script language="javascript">';
          echo 'alert("'.$msg.'");';
          echo 'window.location = "http://localhost/Pranav%20Chandra/rooms.php?roomname='.$room.'" ;';
          echo '</script>';
        }
      }
    }
    else
    {
      echo "ERROR!".mysqli_error($conn);
    }

  
?>