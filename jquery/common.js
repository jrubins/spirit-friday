$(document).ready(function() {
	$("#facebook_connect_button").on('click', function() {
		alert("Facebook connect functionality coming soon!");
	});

	$("#facebook_login_button").on('click', function() {
		alert("Facebook login functionality coming soon!");
	});
	
	$("#twitter_connect_button").on('click', function() {
		alert("Twitter connect functionality coming soon!");
	});

	$("#twitter_login_button").on('click', function() {
		alert("Twitter login functionality coming soon!");
	});
	
	$("#internal_forgot").on('click', function() {
		alert("Contact Us on the bottom nav if you've forgotten your password. Full functionality coming soon!");
	});
	
	$("#internal_login_form").submit(function(event) {
		event.preventDefault();
		
		$("#bottom_nav").css("z-index", "10000");
		
		var login_email = $(this).find("input[name='login_email']").val(),
			login_password = $(this).find("input[name='login_password']").val();
			
		$.post(
			"login.php",
			{ email: login_email, password: login_password },
			function(data) {
				var response = jQuery.parseJSON(data);
				if(response.code == "success") {
					if(response.login == "true") {
						//alert("login success");
						window.location.replace("product.php?gender=" + response.gender);
					} else if(response.login == "false") {
						//alert("failed login");
					}
				} else if(response.code == "failure") {
					//alert(response.msg);
					//alert(response.query);
					$.post(
						"error_email.php",
						{ error: response.msg, query: response.query }
					);
				}
			}
		);
	});
	
	$("#add_link a").on('click', function() {
		alert("Functionality coming soon!");
	});
	
	$("#create_account_form").submit(function(event) {
		//alert("here");
		event.preventDefault();
		
		var create_email = $(this).find("input[name='create_email']").val(),
			create_password = $(this).find("input[name='create_password']").val(),
			confirm_password = $(this).find("input[name='confirm_password']").val();
		
		if((confirm_password == create_password) && (create_password != '')) {
			$("#bottom_nav").css("z-index", "10000");
			$.post(
				"create_account.php",
				{ email: create_email, password: create_password },
				function(data) {
					var response = jQuery.parseJSON(data);
					if(response.code == "success") {
						$("input[name='user_id']").val(response.user_id);
						$("input[name='email']").val(response.email);
						$("#sign_in").hide();
						$("#create_account_2").show();
					} else if(response.code == "failure") {
						//alert(response.msg);
					}
				}
			);
		}
	});

	$("#create_account_2 form").submit(function(event) {
		event.preventDefault();
		
		var id = $(this).find("input[name='user_id']").val(),
			create_first_name = $(this).find("input[name='first_name']").val(),
			create_last_name = $(this).find("input[name='last_name']").val(),
			create_email = $(this).find("input[name='email']").val(),
			create_month = $(this).find("select[name='month']").val(),
			create_day = $(this).find("select[name='day']").val(),
			create_year = $(this).find("select[name='year']").val(),
			create_clothing_type = $(this).find("select[name='clothing_type']").val(),
			create_updates = false;
		if($("#updates").hasClass("updates_checked")) {
			create_updates = true;
		}
		if(create_month == 'blank') {
			create_month = '';
		}
		if(create_day == 'blank') {
			create_day = '';
		}
		if(create_year == 'blank') {
			create_year = '';
		}
		//alert(create_month);
		//alert(create_day);
		//alert(create_year);
		var colors = {};
		$(this).find(".color_combination").each(function() {
			var comb_name = $(this).find("input[name='color_comb_name']").val();
			colors[comb_name] = jQuery.makeArray($(this).find(".comb_color a.comb_color_selected").map(function() {
				return $(this).css("background-color");
			}));
		});
		//alert(JSON.stringify(colors));
			
		$.post(
			"update_account.php",
			{ user_id: id, first_name: create_first_name, last_name: create_last_name, email: create_email, month: create_month, day: create_day, year: create_year, clothing_type: create_clothing_type, updates: create_updates, combinations: JSON.stringify(colors) },
			function(data) {
				var response = jQuery.parseJSON(data);
				if(response.code == "success") {
					window.location.replace("product.php?gender=" + response.gender);
				} else if(response.code == "failure") {
					//alert(response.msg);
					//alert(response.query);
					$.post(
						"error_email.php",
						{ error: response.msg, query: response.query }
					);
				}
			}					
		);
	});

	$("#updates a").on('click', function() {
		//alert("Functionality coming soon!");
		var updates = $("#updates");
		if(updates.hasClass("updates_checked")) {
			updates.removeClass("updates_checked");
		} else {
			updates.addClass("updates_checked");
		}
	});
	
	$("#contact_form").submit(function(event) {
		event.preventDefault();
		
		$(this).find("input[name='message_submit']").val("sending...");
		
		var name = $(this).find("input[name='name']").val(),
			number = $(this).find("input[name='number']").val(),
			email = $(this).find("input[name='email']").val(),
			message = $(this).find("textarea[name='message']").val();
		
		//alert(name);
		//alert(message);
	
		$.post(
			"send_contact_email.php",
			{ name: name, number: number, email: email, message: message },
			function(data) {
				var response = jQuery.parseJSON(data);
				if(response.code == "success") {
					//alert("Successfully sent email!");
					$("#contact_us").hide();
				} else if(response.code == "failure") {
					//alert("Something went wrong :(");
				}
			}
		);
	});
	
	$("#recommend_form").submit(function(event) {
		event.preventDefault();
		
		$(this).find("input[name='recommend_submit']").val("sending...");
		
		var message = $(this).find("textarea[name='recommend_text']").val();
		
		//alert(message);
		$.post(
			"send_recommend_email.php",
			{ message: message },
			function(data) {
				var response = jQuery.parseJSON(data);
				if(response.code == "success") {
					//alert("Successfully sent email!");
					$("#recommend").hide();
				} else if(response.code == "failure") {
					//alert("Something went wrong :(");
				}
			}
		);
	});
	
	$("#create_account_form input[name='confirm_password']").keyup(function() {
		var create_password = $("#create_account_form input[name='create_password']").val();
		var confirm_password = $(this).val();
		/*alert(create_password);
		alert(confirm_password);*/
		if(confirm_password != create_password) {
			$("#pass_no_match").show();
		} else {
			$("#pass_no_match").hide();
		}
	});
	
	$(document).on('click', '.comb_view_all', function() {
		var color_palette = $(this).parents(".color_combination_options").siblings(".color_palette");
		color_palette.css("width", "210px");
		color_palette.find(".comb_color a").css("border", "2px solid #000");
		color_palette.find(".comb_color a").css("width", "18px");
		color_palette.find(".comb_color a").css("height", "18px");
		color_palette.find(".comb_color a").addClass("comb_color_selected");
	});
	
	$(document).on('click', '.comb_clear', function() {
		var color_palette = $(this).parents(".color_combination_options").siblings(".color_palette");
		color_palette.css("width", "200px");
		color_palette.find(".comb_color a").css("border", "1px solid #a9a9ab");
		color_palette.find(".comb_color a").css("width", "20px");
		color_palette.find(".comb_color a").css("height", "20px");
		color_palette.find(".comb_color a").removeClass("comb_color_selected");
	});
	
	$(document).on('click', '.color_palette .comb_color a', function() {
		if(!$(this).hasClass("comb_color_selected")) {
			$(this).addClass("comb_color_selected");
		} else {
			$(this).removeClass("comb_color_selected");
		}
	});
	
	$(document).on('mouseover', '.color_palette .comb_color a', function() {
			$(this).css("border", "2px solid #000");
			$(this).css("width", "18px");
			$(this).css("height", "18px");
		}
	);
	
	$(document).on('mouseout', '.color_palette .comb_color a', function() {
			if(!$(this).hasClass("comb_color_selected")) {
				$(this).css("border", "1px solid #A9A9AB");
				$(this).css("width", "20px");
				$(this).css("height", "20px");
			}
		}
	);
	
});