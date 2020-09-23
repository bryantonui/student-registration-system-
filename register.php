<?php 
//starting session 
session_start();
//create a connection to database and store the info in a variable 
$conn = mysqli_connect('localhost','root','','studentsphp');
//global variables . check if email is already taken 
$_SESSION['emailTaken'] = "Email is already taken. Please try another one.";
//get the form inputs from registerlogin.html
//first we check if the register button btn has been clicked 
if (isset($_POST['createacc'])) {
	# code...
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
}
//encrypting passwords 
$encrypted_password = md5($password);
//fetch the records from database
$registered = "SELECT * FROM users WHERE email='$email'";
//store result of the fetch query 
$result = mysqli_query($conn,$registered);
//checking the number of rows with same email 
$num = mysqli_num_rows($result);
//this is the logic for the check 
if ($num==1) {
	# code...
	$_SESSION['emailTaken'];
	//if email exists , stay on the same page 
	header('location: registerlogin.php');
} else {
	//write the sql command to insert our user 
	$sql = "INSERT INTO users (studentname,email,password) VALUES('$name','$email','$encrypted_password')";

	//pushing data to database 
	mysqli_query($conn,$sql);
	echo "registration successful";

	//display message in same place 
	header('location: registerlogin.php?registered=true');
}





?>