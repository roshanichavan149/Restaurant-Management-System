<?php
session_start();
$username = "";
$email = "";
$contact = "";
$rating = "";
$text = "";

$errors = array();

$db = mysqli_connect("localhost" , "root" , "" , "project") or die("could not connect to databse");


if(isset($_POST['feedback_user']))
{
$rating = mysqli_real_escape_string($db , $_POST['rating']);
$text = mysqli_real_escape_string($db , $_POST['text']);

if(count($errors) == 0)
{
	$query = "insert into feedback(rating , text ) values ('$rating' , '$text')";
	mysqli_query($db , $query);
	$_SESSION['success'] = "Your feedback is now placed ! ";
	header('location: home.php');
}
}


?>
<!--
		
		<div>
			<label for="text">Feedback</label>
			<input type="text" name="text" required>
		</div>

		<button type="submit" name="feedback_user" onclick="myFunction()">Post Now</button>
		</form>
	</div>
<script>
	function myFunction(){
		alert("Your feedback is placed ! Glad to hear your response !!!!!");
		location.replace("home.php");
	}
</script>
</body>
</html>
-->


<!DOCTYPE html>
<html>
<head>
	<title>Feedback Page</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
            crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="feedback.css">
</head>
<body>
<div class="overlay">

<form action="feedback.php" method="post" >
<?php include("errors.php") ?>
   <div class="con">

   <header class="head-form">
      <h2>Give your feedback now </h2>

      <p>We are glad to hear from you</p>
   </header>

   <br>
   <div class="field-set" >
     
         <span class="input-item">
           <i class="fa fa-user-circle"></i>
         </span>
         <input class="form-input" id="txt-input" type="text" placeholder="@Username" name="username">
         <br>
     
      <span class="input-item">
           <i class="fa fa-envelope"></i>
         </span>
         <input class="form-input" id="txt-input" type="email" placeholder="@Email" name="email">
      <br>

      <span class="input-item">
           <i class="fa fa-phone"></i>
         </span>
         <input class="form-input" id="txt-input" type="text" placeholder="@Contact" name="contact">
      <br>

      <span class="input-item">
        <i class="fa fa-star" aria-hidden="true"></i>
       </span>
      <input class="form-input" type="text" placeholder="@Rating" name="rating" maxlength="5" required>
      <br>

       <span class="input-item">
        <i class="fa fa-comment" aria-hidden="true"></i>
       </span>
      <input class="form-input" type="text" placeholder="@Feedback" name="text" required>
      <br>

      <button class="log-in" onclick="myFunction()"  name="feedback_user"> Post Now </button>
      <button class="log-in" onclick="myFunctionHome()"> Back To Home </button>
   </div>
   </div>
  </div>
</form>
</div>
<script>
	function myFunction(){
		alert("Your feedback is placed ! Glad to hear your response !!!!!");
		location.replace("home.php");
	}

  function myFunctionHome(){
    location.replace("home.php");
  }
</script>

</body>
</html>