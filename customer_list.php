<?php

/**Aidan Brown
 *ITAS 186 Assignment 02 
 *
 *
 **/

require_once("header.php");
require_once("footer.php");
require_once ('Database.php');
$pdo = Database::connect();

//creating a post method to select from the `customer` database.

if (isset($_POST['customer_id'])){
	$safefname = filter_var($_POST['customer_id'],FILTER_SANITIZE_STRING);
	}
	$query = 'SELECT * FROM `customer`';
	$sql = $pdo->prepare($query);
	$id= $_POST['customer_id'];
	$sql->bindParam(':id', $safeid);
	$sql->execute();


//printing out the database rows.

foreach($sql as $row)
{
  echo $row['customer_id'] . '<br>';
  echo $row['title'] . '<br>';
  echo $row['first_name'] . '<br>';
  echo $row['last_name'] . '<br>';
  echo $row['address'] . '<br>';
  echo $row['city'] . '<br>';
  echo $row['postal_code'] . '<br>';
  echo $row['phone'] . '<br>';
 }

?>