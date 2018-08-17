<?php

require "musician.php";
require "../common.php";
require "table.php";

$newMusician = new Musician;
$result = $newMusician->readTable();

?>
<?php require "templates/header.php"; ?>
        
<h2>Update musicians</h2>

<?php createTable($result, "update"); ?>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>