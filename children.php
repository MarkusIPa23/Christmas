<?php
require("config.php");
$config = require("config.php");
$sql = "SELECT * FROM children"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        echo $row["firstname"] . $row["middlename"] . $row["surname"] . ":Vecums" . $row["age"] . "<br>";
    }
}

$conn->close();
?>