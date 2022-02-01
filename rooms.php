<?php

include("connection.php");
$roomname = $_GET['roomname'];

$query ="SELECT * FROM rooms WHERE roomname = '$roomname'";

$result = mysqli_query($conn,$query);
if($result)
{
  if(mysqli_num_rows($result) == 0)
  {
    $msg = "This room does not exist kindly create a room first";

    echo '<script language="javascript">';
    echo 'alert("'.$msg.'");';
    echo 'window.location = "http://localhost/Pranav%20Chandra" ;';
    echo '</script>';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.anyClass
{
  height: 400px;
  overflow-y: scroll;
}
</style>
</head>
<body background="bg.jpg">

<h2>Chat Messages for <?php  echo $roomname ?></h2>

<div class="container">
  <div class ="anyclass">
</div>
</div>

<br>

<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Type your messages here">

<button class="btn btn-success" name="submitmsg" id="submitmsg">Send</button>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script>
// code for fetching messages from db


setInterval(runFunction,1000);


function runFunction()
{
  $.post("fetchmsg.php", {room: '<?php echo $roomname ?>'},
  function(data,status)
  {
    document.getElementsByClassName('anyClass')[0].innerHTML = data;
  }
  
  
  )
}




// Get the input field
var input = document.getElementById("usermsg");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("submitmsg").click();
  }
});
  </script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
$("#submitmsg").click(function()
{
  var clientmsg = $("#usermsg").val();

  $.post("postmsg.php", {text:clientmsg, room:'<?php echo $roomname?>', ip:'<?php echo $_SERVER['REMOTE_ADDR']?>'},
  
  function(data,status)
  {
    document.getElementsByClassName('anyClass')[0].innerHTML = data;
  }
  );

  $("#usermsg").val("");
  return false;

}
);
</script>
</body>
</html>
