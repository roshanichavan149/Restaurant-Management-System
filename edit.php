<?php
session_start();
$customer_id = $_SESSION["customer_id"];
$username = $_POST["username"];
$password = $_POST["password"];

mysqli_connect("localhost" , "root" , "" , "project") or die("could not connect to databse");


$query = "UPDATE customer SET username = '$username', password = '$password' WHERE customer_id = '$customer_id'";

$res = mysql_query($query);

if ($res)
echo "<p>Record Updated<p>";
else
echo "Problem updating record. MySQL Error: " . mysql_error();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
</head>
<body>
<form action="update.php" method="post">
<input type="hidden" name="id" value="<?=$id;?>">
ScreenName:<br> <input type='text' name='username' id='username' maxlength='25'   style='width:247px' name="username" value="<?=$username;?>"/><br>
FullName:<br> <input type='text' name='fname' id='fname' maxlength='20' style='width:248px'     name="ud_img" value="<?=$fname;?>"/><br>
Email:<br> <input type='text' name='email' id='email' maxlength='50' style='width:250px'    name="ud_img" value="<?=$email;?>"/><br>
Password:<br> <input type='text' name='password' id='password' maxlength='25'     style='width:251px' value="<?=$password;?>"/><br>
<input type="Submit">
</form>
</body>
</html>

