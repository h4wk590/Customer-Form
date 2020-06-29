<?php

/**Aidan Brown
 *ITAS 186 Assignment 02 
 *
 *Edit.php allows user to edit a specific entry within the table.
 **/


//connecting the to the database and linking to html files.

require_once("header.php");
require_once("footer.php");
require_once ('Database.php');
$pdo = Database::connect();


?>

<!-- Form that posts to itself to update page info after the edit. -->

<form action="" method="POST">
	<label>Edit: </label>

	<input type="number" name="id" step="0" >
	<input type="submit" name="submit">

</form>


<?php

//preparing the query, to select the customer id and print out the rows.

if (isset($_POST['customer_id'])){
	$id=$_POST['customer_id'];
	$query="SELECT * FROM `customer` WHERE `customer_id` = :customerid";
	$sql2=$pdo->prepare($query);
	$sql2->bindParam(':customerid', $id);
	$sql2->execute();
	$results=$sql2->fetchAll();
	
foreach($results as $row){
	echo '<form action="" method="POST">
			<input type="text" name="title" value="'. $row['title'] . '">
			<input type="text" name="first name" value="'. $row['first_name'] . '">
			<input type="text" name="last name" value="'. $row['last_name'] . '">
			<input type="text" name="address" value="'. $row['address'] . '">
			<input type="text" name="city" value="'. $row['city'] . '">
			<input type="text" name="postal code" value="'. $row['postal_code'] . '">
			<input type="text" name="phone" value="'. $row['phone'] . '">
			<input type="submit" name="edit"></form>';
	}

}


if (isset($_POST['edit'])){
	$safetitle = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
	$safefname = filter_var($_POST['first_name'],FILTER_SANITIZE_STRING);
	$safelname = filter_var($_POST['last_name'],FILTER_SANITIZE_STRING);
	$safeaddress = filter_var($_POST['address'],FILTER_SANITIZE_STRING);
	$safecity = filter_var($_POST['city'],FILTER_SANITIZE_STRING);
	$safepcode = filter_var($_POST['postal_code'],FILTER_SANITIZE_STRING);
	$safephone = filter_var($_POST['phone'],FILTER_SANITIZE_STRING);
	$id = $_SESSION['id'];

	$query = "UPDATE `customer` SET `title`=:title, `first_name`=:fname, `last_name`=:lname, `address`=:address, `city`=:city, `postal_code`=:postalcode, `phone`=:phone WHERE `id`=$id";

	$sql3=$pdo->prepare($query);
	
	$sql->bindParam(':title', $safetitle);
	$sql->bindParam(':first_name', $safefname);
	$sql->bindParam(':last_name', $safelname);
	$sql->bindparam(':address', $safeaddress);
	$sql->bindparam(':city', $safecity);
	$sql->bindparam(':postal_code', $safepcode);
	$sql->bindparam(':phone', $safephone);

	$sql3->execute();
}

?>