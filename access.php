<?php
session_start();
//create a connection to database 
$conn = mysqli_connect('localhost','root','','studentsphp');
//define a session message 
$_SESSION['userUnavailable'] = "Please try again. Check the credentials";

//get inputs .from user 
//first check if login button has been clicked 
if (isset($_POST['login_button'])) {
	# code...
	$email = $_POST['emailLogin'];
	$password = $_POST['passwordLogin'];
}

//create the sql query 
$sql="SELECT * FROM users WHERE email='$email' && password= '".md5($password)."'";
//store the query
$results = mysqli_query($conn,$sql);
//check number of rows
$num = mysqli_num_rows($results);
//logic to check if user exists
if ($num==1) {
	# code...
    //store the name of the logged in user 
    $_SESSION['activeUser'] = $email;
    //set new location if login is a success 
    header('location: home.php');

} else {
	//set new location id creds are wrong 
	header('location: registerlogin.php');
}

?>