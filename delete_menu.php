<?php
session_start();
$db = mysqli_connect("localhost" , "root" , "" , "project");
$sql = "SELECT * FROM menu" ;
$result = mysqli_query($db , $sql);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Menu Page</title>
	<meta name="viewport" content="width=device-width , initial-scale=1.0">
	<link rel="stylesheet" href="user.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<style type="text/css">
	#menu
	{
		font-family: Arial , Helvetica , sans-serif;
		border-collapse: collapse;
		width: 100%;
	}
	#menu td , #menu th
	{
		border: 1px solid, #ddd;
		padding: 8px;
	}
	#menu tr:nth-child(even)
	{
		background-color: #f2f2f2;
	}
	#menu tr:hover
	{
		background-color: #ddd;
	}
	#menu th
	{
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #4CAF50;
		color: white;
	}
</style>
</head>
<body>
	<div class="menu-bar">
	<div class="container">
		<nav class="navbar navbar-expand-lg">
  <a class="navbar-brand" href="#"><img src="logo.PNG"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fa fa-bars" aria-hidden="true"></i>

  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item ">
        <a class="nav-link active" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
	</div>
</div>


<table id="menu">
	<thead>
		<tr>
			<th>Food Id</th>
			<th>Food Name</th>
			<th>Price</th>
			<th>Description</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>

	<?php
		while ($row = mysqli_fetch_array($result)) { ?>
			<tr>
				<td><?php echo $row['food_id']; ?></td>
				<td><?php echo $row['food']; ?></td>
				<td><?php echo $row['price']; ?></td>
				<td><?php echo $row['description']; ?></td>
				<td type="button" class ="del_btn" name="del_btn" id="del_btn">Delete</a></td>
			</tr>	
		<?php
		}
	 ?>
	 <?php
//session_start();
	 $db = mysqli_connect("localhost" , "root" , "" , "project");
if(isset($_POST['del_btn']))
{
	$results = mysqli_query($db , "DELETE FROM menu WHERE food_id = '" .  $_POST['food_id'] . "'" );
}
else
{
	?>
	<form method="post">
		<table width="400" border="0" cellspacing="1" cellpadding="2">
			<tr>
				<td width="100">Food Id</td>
				<td><input type="text" name="food_id" id="food_id"></td>
			</tr>
			<tr>
				<td width="100"></td>
				<td><input type="submit" name="del_btn" id="del_btn" value="Delete"></td>
			</tr>
		</table>
	</form>
<?php	
}
?>
</table>
<div class="row footer">
	<div class="col-md-3 footer-widget">
		<div class="footer-text">
		<i class="fa fa-phone"></i>
				<h6>+91 123456789</h6>
		<i class="fa fa-clock-o" aria-hidden="true"></i>
				<p>Monday - Saturday<br>11:00am to 11:00pm</p>
			</div>
	</div>

	<div class="col-md-3 footer-widget">
		<i class="fa fa-map-maker"></i>
			<div class="footer-text">
				<h6>About</h6>
				<p>DBMS Mini Project : Restaurant management system</p>
				<p>PHP , MYSQL , HTML , CSS , BOOTSTRAP , JAVASCRIPT</p>
			</div>
	</div>

	<div class="col-md-3 footer-widget">
		<i class="fa fa-users" aria-hidden="true"></i>
			<div class="footer-text">
				<p>Our Team<br>Neha Adawadkar<br>Roshani Chavan<br>
				Shrutika More<br>Chaitra Patwardhan<br>
			</div>
	</div>

	<div class="col-md-3 footer-widget">
			<div class="social-icons">
				<h6>Follow us on</h6>
				<i class="fa fa-facebook"></i>
				<i class="fa fa-instagram"></i>
				<i class="fa fa-twitter"></i>
				<i class="fa fa-linkedin"></i>
			</div>
	</div>
</div>

</body>
</html>
<!--
	user.php?edit=<?php //echo $row['customer_id'];?>
	-->