<?php

/**Aidan Brown
 *ITAS 186 Assignment 02 
 *
 *Customer add.php posts the information from the form to the database to add a 
 *new customer to the list.
 *
 *
 **/
require_once("header.php");
require_once("footer.php");
require_once ('Database.php');
$pdo = Database::connect();

//posting and filtering the data items.

if (isset($_POST['submit'])){
	$safetitle = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
	$safefname = filter_var($_POST['first_name'],FILTER_SANITIZE_STRING);
	$safelname = filter_var($_POST['last_name'],FILTER_SANITIZE_STRING);
	$safeaddress = filter_var($_POST['address'],FILTER_SANITIZE_STRING);
	$safecity = filter_var($_POST['city'],FILTER_SANITIZE_STRING);
	$safepcode = filter_var($_POST['postal_code'],FILTER_SANITIZE_STRING);
	$safephone = filter_var($_POST['phone'],FILTER_SANITIZE_STRING);

//Query inserts the filtered variables into `customer` database.

	$query = "INSERT INTO `customer` (`title`, `first_name`, `last_name`, `address`, `city`, `postal_code`, `phone`) 
	VALUES (:title, :first_name, :last_name, :address, :city, :postal_code, :phone";
//Binding query statement to local variables.

	$sql = $pdo->prepare($query);

	$sql->bindParam(':title', $safetitle);
	$sql->bindParam(':first_name', $safefname);
	$sql->bindParam(':last_name', $safelname);
	$sql->bindparam(':address', $safeaddress);
	$sql->bindparam(':city', $safecity);
	$sql->bindparam(':postal_code', $safepcode);
	$sql->bindparam(':phone', $safephone);

	$sql->execute();

}

?>

<!-- Simple form that displays all database items -->

<form action="customer_add.php" method=POST>
	<label>title</label><br>
	<input type="text" name="title">

	<label>First Name</label><br>
	<input type="text" name="first_name">

	<label>Last Name</label><br>
	<input type="text" name="last_name">

	<label>Address</label><br>
	<input type="text" name="address">

	<label>City</label><br>
	<input type="text" name="city">

	<label>Postal Code</label><br>
	<input type="text" name="postal_code">

	<label>Phone</label><br>
	<input type="text" name="phone">

	<input type="submit" name="submit" value="add">
</form>


