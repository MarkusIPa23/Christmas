<?php
$config = require("config.php");

require("database.php");

$db = new Database($config["database"]);
$gifts = $db->query("SELECT * FROM gifts");

if ($gifts) {
    foreach ($gifts as $gift) {
        echo $gift["name"] . " - Pieejamais daudzums: " . $gift["count_available"] . "<br>";
    }
} else {
    echo "Nav atrasti dati par dāvanām.";
}
?>
