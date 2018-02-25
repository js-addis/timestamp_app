<?php

include("database.php");

$db = db_connect();

$filename = $_POST["filename"];
$newDateAccessed = $_POST["newDateAccessed"];
$newTimeAccessed = $_POST["newTimeAccessed"];
$newTimeStamp = $_POST["newTimeStamp"];

$sql = "UPDATE files SET
    date_accessed='$newDateAccessed',
    time_accessed='$newTimeAccessed',
    timestamp='$newTimeStamp'
    WHERE filename='$filename'";

$result = mysqli_query($db, $sql);

if(result) {
    echo "success";
} else {
    echo "failed";
}

?>
