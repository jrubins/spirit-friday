$(document).ready(function() {
	$("#contact_button").on('click', function() {
		$("#contact_us").show();
	});
	
	$("#close_contact").on('click', function() {
		$("#contact_us").hide();
	});
	
	$("#recommend_button").on('click', function() {
		$("#recommend").show();
	});
	
	$("#close_recommend").on('click', function() {
		$("#recommend").hide();
	});
	
	
	$("#shop_women_text a").click(function() {
		setColors("female");					
	});
	
	$("#shop_men_text a").click(function() {
		setColors("male");					
	});
	
	$("#view_all").on('click', function() {
		$("#two").css("background", "#000");
		$(".color a").css("border", "2px solid #000");
		$(".color a").css("width", "43px");
		$(".color a").css("height", "43px");
		$(".color a").addClass("selected");
	});
	
	function setColors(gender) {
		var select_colors = $(".selected").map(function() {
			return $(this).css("background-color");
		});
		/*$.each(select_colors, function(index, value) {
			alert(value);
		});*/
		//alert(select_colors[0]);
		//if(select_colors.length) {
		$.post("set_colors.php", { 'colors[]': jQuery.makeArray(select_colors) }, function() {
			//alert("<?php if(isset($_SESSION['color'])) { echo $_SESSION['color']; } ?>");
			window.location.replace("product.php?gender=" + gender);
		});
		/*} else {
			window.location.replace("product.php?gender=male");
		}*/
	}
	
	
	var configW = {
		over: fadeWColors,
		timeout: 10,
		out: fadeWColorsIn,
	};
	var configM = {
		over: fadeMColors,
		timeout: 10,
		out: fadeMColorsIn
	};

	$("#shop_women_text h1 a").hoverIntent(configW);
	function fadeWColors() {
		$("#shop_women_text").css("margin-right", "52px");
		$("#shop_women_text #shop_women_shop").text("shop");
		$("#shop_women_arrow h1").css("color", "#A9A9AB");
		if($(".selected").exists()) {
			$(".color a:not(.selected)").fadeTo(300, 0.3);
		}
	}
	function fadeWColorsIn() {
		$("#shop_women_text").css("margin-right", "150px");
		$("#shop_women_text #shop_women_shop").empty();
		$("#shop_women_arrow h1").css("color", "#DFDEE3");
		if($(".selected").exists()) {
			$(".color a:not(.selected)").fadeTo(300, 1.0);
		}
	}
	$("#shop_men_text h1 a").hoverIntent(configM);
	function fadeMColors() {
		$("#shop_men_text").css("margin-right", "52px");
		$("#shop_men_text #shop_men_shop").text("shop");
		$("#shop_men_arrow h1").css("color", "#A9A9AB");
		if($(".selected").exists()) {
			$(".color a:not(.selected)").fadeTo(300, 0.3);
		}
	}
	function fadeMColorsIn() {
		$("#shop_men_text").css("margin-right", "150px");
		$("#shop_men_text #shop_men_shop").empty();
		$("#shop_men_arrow h1").css("color", "#DFDEE3");
		if($(".selected").exists()) {
			$(".color a:not(.selected)").fadeTo(300, 1.0);
		}
	}
	$(".color a").on('click', function() {
		var new_background = $(this).css("background-color");
		$("#two").css("background", new_background);
		if(!$(this).hasClass("selected")) {
			$(this).addClass("selected");
		} else {
			$(this).removeClass("selected");
		}
	});
	$(".color a").hover(
		function() {
			$(this).css("border", "2px solid #000");
			$(this).css("width", "43px");
			$(this).css("height", "43px");
		},
		function() {
			if(!$(this).hasClass("selected")) {
				$(this).css("border", "1px solid #A9A9AB");
				$(this).css("width", "45px");
				$(this).css("height", "45px");
			}
	});
	
	$("#clear").on('click', function() {
		$("#two").css("background", "#a9a9ab");
		$(".selected").css("border", "1px solid #A9A9AB");
		$(".selected").css("width", "45px");
		$(".selected").css("height", "45px");
		$(".selected").removeClass("selected");
	});
});
// courtesy of stack overflow 
// http://stackoverflow.com/questions/920236/jquery-detect-if-selector-returns-null
$.fn.exists = function () {
	return this.length !== 0;
}