<!DOCTYPE html>
<html>
<head>
<title>Buy Product</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

	<?php
		
		$product_id_1 = $_GET['id'];
		$product_id_2 = 0;
		$cnx = new mysqli('localhost', 'root', '123', 'hw7');

		if ($cnx->connect_error)
			die('Connection failed: ' . $cnx->connect_error);
			
		if ($product_id_1 < 20) {
			$product_id_2 = $product_id_1 + 20;
		}
		else {
			$product_id_2 = $product_id_1 - 20;
		}
		
		$query = 'SELECT * FROM products WHERE id = ' . $product_id_1 . ' OR id = ' . $product_id_2;
		$cursor = $cnx->query($query);
		$markup = 1.1;

		$rowOne = $cursor->fetch_assoc();
		$product_one_id = $rowOne['id'];
		$product_one_name = $rowOne['name'];
		$product_one_old_price = str_replace(['$', ','], '', $rowOne['price']);
		$product_one_price = $product_one_old_price * $markup;
		$product_one_descrip = $rowOne['description'];
		$product_one_img = $rowOne['img_url'];
	
		$rowTwo = $cursor->fetch_assoc();
		$product_two_id = $rowTwo['id'];
		$product_two_name = $rowTwo['name'];
		$product_two_old_price = str_replace(['$', ','], '', $rowTwo['price']);
		$product_two_price = $product_two_old_price * $markup;
		$product_two_descrip = $rowTwo['description'];
		$product_two_img = $rowTwo['img_url'];
		
		echo '<h1><a href="/checkout.php?id=' . $product_one_id . '">Buy ' . $product_one_name . '</a> for $' . $product_one_price . '</h1>';		
		echo '<div class="product">';
		echo '<img style="height: auto; min-width: 200px;" src="' . $product_one_img . '" >';
		
		if ($product_one_price < $product_two_price)
			echo '<h1 style="background-color: yellow;">Better Deal! Save $' . round($product_two_price - $product_one_price, 2) . '</h1>';

		echo '<p class="descrip">' . $product_one_descrip  . '</p>';
		echo '</div>';
		
		echo '<h1>OR</h1>';
	
		echo '<h1><a href="/checkout.php?id=' . $product_two_id . '">Buy ' . $product_two_name . '</a> for $' . $product_two_price . '</h1>';		
		echo '<div class="product">';
		echo '<img style="height: auto; min-width: 200px;" src="' . $product_two_img . '" >';
		if ($product_one_price > $product_two_price)
			echo '<h1 style="background-color: yellow;">Better Deal! Save $' . round($product_one_price - $product_two_price, 2) . '</h1>';

		echo '<p class="descrip">' . $product_two_descrip  . '</p>';
		echo '</div>';

	?>
</body>
</html>


