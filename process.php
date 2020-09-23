<?php 
// start the session
session_start();
// connecting to the database
$mysqli = new mysqli('localhost','root','','studentsphp') or die (mysqli_error($mysqli));

// setting up global variables for the users input
$id = 0;
$update = false;
$sname = "";
$phone = "";
$pimage = "";
$summary = "";
// handling the submission
// checking if the submit button has been click
// accessing our global variables using superglobal $_POST
// using the isset function to check wheather all the conditions have been met
// save is the name of the btn
if (isset($_POST['save'])) {
    #code...
    // the path that stores our image
    $target = "studentsprofilepictures/" . basename($_FILES['pimage']['name']);
    // the name and the location of the input is stored in the database
    // the name in the [] is the name of the input in the submission form
    $sname = $_POST['sname'];
    $phone = $_POST['phone'];
    $pimage = $_FILES ['pimage']['name'];
    $summary = $_POST['summary'];
    //sql query to insert
	//the first () is where u declare the column name in ur db table 
	//the second () is where u map the value of the input from the user 
	$insert = "INSERT INTO studentsprofile (name,phone,students_image,summary) VALUES('$sname','$phone','$poster_image','$summary')";
	//place image to the folder studentprofilepictures folder so that we can have a path to retrieve it from 
	if (mysqli_query($mysqli,$insert)) {
		# code...
		move_uploaded_file($_FILES['pimage']['tmp_name'], $target);
		//check if image has been moved 
        echo "<script>alert('image has been moved')</script>";
    } else {
		echo "<script>alert('image has not been moved')</script>";
    }
    //setting message for the save button and a bootstrap msg type 
	$_SESSION['message'] = "student profile added";
    $_SESSION['msg_type'] = "success";
    //redirect user to home.php for message
	header("location: home.php");

}
//update
//check if the edit button has been clicked 
if (isset($_GET['edit'])) {
	# code...
	$id = $_GET['edit'];
	//variable update 
	$update = true;
	//pulling requested record 
	$result = $mysqli->query("SELECT *  FROM studentsprofile WHERE id=$id") or die($mysqli->error);
	//check if record to be edited exists in the database
	//the names in the [] are names of your column in the database 
	$row = $result->fetch_array();
	$sname = $row['name'];
	$phone = $row['phone'];
	$pimage = $row['students_image'];
	$summary = $row['summary'];
}
//update and edit records
//check if the update button is clicked 
if (isset($_POST['update'])) {
	# code...
	//new path for image
	$newtarget = "studentsprofilepictures/" .basename($_FILES['pimage']['name']);
    // the names i place inside the [] is input form
    $id = $_POST['id'];
    $sname = $_POST['sname'];
    $phone = $_POST['phone'];
	$pimage = $_FILES['pimage']['name'];
    $summary = $_POST['summary'];
    
    //new update 
	$updatesql = "UPDATE studentsprofile SET name='$sname', phone='$phone',students_image='$pimage', summary='$summary' WHERE id='$id' ";
    //delete existing image using unlink function
    unlink("studentsprofilepictures/$pimage");
    //place new image to the folder 
    if (mysqli_query($mysqli, $updatesql)) {
    	# code...
    	move_uploaded_file($_FILES['pimage']['tmp_name'], $newtarget);
    	 //check if image has been moved
        //setting session messages for updates
        $_SESSION['message'] = "Record has been updated";
        $_SESSION['msg_type'] = "warning";
        //redirect
        header("location: home.php");
    } else {
        echo "<script>alert('image has not been moved')</script>";
        header('location: home.php');
    }
}

//delete a record 
//first check if delete button has been clicked 
if (isset($_GET['delete'])) {
	# code...
	$id = $_GET['delete'];
	//sql query command delete 
	$mysqli->query("DELETE FROM studentsprofile WHERE id=$id") or die($mysqli->error);
	//setting message and message type for the delete button
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    //redirecting user back to home.php
    header("location: home.php");
}





?>