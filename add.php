<?php
	include 'db_connection.php';

	if(isset($_POST['submit'])){
		$name=$_POST['name'];
		$lname=$_POST['lastname'];
		$age=$_POST['age'];
		
		//validation for name
		if (empty($name)) 
		{
			$emptyName = "Please Input Name";
		}
		//validation for last name
		else if (empty($lname)) 
		{
			$emptyLastName = "Please Input LastName";
		}
		//validation for age
		else if ((empty($age)) OR !(is_numeric($age)) OR ($age >= 100) OR ($age <= 0) )
		{
			$checkAge = "Please Input Age or Invalid Age or Over Age or Under Age";
		}
		//insert record in database
		else{
			$stmt=$connection->prepare("INSERT INTO search_table (name,lastname,age) VALUES (?,?,?)");
			$stmt->bind_param("ssi",$stmtName,$stmtLastName,$stmtAge);
			$stmtName=$name;
			$stmtLastName=$lname;
			$stmtAge=$age;
			$stmt->execute();
			$stmt->close();
			$connection->close();
			header('Location:index.php');
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/custom.css"/>
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/bootstrap.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<h1 class="title">ADD NEW RECORD</h1>
		<form method="POST" class="col-md-6 offset-md-3">
			<!--input field for name-->
			<div class="form-group">
				<input type="text" name="name" placeholder="Input First Name" class="form-control" value="<?php if(isset($_POST['name']))echo($name);?>"/>
			</div>
			<!--display an error if input field for name is empty-->
			<?php if(!empty($emptyName)) {?>
				<p id="emptyName" style="color:#D50000"><?php echo $emptyName; ?></p>
			<?php } ?>
			
			<!--input field for last name-->
			<div class="form-group">
				<input type="text" name="lastname" placeholder="Input LastName" class="form-control" value="<?php if(isset($_POST['lastname']))echo($lname);?>"/>
			</div>
			<!--display an error if input field for last name is empty-->
			<?php if(!empty($emptyLastName)) {?>
				<p id="emptyLastName" style="color:#D50000"><?php echo $emptyLastName; ?></p>
			<?php } ?>
			<!--input field for age-->
			<div class="form-group">
				<input type="text" name="age" placeholder="Input Age" class="form-control" value="<?php if(isset($_POST['age']))echo($age);?>"/>
			</div>
			
			<!--validate age -->
			<?php if(!empty($checkAge)) {?>
				<p id="checkAge" style="color:#D50000"><?php echo $checkAge; ?></p>
			<?php } ?>

			<!--button for inserting new record-->
			<div class="form-group">
				<input type="submit" name="submit" value="SAVE" class="btn btn-primary"/>
			</div>
		</form>
	</div>
</div>
</body>
</html>