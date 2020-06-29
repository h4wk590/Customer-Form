<?php

/**Aidan Brown
 *ITAS 186 Assignment 02 
 *
 *
 **/


//require the database pdo as well as header and footer scripts.

require_once("header.php");
require_once("footer.php");
require_once ('Database.php');
$pdo = Database::connect();

//Posting the delete function to delete from the customer_list.php

if (isset($_POST['delete'])){
	 $id =['customer_id'];

	$query = 'DELETE FROM `customer` WHERE `customer_id` = :id';
	$sql4=$pdo->prepare($query);
	$sql4->bindparam('customer_id', $id);
	$sql4->execute();

//message to tells the user if the customer has been deleted.

	echo "This customer has been deleted: " . $id;

}
?>