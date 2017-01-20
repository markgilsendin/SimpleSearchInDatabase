<?php
	include 'db_connection.php';

	$stmt=$connection->prepare("SELECT name, lastname, age FROM search_table");
	$stmt->execute();
	$stmt->bind_result($stmtName, $stmtLastName, $stmtAge);

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/glyphicons.css"/>
	<link rel="stylesheet" type="text/css" href="css/custom.css"/>
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/bootstrap.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<h1 class="main-title">SIMPLE SEARCH IN DATABASE</h1>
		<h6 class="sub-title">HTML | CSS | BOOTSTRAP | JAVASCRIPT | PHP | MYSQL</h6>
		<div align="right" class="search-box">
			<form class="form-inline" method="POST">
				<div class="form-group">
					<a href="add.php" class="btn btn-primary form-control">Add Record</a>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="text" name="search" placeholder="Search here.." id="search_box" class="form-control" autocomplete="off"/>
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-search"></span>
						 </span>	
					</div>
				</div>
				<!--<input type="submit" name="searchbtn" value="Go" class="btn btn-primary "/>-->
			</form>
		</div>
		
		<table class="table" id="search_table">
			<thead class="thead-inverse">
				<th>Name</th>
				<th>LastName</th>
				<th>Age</th>
			</thead>
				<tbody>
				<?php
					if(!empty($stmt)){
						while($stmt->fetch())
						{
							echo"<tr>";
							echo"<td>$stmtName</td>";
							echo"<td>$stmtLastName</td>";
							echo"<td>$stmtAge</td>";
							echo"</tr>";
						}
					}			
				?>
			</tbody>
		</table>
		<div id="no_result"></div>
	</div>
</div>

<script>
	$(document).ready(function(){
 		$("#search_box").keyup(function(){
  		var _this = this;
  		var result_empty=0;
 		// Show only matching TR, hide rest of them
	 		$.each($("#search_table tbody tr"), function() {
		 		if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
		 		{
		 			$(this).hide();
		 		}	
		  		else
		 		{
		 			$(this).show();
		 		}
	 		});
	    
 		});
	});
</script>

</body>
</html>