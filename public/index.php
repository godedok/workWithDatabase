<?php 
include "templates/header.php";
require "musician.php";
require "../common.php";
require "table.php";
$newMusician = new Musician;
$result = $newMusician->readTable();
 ?>

<ul>
    <li><a href="create.php"><strong>Create</strong></a> - add a Musician</li>
    <li><a href="find.php"><strong>Sample by genre</strong></a> - find a Musician</li>
</ul>

<h2>List of musicians</h2>

<?php createTable($result); ?>


<?php include "templates/footer.php"; ?>