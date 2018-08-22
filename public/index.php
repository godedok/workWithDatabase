<?php
/**
 * Home page with a search by genre, a link to create a record,
 *  and information from the database
 */
include "templates/header.php";
require "musician.php";
require "../common.php";
require "table.php";

$newMusician = new Musician;
$result = $newMusician->readTable();
$resultGenre = $newMusician->readGenre();

if (isset($_POST['submit'])) {
	$newMusician->genre = $_POST['IdGenre'];
	$result = $newMusician->findRecord();
}

?>

<ul>
	<li><a href="create.php"><strong>Create</strong></a> - add a Musician</li>
	<li><a href="genre.php"><strong>Genre</strong></a> - add a Genre</li>
</ul>

<h2>Find user by genre</h2>

<form method="post">
	<label for="IdGenre">Genre</label>
	<input type="text" id="IdGenre" name="IdGenre">
	<input type="submit" name="submit" value="View Results">
</form>

<h2>List of genres</h2>

<table>
    <thead>
        <tr>
            
			<th>Genre Name</th>
		</tr>
	</thead>
	<?php foreach ($resultGenre as $row) : ?>
        <tr>
            
            <td><?php echo escape($row["Name"]); ?></td>
			<td><a href="update-genre.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
            <td><a href="delete-genre.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h2>List of musicians</h2>

<?php createTable($result); ?>

<?php include "templates/footer.php"; ?>