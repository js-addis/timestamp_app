<?php

define("DB_SERVER", "localhost:8889");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "file_access");


function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if($connection) {
        echo "<div style='width:100%;background-color:greenyellow;display:flex;border:1px solid black;margin-bottom:1px'>" . "<p style='margin:auto'>Database Connected</p>" . "</div>";
    } else {
        echo "<div style='width:100%;background-color:crimson;display:flex;border:1px solid black;margin-bottom:1px'>" . "<p style='margin:auto'>Database Connection Failed</p>" . "</div>";
    }
    return $connection;
}
function db_disconnect() {
    if(isset($connection)) {
        mysqli_close($connection);
    }
}

?>
