<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>add a new player</title>
</head>
<body>
<h1 align= "center"> LIST OF PLAYERS</h1>
	<a href="registration.php">Add New</a>

	<table align="center" cellspacing=80>
		<tr>
			<th>#</th>
			<th>FIRST NAME</th>
			<th>LAST NAME</th>
			<th>EMAIL</th>
			<th>GENDER</th>
			<th>ACTION</th>

		</tr>
		<?php
		include"dbconn.php";
		$sql = "SELECT * FROM crud";
		$result = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
		?>
		<tr>
			<td><?php echo $row['id'] ?></td>
			<td><?php echo $row['fname'] ?></td>
			<td><?php echo $row['lname'] ?></td>
			<td><?php echo $row['email'] ?></td>
			<td><?php echo $row['gender'] ?></td>
			<td>
				<a href="update.php?id=<?php echo $row['id']?>">UPDATE</a>
				<a href="delete.php?id=<?php echo $row['id']?>">DELETE</a>
			</td>
		</tr>
		<?php
		}
   ?>


	</table>
</body>
</html>
