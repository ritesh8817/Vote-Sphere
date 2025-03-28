<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM voters WHERE id = '$id'";;
		$voters_id = $_SESSION["voter"];
		$sql_voters = "DELETE FROM votes WHERE voters_id = '$voters_id'";
		$conn->query($sql_voters);
		if($conn->query($sql)){
			$_SESSION['success'] = 'Voter deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: voters.php');
	
?>