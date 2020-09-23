<!DOCTYPE html>
<html>
<head>
	<title>Students Profile</title>
    <link rel="stylesheet" href="bootstrap-3.4.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-3.4.1-dist/css/bootstrap-theme.css">
</head>
<body>
<!-- requiring of the process file -->
<?php require_once 'process.php' ?>
<!-- checking if a session message exists  -->
<?php  
   if (isset($_SESSION['message'])): 
?>
 <!-- display session message  -->
<div class="container container-fluid">
	<div class="alert alert-<?= $_SESSION['msg_type'] ?>">
		<?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
          session_destroy();
		?>
    </div>
    <!-- end if  -->
    <?php endif; ?>
</div>
<!-- fetching records from my database -->
<?php
//connect to db 
$mysqli = new mysqli('localhost','root','','studentsphp') or die(mysql_error($mysqli));
//do a query to select all our records 
$result = $mysqli->query("SELECT * FROM studentsprofile") or die($mysqli->error);
?>

<p>
    <?php
      echo "Welcome to the students profile.You are required to submit in the following details: ";
	?>
</p> 
<!-- logout link -->
<a href="logout.php"><strong>Logout</strong></a>

<!-- form creation for submission -->
<div class="container container-fluid">
    <form action="process.php"method="POST" enctype="multipart/form-data">
    <!-- hiding my id value  -->
    <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="name">Student Name</label>
            <input type="text" name="sname" class="form-control" value="<?php echo $sname; ?>">
        </div>
        <div class="form-group">
            <label for="name">Contact Phone Number</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
        </div>
        <div class="form-group">
            <label for="name">Student Image</label>
            <input type="file" name="pimage" class="form-control">
        </div>
        <div class="form-group">
            <label for="name">Student Summary</label>
            <textarea class="form-control" placeholder="<?php echo $summary; ?>" name="summary" cols="5" rows="10"></textarea>
        </div>
        <?php
        if ($update == true):
		?>
        <button type="submit" name="update" class="btn btn-warning btn-block btn-lg">Update</button>
        <?php else: ?>
        <button type="submit" name="save" class="btn btn-primary btn-block btn-lg">Submit</button>
        <?php endif; ?>
        <button type="reset" class="btn btn-danger btn-block btn-lg">Reset</button>
    </form>
    
    
</div>

<p>
    <?php
      echo "The list below is of the updated students submission records: ";
	?>
</p> 

<!-- create table to display our data  -->
<div class="container container-fluid">
	<table class="table">
		<thead>
			<tr>
				<th>Student Image</th>
				<th>Student Name</th>
				<th>Student Phone</th>
				<th>Student Summary</th>
				<th colspan="2">Action</th>
			</tr>

		</thead>

		<!-- while loop to pull our records from our database -->
         <?php
         while ($row = $result->fetch_assoc()): 
         ?> 
         <!-- display my records inside table cells -->
         <!-- the name i place in [] is the name of the column in the table in my db -->
         <tr>
         	<td><?php echo "<img src='studentsprofilepictures/" . $row['students_image'] . "' style='width:100px; height: 100px;'>" ?></td> 
         	<td><?php echo $row['name']; ?></td>
         	<td><?php echo $row['phone']; ?></td>
         	<td><?php echo $row['summary']; ?></td>
         	<td><a href="home.php?edit=<?php echo $row['id']; ?>" class="btn btn-info" style="margin-bottom: 5px;">Edit</a>
            <a href="home.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger" style="margin-bottom: 5px;" >Delete</a>
         	</td>
         </tr>

         <!-- end while loop -->
		  <?php
          endwhile;
          ?>
	</table>
	

</div>

</body>
</html>