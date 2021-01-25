<?php

session_start();
$booking_id = "";
$booking_name = "";
$booking_date = "";
$booking_time = "";
$guest = "";

$errors = array();

$db = mysqli_connect("localhost" , "root" , "" , "project") or die("could not connect to databse");

//REGISTER USERS
if(isset($_POST['book_user']))
{
$booking_name = mysqli_real_escape_string($db , $_POST['booking_name']);
$booking_date = mysqli_real_escape_string($db , $_POST['booking_date']);
$booking_time = mysqli_real_escape_string($db , $_POST['booking_time']);
$guest = mysqli_real_escape_string($db , $_POST['guest']);

if(empty($booking_name)){
	array_push($errors, "Name is required");
}
if(empty($booking_date)){
	array_push($errors, "Date is required");
}
if(empty($booking_time)){
	array_push($errors, "Time is required");
}
if(empty($guest)){
	array_push($errors, "Number of guests is required");
}


$user_check_query = "select * from booking where booking_name = '$booking_name' limit 1";
$results = mysqli_query($db , $user_check_query);
$user = mysqli_fetch_assoc($result);

if($user)
{
	if($user['booking_name'] === $booking_name)
	{
		array_push($errors , "Booking already exists");
	}
}

if(count($errors) == 0)
{
	$query = "insert into booking(booking_name , booking_date , booking_time ,guest ) values ('$booking_name' , '$booking_date' , '$booking_time'  , '$guest')";
	mysqli_query($db , $query);
	$_SESSION['booking_name'] = $booking_name;
	$_SESSION['success'] = "Your table is now booked ! ";
	header('location: feedback.php');
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Booking Table</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
            crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="booking.css">
</head>
<body>
<div class="overlay">

<form action="booking.php" method="post">
<?php include("errors.php") ?>
   <div class="con">

   <header class="head-form">
      <h2>Reserve Table Now </h2>

      <p>Book your table now and enjoy with friends and family</p>
   </header>

   <br>
   <div class="field-set">
     
         <span class="input-item">
           <i class="fa fa-user-circle"></i>
         </span>
         <input class="form-input" id="txt-input" type="text" placeholder="@Booking Name" name="booking_name" required>
         <br>
     
      <span class="input-item">
        <i class="fa fa-calendar" aria-hidden="true"></i>
       </span>
      <input class="form-input" type="date" placeholder="@Date" name="booking_date" required>
      <br>

      <span class="input-item">
        <i class="fa fa-calender-o" aria-hidden="true"></i>
       </span>
      <input class="form-input" type="text" placeholder="@Time" name="booking_time" required>
      <br>

      <span class="input-item">
        <i class="fa fa-users"></i>
       </span>
      <input class="form-input" type="text" placeholder="@Number of guests" name="guest" required>
      <br>

      <button class="log-in" onclick="myFunction()"  name="book_user"> Book Now </button>
      <button class="log-in" onclick="myFunctionHome()"> Back To Home </button>
   </div>
   </div>
  </div>
</form>
</div>
<script>
	function myFunction(){
		alert("Your Table has been now booked !Happy Dining !!!!!");
		location.replace("feedback.php");
	}

  
  function myFunctionHome(){
    location.replace("home.php");
  }
</script>

</body>
</html>