<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$positions = $_POST['positions'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		//generate voters id
		$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$voter = substr(string: str_shuffle($set), offset:0, length: 15);

		$sql = "INSERT INTO voters (voters_id, password, firstname, lastname, photo, positions) VALUES ('$voter', '$password', '$firstname', '$lastname', '$filename', '$positions')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Voter added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: voters.php');
?>