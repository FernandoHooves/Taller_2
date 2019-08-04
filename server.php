<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'laravel');

	// initialize variables
	$name = "";
	$detail = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$detail = $_POST['detail'];

		mysqli_query($db, "INSERT INTO products (name, detail) VALUES ('$name', '$detail')"); 
		$_SESSION['message'] = "Data saved!"; 
		header('location: index.php');
	}

	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$detail = $_POST['detail'];
	
		mysqli_query($db, "UPDATE products SET name='$name', detail='$detail' WHERE id=$id");
		$_SESSION['message'] = "Data updated!"; 
		header('location: index.php');
	}

	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM products WHERE id=$id");
		$_SESSION['message'] = "Data deleted!"; 
		header('location: index.php');
	}