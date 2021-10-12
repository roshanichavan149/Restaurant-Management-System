<?php

session_start();
$username = "";
$name = "";
$email = "";
$password_1 = "";
$password_2 = "";
$address = "";
$contact = "";

$errors = array();

$db = mysqli_connect("localhost" , "root" , "" , "project") or die("could not connect to databse");

//REGISTER USERS
if(isset($_POST['reg_user']))
{
$username = mysqli_real_escape_string($db , $_POST['username']);
$name = mysqli_real_escape_string($db , $_POST['name']);
$email = mysqli_real_escape_string($db , $_POST['email']);
$password_1 = mysqli_real_escape_string($db , $_POST['password_1']);
$password_2 = mysqli_real_escape_string($db , $_POST['password_2']);
$address = mysqli_real_escape_string($db , $_POST['address']);
$contact = mysqli_real_escape_string($db , $_POST['contact']);

if(empty($username)){
	array_push($errors, "Username is required");
}
if(empty($name)){
	array_push($errors, "Name is required");
}
if(empty($email)){
	array_push($errors, "Email is required");
}
if(empty($address)){
	array_push($errors, "Address is required");
}
if(empty($contact)){
	array_push($errors, "Contact is required");
}
if(empty($password_1)){
	array_push($errors, "Password is required");
}
if($password_1 != $password_2){
	array_push($errors, "Passwords do not match");
}

$user_check_query = "select * from customer where username = '$username' or email = '$email' limit 1";
$results = mysqli_query($db , $user_check_query);
$user = mysqli_fetch_assoc($results);

if($user)
{
	if($user['username'] === $username)
	{
		array_push($errors , "Username already exists");
	}
	if($user['email'] === $email)
	{
		array_push($errors , "The email is already registered");
	}
}

if(count($errors) == 0)
{
	$password = $password_2;
	$query = "insert into customer(username , name , email , password , address , contact ) values ('$username' , '$name' , '$email'  , '$password', '$address' , '$contact')";
	mysqli_query($db , $query);
	$_SESSION['username'] = $username;
	$_SESSION['success'] = "You are now logged in ";
	header('location: login.php');
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
            crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="registration.css">
</head>
<body>
<div class="overlay">

<form action="registration.php" method="post">
	<?php include("errors.php") ?>
 
   <div class="con">
 
   <header class="head-form">
      <h2>Register Here</h2>
 
      <p>Register here and enjoy our services</p>
   </header>
  
   <br>
   <div class="field-set">
  
         <span class="input-item">
           <i class="fa fa-user-circle"></i>
         </span>
         <input class="form-input" id="txt-input" type="text" placeholder="@UserName" name="username" required>
      <br>

      <span class="input-item">
           <i class="fa fa-user"></i>
         </span>
         <input class="form-input" id="txt-input" type="text" placeholder="@FullName" name="name" required>
      <br>

      <span class="input-item">
           <i class="fa fa-envelope"></i>
         </span>
         <input class="form-input" id="txt-input" type="email" placeholder="@Email" name="email" required>
      <br>
	  
	  <span class="input-item">
        <i class="fa fa-key"></i>
       </span>
     
      <input class="form-input" type="password" placeholder="Password" id="pwd"  name="password_1" required>
      <br>

      <span class="input-item">
        <i class="fa fa-key"></i>
       </span>
     
      <input class="form-input" type="password" placeholder="Confirm Password" id="pwd"  name="password_2" required> 
      <br>

      <span class="input-item">
           <i class="fa fa-map-marker"></i>
         </span>
         <input class="form-input" id="txt-input" type="text" placeholder="@Address" name="address" required>
      <br>

      <span class="input-item">
           <i class="fa fa-phone"></i>
         </span>
         <input class="form-input" id="txt-input" type="text" placeholder="@Contact" name="contact" required>
      <br>

      <button class="log-in"  name="reg_user"> Register Now </button>
   </div>
      <button class="btn submits sign-up" onclick="document.location='login.php'">Sign In
      <i class="fa fa-user-plus" aria-hidden="true"></i>
      </button>
   </div>
  </div>
</form>
</div>
</body>
</html>