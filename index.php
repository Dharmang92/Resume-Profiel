<?php
require_once "pdo.php";
session_start();
?>

<html>

<head>
    <title>Dharmang Gajjar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Dharmang Gajjar's Resume Registery</h1>

        <?php
        function viewTable()
        {
            global $pdo;
            $stmt = $pdo->query("select first_name, last_name, headline from profile");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row !== false) {
                echo "<table border=1>";
                echo "<tr><td><b>Name</b></td><td><b>Headline</b></td><td><b>Action</b></td></tr>";
                while ($row->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlentities($row["first_name"]) . " " . htmlentities($row["last_name"]) . "</td>";
                    echo  "<td>" . htmlentities($row["headline"]) . "</td>";
                    echo  "<td>" . "<a href='" . $row['profile_id'] . "'>Edit</a> <a href='" . $row['profile_id'] . "'>Delete</a>" . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }

        if (isset($_SESSION["user_id"])) {
            echo "<p><a href='logout.php'>Logout</a></p>";
            viewTable();
            echo "<p><a href='add.php'>Add New Entry</a></p>";
        } else {
            echo "<p><a href='login.php'>Please log in</a></p>";
        }

        ?>
    </div>
</body>

</html>