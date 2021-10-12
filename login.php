<?php

session_start();
$username = "";
$email = "";

$errors = array();

$db = mysqli_connect("localhost" , "root" , "" );
mysqli_select_db($db , "project");


//LOGIN USERS

if(isset($_POST['login_user']))
{
	$username = mysqli_real_escape_string($db , $_POST['username']);
	$password = mysqli_real_escape_string($db , $_POST['password_1']);

	$sql = "select username , customer_id from customer where username = '$username' and password = '$password' ";
	$count = 0;
	$result = mysqli_query($db , $sql);
	$count = mysqli_num_rows($result);
  $user = "admin";
	if($count > 0)
	{
		//session_start();
		$multi_array = array();
   $row = mysqli_fetch_array($result);
		foreach ($row as $key ) {
			$_SESSION["username"] = $key['username'];
			$_SESSION["customer_id"] = $key['customer_id'];
      if($row['username'] == $user)
      {
        header('location: admin.php');
      }
      else
      {
        header('location: home.php');
      }
		}
	}
}	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
            crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div class="overlay">

<form action="login.php" method="post">

   <div class="con">

   <header class="head-form">
      <h2>Log In</h2>

      <p>login here using your username and password</p>
   </header>

   <br>
   <div class="field-set">
     

         <span class="input-item">
           <i class="fa fa-user-circle"></i>
         </span>

         <input class="form-input" id="txt-input" type="text" placeholder="@UserName" name="username" required>
     
      <br>
     
      <span class="input-item">
        <i class="fa fa-key"></i>
       </span>
      
      <input class="form-input" type="password" placeholder="Password" id="pwd"  name="password_1" required>
          
      <br>

      <button class="log-in"  name="login_user"> Log In </button>
   </div>
      <button class="btn submits sign-up" onclick="document.location='registration.php'">Sign Up
      <i class="fa fa-user-plus" aria-hidden="true"></i>
      </button>
  </div>
</form>
</div>
</body>
</html>