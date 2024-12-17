<?php
require("config.php");
$config = require("config.php");
$sql = "SELECT * FROM gifts"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        echo $row["name"] . $row["count_available"] . "<br>";
    }
}
$conn->close();
?>