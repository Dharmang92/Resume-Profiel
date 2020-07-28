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
        <h1>Adding Profile for <?= htmlentities($_SESSION["name"]) ?></h1>

        <form method="post">
            <p>First Name: <input type="text" name="first_name" size="60" /></p>
            <p>Last Name: <input type="text" name="last_name" size="60" /></p>
            <p>Email: <input type="text" name="email" size="30" /></p>
            <p>Headline: <br /><input type="text" name="email" size="80" /></p>
            <p>Summary: <br /><textarea name="summary" cols="80" rows="8"></textarea>
                <p><input type="submit" value="Add"> <input type="submit" value="Cancel"></p>
        </form>
    </div>
</body>

</html>