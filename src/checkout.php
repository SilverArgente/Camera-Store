<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<form action="submit.php" method="POST">
	  	
	  	<?php
		$product_id = $_GET['id'];

		$cnx = new mysqli('localhost', 'root', '123', 'hw7');
		
		if ($cnx->connect_error)
			die('Conneciton failed: ' . $cnx->connect_error);

		$query = 'SELECT name, price FROM products WHERE id = ' . $product_id;
		$cursor = $cnx->query($query);
		$markup = 1.1;
		$data = $cursor->fetch_assoc();
		$price = $data['price'];
		
		$price = str_replace(['$', ','], '', $price);
		$price = $price * $markup;

		echo '<div style="padding: 20px; font-size: 20px;">';
		echo '<p><b>Checkout: Enter Information Below</b></p>';
		echo '<label>Product Name:</label><br>';
		echo '<input value="' . $data['name'] . '" type="text" name="name" readonly><br>';
		echo '<label>Price:</label><br>';
		echo '<input value="' . round($price, 2) . '" type="text" name="price" readonly><br>';
		echo '<label>Full Name:</label><br>';
	  	echo '<input type="text" name="customer_name"><br>';
	  	echo '<label>Address:</label><br>';
	  	echo '<input type="text" name="address"><br><br>';
	  	echo '<label>Credit Card Number:</label><br>';
	  	echo '<input type="text" name="card"><br><br>';
	?>
	  	<input type="submit" value="Submit">
	</form>

</body>
</html>
