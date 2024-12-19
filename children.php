<?php
$config = require("config.php");

require("database.php");

try {
    $db = new Database($config['database']);
    
    // Nolasām bērnus un vēstules
    $children = $db->query("SELECT * FROM children")->fetchAll(PDO::FETCH_ASSOC);
    $letters = $db->query("SELECT * FROM letters")->fetchAll(PDO::FETCH_ASSOC);

    // Iekšējais CSS stils
    echo "<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #fff;
            margin: 10px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        li p {
            font-style: italic;
            color: #888;
        }
        .child-name {
            font-weight: bold;
            color: #2c3e50;
        }
        .letter-item {
            margin-top: 10px;
            background-color: #e3f2fd;
            padding: 10px;
            border-left: 5px solid #2196F3;
        }
        .no-letters {
            color: #f44336;
        }
    </style>";

    if ($children) {
        echo "<h1>Bērnu un vēstuļu saraksts</h1>";
        echo "<ul>";
        foreach ($children as $child) {
            // Parādām bērna informāciju
            echo "<li>";
            echo "<span class='child-name'>" . $child["firstname"] . " " . $child["middlename"] . " " . $child["surname"] . "</span>: Vecums " . $child["age"];

            // Filtrējam vēstules, kas saistītas ar bērnu
            $child_letters = array_filter($letters, function($letter) use ($child) {
                return $letter['sender_id'] == $child['id'];  // Pieņemot, ka 'receiver_id' ir saistīts ar bērnu
            });

            // Ja bērnam ir vēstules
            if ($child_letters) {
                echo "<ul>";
                foreach ($child_letters as $letter) {
                    // Parādām katru vēstuli
                    echo "<li class='letter-item'>";
                    echo "<strong>Vēstules sūtītājs:</strong> " . $letter["sender_id"] . "<br>";
                    echo "<strong>Teksts:</strong> " . $letter["letter_text"];
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p class='no-letters'>Nav saņemtas vēstules.</p>";
            }

            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Nav atrasti bērni.</p>";
    }
} catch (Exception $e) {
    echo "Kļūda: " . $e->getMessage();
}
?>

