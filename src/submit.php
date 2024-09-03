<?php
	$cnx = new mysqli('localhost', 'root', '123', 'hw7');
	
	if ($cnx->connect_error)
		die('Connection error: ' . $cnx->connect_error);

	$name = $_POST['name'];
	$customer_name = $_POST['customer_name'];
	$card = $_POST['card'];
	$address = $_POST['address'];
	$price = $_POST['price'];
	
	$query = 'INSERT INTO transactions (customer_name, address, price, product_name, credit_card_number) VALUES ("' . $customer_name . '", "' . $address . '", "' . $price . '", "' . $name . '", "' . $card . '")'; 
	
	if ($cnx->query($query) === TRUE)
		echo 'Transaction Completed.';
?>
