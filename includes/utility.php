<?php
	function display_palette($additional_class) {
		$colors = array(
			"first_row" => array(
				"coral" => "rgb(255, 102, 102)",
				"orange" => "rgb(255, 102, 51)",
				"gold" => "rgb(204, 153, 0)",
				"yellow" => "rgb(255, 255, 0)",
				"sky_blue" => "rgb(102, 153, 204)",
				"white" => "rgb(255, 255, 255)"
				//"light_pink" => "rgb(255, 153, 204)",
				//"beige" => "rgb(255, 255, 204)",
			),
			"second_row" => array(
				"dark_pink" => "rgb(255, 0, 153)",
				"red" => "rgb(204, 51, 51)",
				"burnt_orange" => "rgb(204, 102, 51)",
				"turquoise" => "rgb(51, 204, 255)",
				"blue" => "rgb(0, 0, 204)",
				"grey" => "rgb(102, 102, 102)"
				//"lime_green" => "rgb(0, 204, 51)",
			),
			"third_row" => array(
				"purple" => "rgb(102, 0, 102)",
				"burdangy" => "rgb(153, 0, 0)",
				"brown" => "rgb(102, 51, 0)",
				"dark_green" => "rgb(0, 102, 0)",
				"navy" => "rgb(0, 0, 102)",				
				"black" => "rgb(0, 0, 0)"
			)
		);
		foreach($colors as $i => $values) {
			echo "<div class='color_row'>";
			
			foreach($values as $key => $value) {
				if($additional_class == "color_selected") {
					echo "<div class='color'><a";
					if(isset($_SESSION['color'])) {
						if(in_array($value, $_SESSION['color'])) {
							echo " class='color_selected'";
						}
					}
					echo " href='javascript:void' style='background: " . $value . "'></a></div>";
				} else {
					echo "<div class='color";
					if(isset($_SESSION['color'])) {
						if(in_array($value, $_SESSION['color'])) {
							echo " $additional_class";
						}
					}
					echo "'><a href='javascript:void' style='background: " . $value . "'></a></div>";
				}
			}
			echo "</div>";
		}
	}
	
	function cust_log($log_info) {
		$fp = fopen("logs/log.txt", "a");
		fwrite($fp, $log_info);
		fwrite($fp, "\n");
		fclose($fp);
	}

?>














