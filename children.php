<?php
$config = require("config.php");

require("database.php");

$db = new Database($config['database']);

$children = $db->query("SELECT * FROM children");
$letters = $db->query("SELECT * FROM letters");
if ($children) {
    echo "<ul>";
    foreach ($children as $child) {
        echo "<li>" . $child["firstname"] . " " . $child["middlename"] . " " . $child["surname"] . ": Vecums " . $child["age"] . "</li>";
        foreach ($letters as $letter){
            echo "<li>" . $letter["sender_id"] . " " . $letter["letter_text"] . "</li>";
        }
    }
    echo "</ul>";
} else {
    echo "Nav atrasti bērni.";
}
?>

