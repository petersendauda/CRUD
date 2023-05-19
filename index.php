<?php

include('dbconn.php');

$query = "SELECT gender, COUNT(*) AS count FROM crud GROUP BY gender";
$result = mysqli_query($conn, $query);
if ($result) {
	$data = array();
	while ($row = $result->fetch_assoc()) {
		$data[] = array(
			"gender" => $row["gender"],
			"count" => $row["count"]
		);
	}
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/2.9.4/Chart.min.js"></script>

	<title>add a new player</title>
</head>

<body>
	<h1 align="center">CHIEVO VERONA FC</h1>
	<a href="registration.php">Add New</a>


	<?php
	$gender = array();
	$sql = "SELECT gender, count(*) as count 
FROM crud 
GROUP by gender";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)) {
		$gender[] = array("x" => $row["gender"], "y" => $row["count"]);

	}
	?>
	<style>
		#chart {
			max-width: 400px;
			max-height: 600;
			margin: 40px auto;
		}
	</style>
	<div id="chart"></div>
	<script>

		var options = {
			chart: {
				type: 'bar'
			},
			series: [{
				name: 'Players',
				data: <?php echo json_encode($gender); ?>
			}],
			xaxis: {
				categories: ['Female', 'Male',]
			}
		}

		var chart = new ApexCharts(document.querySelector("#chart"), options);

		chart.render();
	</script>

<div id="mychart"></div>
	<!-- PIE CHART -->

	<script>
		var options = {
			series: <?php echo json_encode($gender); ?>,
			chart: {
				width: 380,
				type: 'pie',
			},
			labels: <?php echo json_encode(array_column($gender, 'x')); ?>,
			responsive: [{
				breakpoint: 480,
				options: {
					chart: {
						width: 200
					},
					legend: {
						position: 'bottom'
					}
				}
			}]
		};

		var chart = new ApexCharts(document.querySelector("#mychart"), options);
		chart.render();
	</script>







	<h1 align="center"> LIST OF PLAYERS</h1>
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
		include "dbconn.php";
		$sql = "SELECT * FROM crud ORDER BY id DESC";
		$result = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			?>
			<tr>
				<td>
					<?php echo $row['id'] ?>
				</td>
				<td>
					<?php echo $row['fname'] ?>
				</td>
				<td>
					<?php echo $row['lname'] ?>
				</td>
				<td>
					<?php echo $row['email'] ?>
				</td>
				<td>
					<?php echo $row['gender'] ?>
				</td>
				<td>
					<a href="update.php?id=<?php echo $row['id'] ?>">UPDATE</a>
					<a href="delete.php?id=<?php echo $row['id'] ?>">DELETE</a>
				</td>
			</tr>
			<?php
		}
		?>


	</table>
</body>

</html>