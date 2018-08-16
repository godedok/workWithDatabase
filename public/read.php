<?php

if (isset($_POST['submit'])) {
	try {	
		//require "connect.php";
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);
		//$musicianConnect = new Connection;
		//$connection = $musicianConnect->getConnect();
        $genre = $_POST['Genre'];
		$sql = "SELECT * 
						FROM Cubans
						WHERE Genre LIKE '%$genre%' ";

		

		$statement = $connection->prepare($sql);
		$statement->bindParam(':Genre', $genre, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>
<?php require "templates/header.php"; ?>
		
<?php  
if (isset($_POST['submit'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Gender</th>
					<th>YearOfBirth</th>
					<th>Genre</th>
					<th>IsInGroup</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["Id"]); ?></td>
				<td><?php echo escape($row["FirstName"]); ?></td>
				<td><?php echo escape($row["LastName"]); ?></td>
				<td><?php echo escape($row["Gender"]); ?></td>
				<td><?php echo escape($row["YearOfBirth"]); ?></td>
				<td><?php echo escape($row["Genre"]); ?></td>
				<td><?php echo escape($row["IsInGroup"]); ?> </td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['Genre']); ?>.</blockquote>
	<?php } 
} ?> 

<h2>Find user by genre</h2>

<form method="post">
	<label for="Genre">Genre</label>
	<input type="text" id="Genre" name="Genre">
	<input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>