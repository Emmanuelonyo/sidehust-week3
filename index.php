<?php

$success = "";
$error = "";

//PERFORMIN A DATABASE CONNECTION 

$dbuser = "root";
$dbpass = "";
$dbname = "todo_task";

$host = "";

$conn = mysqli_connect($host, $dbuser, $dbpass, $dbname);

//check if form is submited 

if (isset($_POST['submit'])){

	$task = mysqli_escape_string($conn, $_POST['task']);

	$add = mysqli_query($conn, "INSERT INTO task (Task) VALUES ('$task')");

	if ($add){
					$success = '<script type="text/javascript">
	
											alert("Task Successfuly Added")
											</script>';

	}else{

		$error = '<script type="text/javascript">
	
											alert("Sorry Somthing went Wrong")
									</script>';

	}
}
if (isset($_GET['del_task'])) {

	$serial = $_GET['del_task'];
	
	$delete = mysqli_query($conn, "DELETE FROM task WHERE serial='$serial' ");

	if ($delete) {
		
						$success = '<script type="text/javascript">
	
											alert("Task Successfuly Deleted");

											
									</script>';

	}else{

		$error = '<script type="text/javascript">
	
											alert("Sorry Somthing Went Wrong")
									</script>';

	}
}

?>







<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>MY SIMPLE TO-DO PROGRAM</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css



">
<link rel="stylesheet" href="sweetalert2.min.css">   
</head>
<body>
			<div class="heading">
		<h2 style="font-style: 'Hervetica';">ToDo List Program</h2>
	</div>
	<form method="post" action="" class="input_form">
		<input type="text" name="task" class="task_input">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form>

<?php echo $success ?>
<?php echo $error ?>

<table>
	<thead>
		<tr>
			<th>S/N</th>
			<th>Tasks</th>
			<th style="width: 60px;">Action</th>
		</tr>
	</thead>

	<?php 

		$qrydb = mysqli_query($conn, "SELECT * FROM task");

		$sn = 1;
		while ($row = mysqli_fetch_array($qrydb)) {
			
		?>


	
	<tbody>
		
			<tr>
				<td><?php echo $sn ?> </td>
				<td class="task"> <?php echo $row['Task'] ?> </td>

				<td class="delete"> 
					
					<a href="index.php?del_task=<?php echo $row['serial'] ?>"> X</a>
				</td>
			</tr>
		<?php  
		$sn++;
		}
		?>

	</tbody>
</table>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script> 
<script src="sweetalert2.min.js"></script>

</body>
</html>