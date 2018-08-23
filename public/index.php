<?php
/**
 * Home page with a search by genre, a link to create a record,
 *  and information from the database
 */
include "templates/header.php";
require "cubans/musician.php";
require "../common.php";
require "table.php";
require "genres/genreClass.php";

$listMusicians = new Musician;
$listGenres = new Genre;
$resultListMusicians = $listMusicians->readTable();
$arrayGenres = $listGenres->readGenre();

if (isset($_POST['submit'])) {
	$listMusicians->genre = $_POST['IdGenre'];
	$resultListMusicians = $listMusicians->findRecord();
}
?>

<ul>
	<li><a href="cubans/create.php"><strong>Create</strong></a> - add a Musician</li>
	<li><a href="genres/genre.php"><strong>Genre</strong></a> - add a Genre</li>
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
	<?php foreach ($arrayGenres as $row) : ?>
        <tr>
            <td><?php echo escape($row["Name"]); ?></td>
			<td><a href="genres/update-genre.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
            <td><a href="genres/delete-genre.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h2>List of musicians</h2>
<?php createTable($resultListMusicians); ?>
<?php include "templates/footer.php"; ?>