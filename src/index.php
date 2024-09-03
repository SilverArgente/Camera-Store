<!DOCTYPE html>
<html>
<head>
	<title>Website</title>
	<link rel="stylesheet" href="style.css" >	
</head>
<body>
	<h1>The Camera Store</h1>
	
	<div class="products"> 
	<?php 
		ini_set('display_errors', 1);	
		$cnx = new mysqli('localhost', 'root', '123', 'hw7');

    		if ($cnx->connect_error)
        		die('Connection failed: ' . $cnx->connect_error);
		
		$query = 'SELECT * FROM products';
		$cursor = $cnx->query($query);

		$markup = 1.1;

		while ($row = $cursor->fetch_assoc()) {
			echo '<div class="product">';
			
			echo '<img style="height: auto; min-width: 200px;" src="' . $row['img_url'] . '" >';
			echo '<p class="name"><a href="/product.php?id=' . $row['id']  . '">' . $row['name'] . '</a></p>';
			$price = str_replace(['$', ','], '', $row['price']);
			$new_price =  $price * $markup;
			echo '<p class="price">$' . round($new_price, 2) . '</p>';
			echo '<p class="descrip">' . $row['description']  . '</p>';
			echo '</div>';
		}

	?>

</body>
</html>
