<?php
	require_once("simplehtmldom_1_5/simple_html_dom.php");

	$html = new simple_html_dom();
	$html->load_file("http://shop.nordstrom.com/s/french-connection-koni-stripe-knit-sheath-dress/3351106?origin=category&contextualcategoryid=0&fashionColor=&resultback=266");
	$product = $html->find(".rightcol h1");
	foreach($product as $pro) {
		echo $pro->plaintext;
	}

	$product_details = $html->find("#productdetails");
	echo "\n" . strip_tags($product_details[0]->plaintext);
	
	$price = $html->find("#itemNumberPrice span.price");
	echo "\n" . $price[0]->plaintext;
?>