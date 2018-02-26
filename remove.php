<?php

include("database.php");

$db = db_connect();

$filename = $_POST["filename"];

$sql = "DELETE FROM files WHERE filename='$filename'";

$result = mysqli_query($db, $sql);

?>
