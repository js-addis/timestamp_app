<!DOCTYPE html>
<?php

define("DB_SERVER", "localhost:8889");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "file_access");


function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if($connection) {
        echo "connected to DB";
    } else {
        echo "connection failed";
    }
    return $connection;
}
function db_disconnect() {
    if(isset($connection)) {
        mysqli_close($connection);
    }
}

$db = db_connect();

if(isset($_POST["submit"])) {

    $file_name = $_FILES["file"]["name"];
    $file_size = $_FILES["file"]["size"];
    $tmp_name = $_FILES['file']['tmp_name'];
    $date = date("Y/m/d");
    $time = date("h:i:sa");
    $timestamp = time();

    $sql = "INSERT INTO files ";
    $sql .= "(filename, date_created, time_created, date_accessed, time_accessed, timestamp) ";
    $sql .= "VALUES (";
    $sql .= "'" . $file_name . "',";
    $sql .= "'" . $date . "',";
    $sql .= "'" . $time . "',";
    $sql .= "'" . $date . "',";
    $sql .= "'" . $time . "',";
    $sql .= "'" . $timestamp . "'";
    $sql .= ")";

    $result = mysqli_query($db, $sql);

    if($result) {
        echo "Database upload sucessful";
    } else {
        echo "Duplicate Entry Detected. " . "  ";
    }

    if (move_uploaded_file($tmp_name, "uploads/" . $file_name)) {
        echo "successful";
    } else {
        echo "Upload Failed!";
    }

}
function find_all_uploads() {
    global $db;
    $sql = "SELECT * FROM files ";
    $sql .= "ORDER BY id DESC";
    $result = mysqli_query($db, $sql);
    return $result;
}

$uploads_array = find_all_uploads();

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href='style.css'>
        <title>J-Addis</title>
        <style>

        </style>
    </head>
    <body>
        <div id="outer">
            <form id="form" action="" method="POST" enctype="multipart/form-data">
                <input type="file" id="file" name="file">
                <input type="submit" id="submit" name="submit">
            </form>
            <div id="container">
                <table class="list">
                    <tr>
                        <th>ID</th>
                        <th>Filename</th>
                        <th>Date Created</th>
                        <th>Time Created</th>
                        <th>Date Accessed</th>
                        <th>Time Accessed</th>
                        <th>Timestamp</th>
                    </tr>

                    <?php while($file = mysqli_fetch_assoc($uploads_array)) { ?>
                        <tr>
                            <td> <?php echo $file['id']; ?> </td>
                            <td> <?php echo $file['filename']; ?> </td>
                            <td> <?php echo $file["date_created"]; ?> </td>
                            <td> <?php echo $file["time_created"]; ?> </td>
                            <td> <?php echo $file["date_accessed"]; ?> </td>
                            <td> <?php echo $file["time_accessed"]; ?> </td>
                            <td> <?php echo $file["timestamp"]; ?> </td>
                        </tr>
                    <?php } ?>

                </table>
                <?php db_disconnect($db); ?>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                var context = $("#canvas").getContext("2d");
            })
            $("#submit").click(function() {
                var file = $("#file").val();
                alert(file);
            })
        </script>
    </body>
</html>
