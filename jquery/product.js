var mouse_inside = false;
		
$(document).ready(function() {
	$("#yes_colors").hover(
		function() {
			$("#color_arrow_up").show();
		},
		function() {
			if(!$("#color_arrow_up").hasClass("color_arrow_selected")) {
				$("#color_arrow_up").hide();
			}
		}
	);
	
	$("#yes_colors").on('click', function() {
		if($("#my_colors_container").is(":visible")) {
			$("#my_colors_container").hide();
		}
		$("#change_colors").show();
		$("#color_arrow_up").addClass("color_arrow_selected");
	});
	
	$("#no_colors").on('click', function() {
		if($("#my_colors_container").is(":visible")) {
			$("#my_colors_container").hide();
		}
		$("#change_colors").show();
	});
	
	$("#change_colors_close").on('click', function() {
		$("#change_colors .color a").css("border", "1px solid #A9A9AB");
		$("#change_colors .color a").css("width", "30px");
		$("#change_colors .color a").css("height", "30px");
		$("#change_colors .color a").removeClass("color_selected");
		$("#change_colors").hide();
		$("#color_arrow_up").hide();
		$("#color_arrow_up").removeClass("color_arrow_selected");
	});

	$("#view_all").on('click', function() {
		$("#change_colors .color a").css("border", "2px solid #000");
		$("#change_colors .color a").css("width", "28px");
		$("#change_colors .color a").css("height", "28px");
		$("#change_colors .color a").addClass("color_selected");
	});
	
	$("#clear").on('click', function() {
		$("#change_colors .color a").css("border", "1px solid #A9A9AB");
		$("#change_colors .color a").css("width", "30px");
		$("#change_colors .color a").css("height", "30px");
		$("#change_colors .color a").removeClass("color_selected");
	});
	
	$("#change_colors .color a").on('click', function() {
		if(!$(this).hasClass("color_selected")) {
			$(this).addClass("color_selected");
		} else {
			$(this).removeClass("color_selected");
		}
	});
	
	$(".color a").hover(
		function() {
			$(this).css("border", "2px solid #000");
			$(this).css("width", "28px");
			$(this).css("height", "28px");
		},
		function() {
			if(!$(this).hasClass("color_selected")) {
				$(this).css("border", "1px solid #A9A9AB");
				$(this).css("width", "30px");
				$(this).css("height", "30px");
			}
		}
	);

	$(".check").on('click',
		function() {
			if($(this).hasClass("selected")) {
				$(this).removeClass("selected");
			} else {
				$(this).addClass("selected");
			}
			updateClothes();
		}
	);
	
	$(".brand_check").on('click',
		function() {
			if($(this).hasClass("brand_selected")) {
				$(this).removeClass("brand_selected");
			} else {
				$(this).addClass("brand_selected");
			}
			//updateClothes();
		}
	);
	
	$("#brand_ok").on('click',
		function() {
			updateClothes();
		}
	);
					
	$("#brand_clear").on('click',
		function() {
			$(".brand_selected").removeClass("brand_selected");
		}
	);
	
	$(".store_check").on('click',
		function() {
			if($(this).hasClass("store_selected")) {
				$(this).removeClass("store_selected");
			} else {
				$(this).addClass("store_selected");
			}
			//updateClothes();
		}
	);
	
	$("#store_ok").on('click',
		function() {
			updateClothes();
		}
	);
					
	$("#store_clear").on('click',
		function() {
			$(".store_selected").removeClass("store_selected");
		}
	);

	$(".price_check").on('click',
		function() {
			if($(this).hasClass("price_selected")) {
				$(this).removeClass("price_selected");
			} else {
				$(this).addClass("price_selected");
			}
			//updateClothes();
		}
	);
	
	$("#price_ok").on('click',
		function() {
			updateClothes();
		}
	);
					
	$("#price_clear").on('click',
		function() {
			$(".price_selected").removeClass("price_selected");
		}
	);
	
	$(".refine").hover(
		function() {
			$(this).next("div").addClass("visible");
		},
		function() {
			if(!$(this).next("div").hasClass("arrow_selected")) {
				$(this).next("div").removeClass("visible");
			}
		}
	);
	$(".refine").on('click', function() {
		if($(this).siblings(".refine_filter").hasClass("visible")) {
			$(this).siblings(".arrow").removeClass("arrow_selected");
			$(this).siblings(".refine_filter").removeClass("visible");
		} else {
			$(".arrow").removeClass("visible");
			$(".arrow").removeClass("arrow_selected");
			$(".refine_filter").removeClass("visible");
			$(this).siblings(".arrow").addClass("visible");
			$(this).siblings(".arrow").addClass("arrow_selected");
			$(this).siblings(".refine_filter").addClass("visible");
		}
	});
	
	$(".refine_filter").hover(function() {
		if($(this).hasClass("visible")) {
			mouse_inside = true;
		}
	}, function() {
		if($(this).hasClass("visible")) {
			mouse_inside = false;
		}
	});
	
	/*$("body").mouseup(function() {
		//window.alert(mouse_inside);
		if(!mouse_inside) {
			$(".refine_filter").removeClass("visible");
			$(".arrow").removeClass("arrow_selected");
			$(".arrow").removeClass("visible");
		}
	});*/
	
	$(".close_button").on('click', function() {
		$(this).parents(".refine_filter").removeClass("visible");
		$(this).parents(".refine_filter").siblings(".arrow").removeClass("arrow_selected");
		$(this).parents(".refine_filter").siblings(".arrow").removeClass("visible");
	});
	
	$("#contact_button").on('click', function() {
		lockScroll();
		$("#contact_us").show();
	});
	
	$("#close_contact").on('click', function() {
		unlockScroll();
		$("#contact_us").hide();
	});
	
	$("#recommend_button").on('click', function() {
		lockScroll();
		$("#recommend").show();
	});
	
	$("#close_recommend").on('click', function() {
		unlockScroll();
		$("#recommend").hide();
	});
		
});
// courtesy of stack overflow 
// http://stackoverflow.com/questions/920236/jquery-detect-if-selector-returns-null
$.fn.exists = function () {
	return this.length !== 0;
}

$(window).scroll(function() {
	if ($(this).scrollTop() == 0) {
		$("#top_jump").hide();
	} else {
		$("#top_jump").show();
	}
});

function setColors(gender) {
	var select_colors = $(".color_selected").map(function() {
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
