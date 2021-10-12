<?php
session_start();
$product_ids = array();
//session_destroy();

//check if Add to cart button has been submitted
if(filter_input(INPUT_POST, 'add_to_cart')) {
	if(isset($_SESSION['shopping_cart'])){
		//keep track of the products in the shopping cart
		$count = count($_SESSION['shopping_cart']);

		//create sequential array for matching array keys to product ids
		$product_ids = array_column($_SESSION['shopping_cart'], 'food_id');

		//pre_r($product_ids);

		if(!in_array(filter_input(INPUT_GET, 'food_id') , $product_ids)){
			$_SESSION['shopping_cart'][$count] = array
		(
			'food_id' => filter_input(INPUT_GET, 'food_id'),
			'food' => filter_input(INPUT_POST,'food'),
			'description' => filter_input(INPUT_POST, 'description'),
			'price' => filter_input(INPUT_POST,'price'),
			'quantity' => filter_input(INPUT_POST,'quantity')
		);
		}
		else { //product already exists , increase quantity
			//match array key to id of the productbeing added to the cart
			for($i =0 ; $i<count($product_ids); $i++){
				if($product_ids[$i] == filter_input(INPUT_GET , 'food_id')){
					//add item quantity to the exisitng product in the array
					$_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
				}
			}
		}

	}
	else { //if shopping cart doent exist, create first product with array key 0
		//create array using submitted form data , start from key 0 and fill it with values
		$_SESSION['shopping_cart'][0] = array
		(
			'food_id' => filter_input(INPUT_GET, 'food_id'),
			'food' => filter_input(INPUT_POST,'food'),
			'description' => filter_input(INPUT_POST, 'description'),
			'price' => filter_input(INPUT_POST,'price'),
			'quantity' => filter_input(INPUT_POST,'quantity')
		);
	}
}


if(filter_input(INPUT_GET, 'action') == 'delete'){
	//loop through all the products of the shopping cart until it matches the GET id variable
	foreach ($_SESSION['shopping_cart'] as $key => $product) {
		if($product['food_id'] == filter_input(INPUT_GET, 'food_id')){
			//remove product from the shopping cart when it matches with the GET id 
			unset($_SESSION['shopping_cart'][$key]);
		}
	}
	//reset session array keys so that they match with $product_ids numeric array
	$_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}

//pre_r($_SESSION);

function pre_r($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Shopping Cart</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<link rel="stylesheet" href="cart.css" />
	<meta name="viewport" content="width=device-width , initial-scale=1.0">
	<link rel="stylesheet" href="main.css"> 

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

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
        <a class="nav-link active" href="main.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
	</div>
</div>
	<div class="container">
	<?php

$connect = mysqli_connect('localhost' , 'root' , '' , 'project');

$query = 'SELECT * FROM menu ORDER BY food_id ASC';

$result = mysqli_query($connect , $query);

if($result):
	if(mysqli_num_rows($result) > 0):
		while ($product = mysqli_fetch_assoc($result)) :
			//print_r($product);
			?>
			 <div class="col-sm-4 col-md-3">
			 	<form method="post" action="cart.php?action=add&food_id=<?php echo $product['food_id']; ?> ">
			 		<div class="products" >
			 			<img src="<?php echo $product['image']; ?>" class="cards img-responsive" style="height: 150px; width: 150px;"/>
			 			<h4 class="text-info">
			 				<?php echo $product['food']; ?>
			 			</h4>
			 			<h4 class="text">
			 				<?php echo $product['description']; ?>
			 			</h4>
			 			<h4>Rs <?php echo $product['price']; ?></h4>
			 			<input type="text" name="quantity" class="form-control" value="1" />
			 			<input type="hidden" name="food" value="<?php echo $product['food']; ?>" />
			 			<input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
			 			<input type="submit" name="add_to_cart" class="btn-info" style="margin-top: 5px;" 
			 			value="Add To Cart" />
			 		</div>
			 	</form>
			 </div>
			<?
		endwhile;
	endif;
endif;
?>

<div style="clear: both"></div>
<br />
<div class="table-responsive">
	<table class="table">
		<tr><th colspan="5"><h3>Order Details</h3></th></tr>
		<tr>
			<th width="40%">Product Name </th>
			<th width="10%">Quantity</th>
			<th width="20%">Price</th>
			<th width="15%">Total</th>
			<th width="5%">Action</th>
		</tr>
		<?php
		if(!empty($_SESSION['shopping_cart'])):

			$total = 0;

			foreach ($_SESSION['shopping_cart'] as $key => $product):
		?>
		<tr>
			<td><?php echo $product['food']; ?></td>
			<td><?php echo $product['quantity']; ?></td>
			<td>Rs<?php echo $product['price']; ?></td>
			<td>Rs<?php echo number_format($product['quantity'] * $product['price'] , 2); ?></td>
			<td><a href="cart.php?action=delete&food_id=<?php echo $product['food_id']; ?>">
				<div class="btn-danger">Remove</div>
			</a>
			</td>
		</tr>
		<?php 
		$total = $total + ($product['quantity'] * $product['price']);
	endforeach;
	?>
	<tr>
		<td colspan="3" align="right">Total</td>
		<td align="right">Rs <?php echo number_format($total , 2); ?></td>
		<td></td>
	</tr>
	<tr>
		<!-- Show checkout button only if the shopping cart is not empty -->
		<td colspan="5">
			<?php
			if(isset($_SESSION['shopping_cart'])):
				if(count($_SESSION['shopping_cart']) > 0):
		    ?>
		    <button type="button" class="btn-info" style="width: 100%; height: 50px;" 
		    onclick="myFunction()">Order Now</button>
		<?php endif; endif; ?>
	</td>
	</tr>
	<?php
endif;
?>
</table>
</div>
</div>
<script>
	function myFunction(){
		alert("Your Order has been placed !Thank you for ordering from Foodies Table");
		location.replace("feedback.php");
	}
</script>
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
