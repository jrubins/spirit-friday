<?php
	require_once("constants.php");

	function contact_form() {
		echo '<div id="contact_us">
			<div id="top_contact">
				<img id="contact_logo" src="images/logo_gray.jpg" alt="Contact Us Logo" />
				<h1>Contact Us</h1>
				<div id="contact_close">
					<p><a href="javascript:void" id="close_contact">X</a></p>
				</div>
			</div>
			<div id="bottom_contact">
				<p>Message us if you would like to be a campus ambassador (<a href="javascript:void">click here to learn more</a>) or have other comments. All feedback is appreciated!</p>
				<form id="contact_form" action="" method="POST">
					<p>*Name</p>
					<input type="text" name="name" />
					<p>Phone Number</p>
					<input type="text" name="number" />
					<p>*Email</p>
					<input type="text" name="email" />
					<p>*Message</p>
					<textarea name="message"></textarea>
					<input type="submit" name="message_submit" value="submit" />
				</form>
			</div>
		</div>';
	}
	
	function recommend_form() {
		echo '<div id="recommend">
				<div id="top_recommend">
					<img id="recommend_logo" src="images/logo_gray.jpg" alt="Recommend Logo" />
					<h1>Recommend Items</h1>
					<div id="recommend_close">
						<p><a href="javascript:void" id="close_recommend">X</a></p>
					</div>
				</div>
				<div id="bottom_recommend">
					<p>Is your favorite brand or store missing from our list? Tell us what you would like to see!</p>
					<form id="recommend_form">
						<textarea name="recommend_text" placeholder="Start typing to leave feedback or suggest items. Thanks!"></textarea>
						<div id="links">
							<div id="add_link">
								<p><a href="javascript:void">+</a></p>
							</div>
							<p>links are always helpful to show your favorite brand, store or color</p>
						</div>
						<input type="submit" name="recommend_submit" value="submit" />
					</form>
				</div>
			</div>';
	}
	
	function beta_form() {
		echo '<div id="beta_blocker"></div><div id="beta">
				<div id="top_beta">
					<img id="beta_logo" src="images/logo_white.jpg" alt="Beta Logo" />
					<h1>Welcome!</h1>
				</div>
				<div id="bottom_beta">
					<div id="left_beta">
						<p>already have an account?</p>
						<p class="bold">login here</p>
						<form id="beta_login" method="post" action="beta_login.php">
							<p class="smaller">Email</p>
							<input type="text" name="email" />
							<p class="smaller">Password</p>
							<input type="password" name="password" />
							<p class="failure">Your password or email was incorect.</p>
							<div id="bottom_login">
								<input type="submit" name="login" value="Login" />
								<a href="javascript:void" id="beta_forgot">Forgot your password?</a>
							</div>
						</form>
					</div>
					<div id="right_beta">
						<p>while Spirit Friday is in its Beta Stage, we will be sending invitations to test our site. Please sign up below!</p>
						<div id="sign_up_1">
							<div id="email_address">
								<div class="number"><p>1</p></div>
								<p id="enter_email">enter email address</p>
							</div>
							<form id="beta_sign_up" method="post" action="/">
								<div id="email">
									<input type="text" name="email" />
									<input type="submit" name="beta_submit" value="Submit" />
								</div>
							</form>
							<div id="success">
								<p>Your email was successfully submitted!</p>
							</div>
							<div id="duplicate">
								<p>You\'ve already requested an invite!</p>
								<p>We\'ll let you know when your account is ready!</p>
							</div>
						</div>
						<div id="sign_up_2">
							<div class="number"><p>2</p></div>
							<p>look for an invitation email from us!</p>
						</div>
					</div>
				</div>
			</div>';
	}
	
	function sign_in_form() {
		echo '<div id="sign_in">
					<div id="top_sign_in">
						<img src="images/logo_white.jpg" alt="Sign In Logo" />
						<h1>Sign In</h1>
						<div id="sign_in_close">
							<p><a href="javascript:void" id="close_sign_in">X</a></p>
						</div>
					</div>
					<div id="account_creation">
						<div id="log_in">
							<h3>login to my account</h3>
							<div id="external_login">
								<p id="facebook_login"><a href="javascript:void" id="facebook_login_button"><img src="images/facebook_login.jpg" /></a></p>
								<p id="twitter_login"><a href="javascript:void" id="twitter_login_button"><img src="images/twitter_login.jpg" /></a></p>
							</div>
							<div id="separator">
								<div class="dashed_line"></div>
								<p>or</p>
								<div class="dashed_line"></div>
							</div>
							<div id="internal_login">
								<form id="internal_login_form" method="post" action="/">
									<p class="smaller">Email</p>
									<input type="text" name="login_email" />
									<p class="smaller">Password</p>
									<input type="password" name="login_password" />
									<input type="submit" name="login_submit" value="Login">
									<a id="internal_forgot" href="javascript:void">Forgot your password?</a>
								</form>
							</div>
						</div>
						<div id="create_account">
							<div id="connect_account">
								<h3>create an account</h3>
								<div id="external_connect">
									<p><a href="javascript:void" id="facebook_connect_button"><img src="images/facebook_connect.jpg" /></a></p>
									<p><a href="javascript:void" id="twitter_connect_button"><img src="images/twitter_connect.jpg" /></a></p>
								</div>
								<div id="benefits">
									<p class="bold">benefits of having a Spirit Friday account:</p>
									<ul>
										<li>saved dressing room of items viewed</li>
										<li>saved color selections to skip home page</li>
										<li>easily share favorite items with friends</li>
									</ul>
								</div>
							</div>
							<div id="email_account">
								<h4>or use your email</h4>
								<form id="create_account_form" method="post" action="/">
									<p class="input_label">Email<span class="red_asterisk">*</span></p>
									<input type="text" name="create_email" />
									<p id="never_share">We will never share this with anyone</p>
									<p class="input_label">Password<span class="red_asterisk">*</span></p>
									<input type="password" name="create_password" />
									<p class="input_label">Confirm Password<span class="red_asterisk">*</span></p>
									<div id="create_account_password">
										<input type="password" name="confirm_password" />
										<p id="pass_no_match">Passwords don\'t match</p>
									</div>
									<div id="find_me">
										<input type="checkbox" name="create_checkbox" checked />
										<p>Let my friends find me on Spirit Friday via Facebook, Twitter, or email</p>
									</div>
									<input type="submit" name="create_submit" value="create account" />
									<p id="agree_terms">By clicking <span class="bold">create account</span> you are indicating that you have read and agreed to the <span class="bold">Terms of Service</span> and <span class="bold">Privacy Policy</span></p>
								</form>
							</div>
						</div>
					</div> <!-- end account_creation -->
				</div> <!-- end sign_in -->';
	}
	
	function create_account_form() {
		echo '<div id="create_account_2">
					<div id="top_create_account_2">
						<img src="images/logo_white.jpg" alt="Sign In Logo" />
						<h1>Create Account</h1>
						<div id="create_account_2_close">
							<p><a href="javascript:void" id="close_create_account_2">X</a></p>
						</div>
					</div>
					<form method="post" action="/">
						<div id="middle_create_account_2">
							<table>
								<tr>
									<td><p>first name*</p></td>
									<td><input type="text" name="first_name" /></td>
								</tr>
								<tr>
									<td><p>last name</p></td>
									<td><input type="text" name="last_name" /></td>
								</tr>
								<tr>
									<td><p>email*</p></td>
									<td><input type="text" name="email" /></td>
								</tr>
								<tr>
									<td><p>birthday</p></td>
									<td>
										<select name="month">
											<option value="blank"></option>';
											
												for($i = 1; $i < 13; $i++) {
													echo "<option value='$i'>$i</option>";
												}
											
											echo '</select>
										<select name="day">
											<option value="blank"></option>';
												for($i = 1; $i < 32; $i++) {
													echo "<option value='$i'>$i</option>";
												}
											
										echo '</select>
										<select name="year">
											<option value="blank"></option>';
												for($i = 2008; $i > 1950; $i--) {
													echo "<option value='$i'>$i</option>";
												}
										echo '</select>
									</td>
								</tr>
								<tr>
									<td></td>
									<td><p class="smaller">This will not be shown to other users</p></td>
								</tr>
							</table>
							<p class="italic">these next questions will help us make your visit specific to your shopping preferences!</p>
							<p>what color combination(s) are you shopping for?</p>';
							echo '<div id="color_combinations">';
							color_combination();
							echo '</div><!-- end color combinations -->
							<div id="add_combination">
								<a href="javascript:void" id="add_comb"><div id="plus"><p>+</p></div>
								<p>add combination</p></a>
							</div>
							<div id="clothing_type">
								<p>what clothing type do you shop for?</p>
								<select name="clothing_type">
									<option value="choose_one">choose one</option>
									<option value="women">women</option>
									<option value="men">men</option>
									<option value="both">both</option>
								</select>
							</div>
							<div id="updates">
								<a href="javascript:void" class="create_check"><div class="create_checkbox"></div>
								<p class="smaller">I would like to receive email updates when deals become available or new items in my preferred colors are posted</p>
								</a>
							</div>
						</div>
						<div id="bottom_create_account_2">
							<a id="create_account_2_cancel" href="javascript:void">cancel</a>
							<input type="hidden" name="user_id" />
							<input type="submit" name="submit" value="save" id="create_account_2_save" />
						</div>
					</form>
				</div>';
	}
	
	function my_colors() {
		echo '<div id="my_colors_container">';
		echo '<div id="my_colors">';
		$user_combination_query = "SELECT * FROM combinations WHERE user_id=" . $_SESSION['user_id'];
		if(!($user_combination_result = mysql_query($user_combination_query))) {
			die(mysql_error());
		}
		$colors = array(
			"red" => "rgb(204, 51, 51)",
			"yellow" => "rgb(255, 255, 0)",
			"light_pink" => "rgb(255, 153, 204)",
			"sky_blue" => "rgb(102, 153, 204)",
			"turquoise" => "rgb(51, 204, 255)",
			"beige" => "rgb(255, 255, 204)",
			"white" => "rgb(255, 255, 255)",
			"burdangy" => "rgb(153, 0, 0)",
			"coral" => "rgb(255, 102, 102)",
			"dark_pink" => "rgb(255, 0, 153)",
			"blue" => "rgb(0, 0, 204)",
			"lime_green" => "rgb(0, 204, 51)",
			"gold" => "rgb(204, 153, 0)",
			"grey" => "rgb(102, 102, 102)",
			"burnt_orange" => "rgb(204, 102, 51)",
			"orange" => "rgb(255, 102, 51)",
			"purple" => "rgb(102, 0, 102)",
			"navy" => "rgb(0, 0, 102)",
			"dark_green" => "rgb(0, 102, 0)",
			"brown" => "rgb(102, 51, 0)",
			"black" => "rgb(0, 0, 0)");
		
		$num_combs = mysql_num_rows($user_combination_result);
		if(($num_combs == 0) || ($num_combs == 1)) {
			$no_combs = true;
		}
		if($num_combs > 0) {
			while($user_combination = mysql_fetch_array($user_combination_result)) {
				echo "<div class='my_combination' comb_id='" . $user_combination['id'] . "'>";
				echo '<div class="upper_check">';
				echo '<a href="javascript:void" class="user_check';
				$selected = true;
				foreach(array_keys($colors) as $color) {
					if(in_array($colors[$color], $_SESSION['color'])) {
						if($user_combination[$color] == 0) {
							$selected = false;
						}
					}
				}
				if($selected) {
					echo " user_selected";
				}
				echo '"><div class="user_checkbox"></div>';
				echo "<p class='my_comb_name'>" . $user_combination['name'] . "</p></a></div>";
				echo "<div class='my_combination_colors'>";
				foreach(array_keys($colors) as $color) {
					if($user_combination[$color] == 1) {
						echo "<div class='my_color'>";
						echo "<a href='javascript:void' style='background:" . $colors[$color] . "'></a>";
						echo "</div>";
					}
				}
				echo "</div>";
				echo '<div class="my_combination_options"><ul><li><a class="my_edit" href="javascript:void">edit</a></li><li class="last"><a class="my_delete" href="javascript:void">delete</a></li></ul></div>';
				echo "</div>";
				
			}
		}
		echo '<div id="close_colors">
				<a href="javascript:void" id="close_my_colors">[close]</a>
			</div>
			<div id="add_form">
				<a href="javascript:void" id="add_comb_button">[add]</a>
			</div>';
		echo '</div>';
		// start of add box
		echo '<div id="add_my_color_comb"';
		if($no_combs) {
			echo ' class="no_combs"';
		}
		echo '>';
		echo '<form action="/" method="post" id="add_color_comb_form">
				<p>name of combination</p>
				<input type="text" name="new_comb_name" />';
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
		echo '<div id="new_comb_color_palette">';
		foreach($colors as $i => $values) {
			echo '<div class="color_row">';
			foreach($values as $key => $value) {
				echo '<div class="new_comb_color';
				echo '"><a href="javascript:void" style="background: ' . $value . '"></a></div>';
			}
			echo '</div>';
		}
	echo '</div>
			<div id="new_comb_options">
				<ul>
					<li><a id="new_comb_view_all" href="javascript:void">view all</a></li>
					<li class="last"><a id="new_comb_clear" href="javascript:void">clear</a></li>
				</ul>
			</div>
			<input type="hidden" name="operation" />
			<input type="hidden" name="comb_id" />
			<input type="hidden" name="user_id" value="' . $_SESSION['user_id'] . '" />
			<input type="submit" name="submit" value="add" />
		</form>';		
		echo '</div>';
		echo '</div>'; // end of my colors container
	}
	
	function color_combination() {
		echo '<div class="color_combination"><ol><table><tr><td><li><p>select color(s)</p></li></td><td><div class="color_palette">';
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
										echo '<div class="color_row">';
										
										foreach($values as $key => $value) {
											echo '<div class="comb_color';
											echo '"><a href="javascript:void" style="background: ' . $value . '"></a></div>';
										}
										echo '</div>';
									}
								echo '</div><div class="color_combination_options"><ul><li><a class="comb_view_all" href="javascript:void">view all</a></li><li class="last"><a class="comb_clear" href="javascript:void">clear</a></li></ul></div></td></tr><tr><td><li><p>name combination</p></li></td><td><input type="text" name="color_comb_name" /><p class="smaller">e.g. name of college, professional, highschool or club team</p></td></tr></table></ol></div>';
	}
	
	function dressing_room() {
		if(isset($_SESSION['user_id'])) {
			echo "<div id='dressing_room'>";
			
			/*$kinds = array_merge($men_kinds, $women_accessories);*/
			$i = 0;
			foreach($kinds as $kind) {
				echo "<h3>" . array_search($kind) . "</h3>";
				$fetch_user_dress = "SELECT * FROM dress_room WHERE user_id=" . $_SESSION['user_id'] . " AND kind='$kind'";
				if(!($fetch_user_result = mysql_query($fetch_user_dress))) {
					die(mysql_error());
				}
				while($fetch_user_row = mysql_fetch_array($fetch_user_result)) {
					//echo $i;
					$product_query = "SELECT * FROM product WHERE product_id=" . $fetch_user_row['product_id'];
					if(!($product_result = mysql_query($product_query))) {
						die(mysql_error());
					}
					
					$product = mysql_fetch_assoc($product_result);
					
					if($i == 0) {
						echo "<div class='product_row'>";
					}
					echo "<div class='product'>";
					echo "<a href='" . $product['link'] . "' target='_blank'>";
					echo "<img src='" . $fetch_user_row['image_url'] . "' /></a>";
					echo "<div class='product_meta'>";
					/*$brand_key = array_search($all_row['brand'], $brands);
					if($brand_key) {
						echo "<p class='product_manu'>" . $brand_key . "</p>";
					} else {
						echo "<p class='product_manu'>" . $all_row['brand'] . "</p>";
					}*/
					echo $product['brand'];
					echo "<p class='product_manu'>" . $brands[$product['brand']] . "</p>";
					echo "<p class='product_price'>$" . number_format($product['price'], 2) . "</p>";
					echo "</div>";
					echo "</div>";
					$i++;
					if($i == 4) {
						$i = 0;
						echo "</div>";
					}
					
				}
			
			}
			
			echo "</div>";
		}
	}
	
	function edit_profile() {
		$find_user_query = "SELECT * FROM user WHERE user_id=" . $_SESSION['user_id'];
		if(!($find_user_result = mysql_query($find_user_query))) {
			die(mysql_error());
		}
		$user = mysql_fetch_assoc($find_user_result);
		echo '<div id="edit_profile"><div id="top_edit">
				<h1>Edit Profile</h1>
			</div>
			<div id="middle_edit">
				<form id="edit_form" action="/" method="post">
					<input type="hidden" name="user_id" value="' . $user['user_id'] . '" />
					<div id="edit_basics">
						<table>
							<tr>
								<td><p>first name</p></td>
								<td><input type="text" name="edit_first_name" value="' . $user['first_name'] . '" /></td>
							</tr>
							<tr>
								<td><p>last name</p></td>
								<td><input type="text" name="edit_last_name" value="' . $user['last_name'] . '" /></td>
							</tr>
							<tr>
								<td><p>email</p></td>
								<td><input type="text" name="edit_email" value="' . $user['email'] . '" /></td>
							</tr>
							<tr>
								<td><p>password</p></td>
								<td><a id="change_password" href="javascript:void">change password</a><input class="hidden" type="password" name="old_pass" /></td>
							</tr>
							<tr class="hidden">
								<td><p>new password</p></td>
								<td><input type="password" name="edit_password" /></td>
							</tr>
							<tr class="hidden">
								<td><p>confirm password</p></td>
								<td><input type="password" name="edit_password_confirm" /></td>
								<td><p id="edit_pass_no_match">Passwords don\'t match</p></td>
							</tr>
							<tr>
								<td><p>birthday</p></td>
								<td>
									<select name="edit_month">
										<option value="blank"></option>';
										
											for($i = 1; $i < 13; $i++) {
												echo "<option value='$i'";
												if($i == $user['month']) {
													echo " selected='selected'";
												}
												echo ">$i</option>";
											}
										
										echo '</select>
									<select name="edit_day">
										<option value="blank"></option>';
											for($i = 1; $i < 32; $i++) {
												echo "<option value='$i'";
												if($i == $user['day']) {
													echo " selected='selected'";
												}
												echo ">$i</option>";
											}
										
									echo '</select>
									<select name="edit_year">
										<option value="blank"></option>';
											for($i = 2008; $i > 1950; $i--) {
												echo "<option value='$i'";
												if($i == $user['year']) {
													echo " selected='selected'";
												}
												echo ">$i</option>";
											}
									echo '</select>
								</td>
							</tr>
							<tr>
								<td></td>
								<td><p class="smaller">This will not be shown to other users</p></td>
							</tr>
						</table>
					</div>
					<div id="edit_combinations">';
					
					$user_combination_query = "SELECT * FROM combinations WHERE user_id=" . $_SESSION['user_id'];
					if(!($user_combination_result = mysql_query($user_combination_query))) {
						die(mysql_error());
					}
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
					if(mysql_num_rows($user_combination_result) > 0) {
						echo '<p>my colors</p>
						<table>';
						while($user_combination = mysql_fetch_array($user_combination_result)) {
							echo '<tr comb_id="' . $user_combination['id'] . '">
									<td>name</td>
									<td><input type="text" name="edit_combination_name" value="' . $user_combination['name'] . '" /></td>
								</tr>
								<tr comb_id="' . $user_combination['id'] . '">
									<td></td>
									<td><div class="edit_color_palette">';
										foreach($colors as $i => $values) {
											echo '<div class="edit_color_row">';
											
											foreach($values as $key => $value) {
												echo '<div class="edit_comb_color"><a class="';
												if($user_combination[$key] == 1) {
													echo ' edit_comb_color_selected';
												}
												echo '" href="javascript:void" style="background: ' . $value . '"></a></div>';
											}
											echo '</div>';
										}
									echo '</div><div class="edit_color_combination_options"><ul><li><a class="edit_comb_view_all" href="javascript:void">view all</a></li><li class="last"><a class="edit_comb_clear" href="javascript:void">clear</a></li></ul></div>
									</td>
								</tr>';
						}
						echo '</table>';
					}
					
					$clothing_types = array("blank", "women", "men", "both");
					
					echo '</div>
					<div id="edit_clothing">
						<p>clothing type</p>
						<select name="edit_clothing_type">';
							foreach($clothing_types as $ct) {
								echo '<option value="' . $ct . '"';
								if($ct == $user['clothing_type']) {
									echo ' selected="selected"';
								}
								echo '>' . $ct . '</option>';
							}
						echo '</select>
					</div>
					<div id="edit_updates"';
					if($user['updates'] == 1) {
						echo ' class="edit_updates_checked"';
					}
					echo '>
						<a href="javascript:void" class="edit_check"><div class="edit_checkbox"></div>
						<p class="smaller">I would like to receive email updates when deals become available or new items in my preferred colors are posted</p>
						</a>
					</div>
					<div id="delete_account">
						<a href="javascript:void" id="delete_account_button">delete account</a>
					</div>	
			</div>
			<div id="bottom_edit">
				<input type="submit" id="save_profile" value="save profile" />
			</div></form></div>';
	}
	
	function delete_confirm() {
		echo '<div id="delete_confirm">
				<div id="top_delete">
					<img src="images/logo_gray.jpg" alt="Delete Account Logo" />
					<div id="delete_account_close">
						<p><a href="javascript:void" id="close_delete_account">X</a></p>
					</div>
				</div>
				<div id="middle_delete">
					<p>are you sure you want to delete your Spirit Friday account?</p>
				</div>
				<div id="bottom_delete">
					<a href="javascript:void" id="cancel_delete">no, cancel</a>
					<a href="javascript:void" id="confirm_delete">yes, delete</a>
				</div>
			</div>';
	}
	
	function filter($filter_type, $brands, $stores, $prices) {
		echo '<div id="' . $filter_type . '_filter" class="refine_filter">
			<div id="' . $filter_type . '_top">';
				if($filter_type == "price") {
					echo '<h3>select price(s)</h3>';
				} else {
					echo '<h3>select a ' . $filter_type . '(s)</h3>';
				}
				echo '<div id="' . $filter_type . '_close">
					<p><a href="javascript:void" class="close_button">X</a></p>
				</div>
			</div>';
			if($filter_type != "price") {
				echo '<input type="text" placeholder="search ' . $filter_type . '" />';
			}
			echo '<div id="' . $filter_type . 's">';
				if($filter_type == "brand") {
					$filter_arr = $brands;
				} else if($filter_type == "store") {
					$filter_arr = $stores;
				} else if($filter_type == "price") {
					$filter_arr = $prices;
				}
				
				if($filter_type == "price") {
					echo "<ul>";
					if(isset($_SESSION[$filter_type]) && (count($_SESSION[$filter_type]) != 0)) {
						foreach(array_keys($filter_arr) as $filter) {
							if(in_array($filter, $_SESSION[$filter_type])) {
								echo "<li><a class='" . $filter_type . "_check " . $filter_type . "_selected' href='javascript:void'><div class='checkbox'></div>";
								echo $filter . "</a></li>";
							} else {
								echo "<li><a class='" . $filter_type . "_check' href='javascript:void'><div class='checkbox'></div>";
								echo $filter . "</a></li>";
							}
						}
					} else {
						foreach(array_keys($filter_arr) as $filter) {
							echo "<li><a class='" . $filter_type . "_check' href='javascript:void'><div class='checkbox'></div>";
							echo $filter . "</a></li>";
						}
					}
					echo "</ul>";
				} else {
					$filter_half = count($filter_arr) / 2;
					//echo $filter_half;
					$i = 0;
					if(isset($_SESSION[$filter_type]) && (count($_SESSION[$filter_type]) != 0)) {
						echo "<ul id='left_" . $filter_type . "s'>";
						foreach($filter_arr as $filter) {
							if($i == floor($filter_half + 1)) {
								echo "</ul>";
								echo "<ul id='right_" . $filter_type . "s'>";
							}
							if(in_array($filter, $_SESSION[$filter_type])) {
								echo "<li><a class='" . $filter_type . "_check " . $filter_type . "_selected' href='javascript:void'><div class='checkbox'></div>";
								echo $filter . "</a></li>";
							} else {
								echo "<li><a class='" . $filter_type . "_check' href='javascript:void'><div class='checkbox'></div>";
								echo $filter . "</a></li>";
							}
							$i++;
						}
						echo "</ul>";
					} else {
						echo "<ul id='left_" . $filter_type . "s'>";
						foreach($filter_arr as $filter) {
							if($i == floor($filter_half + 1)) {
								echo "</ul>";
								echo "<ul id='right_" . $filter_type . "s'>";
							}
							echo "<li><a class='" . $filter_type . "_check' href='javascript:void'><div class='checkbox'></div>";
							echo $filter . "</a></li>";
							$i++;
						}
						echo "</ul>";
					}
				}
			echo '</div>
			<div id="' . $filter_type . '_buttons">
				<a href="javascript:void" id="' . $filter_type . '_clear">clear</a>
				<a href="javascript:void" id="' . $filter_type . '_ok">ok</a>
			</div>
		</div>';
		/*
		echo '<div id="brand_filter" class="refine_filter">
			<div id="brand_top">
				<h3>select a brand(s)</h3>
				<div id="brand_close">
					<p><a href="javascript:void" class="close_button">X</a></p>
				</div>
			</div>
			<input type="text" placeholder="search brand" />
			<div id="brands">';
				
				$brands_half = count($brands) / 2;
				//echo $brands_half;
				$i = 0;
				if(isset($_SESSION['brand']) && (count($_SESSION['brand']) != 0)) {
					echo "<ul id='left_brands'>";
					foreach(array_keys($brands) as $brand) {
						if($i == floor($brands_half + 1)) {
							echo "</ul>";
							echo "<ul id='right_brands'>";
						}
						if(in_array($brand, $_SESSION['brand'])) {
							echo "<li><a class='brand_check brand_selected' href='javascript:void'><div class='checkbox'></div>";
							echo $brand . "</a></li>";
						} else {
							echo "<li><a class='brand_check' href='javascript:void'><div class='checkbox'></div>";
							echo $brand . "</a></li>";
						}
						$i++;
					}
					echo "</ul>";
				} else {
					echo "<ul id='left_brands'>";
					foreach(array_keys($brands) as $brand) {
						if($i == floor($brands_half + 1)) {
							echo "</ul>";
							echo "<ul id='right_brands'>";
						}
						echo "<li><a class='brand_check' href='javascript:void'><div class='checkbox'></div>";
						echo $brand . "</a></li>";
						$i++;
					}
					echo "</ul>";
				}
			echo '</div>
			<div id="brand_buttons">
				<a href="javascript:void" id="brand_clear">clear</a>
				<a href="javascript:void" id="brand_ok">ok</a>
			</div>
		</div>';*/
	}
	
?>