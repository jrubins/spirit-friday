<?php
	
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(isset($_POST['id'])) {
			require_once('../includes/database.php');
			db_connect();
			
			$color_entry_id = $_POST['id'];
			
			$delete_color_query = "DELETE FROM color WHERE id=" . $color_entry_id;
			mysql_query($delete_color_query);
			
			$response = array();
			$response['id'] = $color_entry_id;
			echo json_encode($response);
		}
	} else {
		header("Location: real_index.php");
	}

?>