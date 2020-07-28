<?php
require_once "pdo.php";
session_start();

if (isset($_POST["cancel"])) {
    header("Location: index.php");
    return;
}

if (!isset($_SESSION["name"])) {
    die("ACCESSS DENIED");
}

if (isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["email"]) && isset($_POST["headline"]) && isset($_POST["summary"])) {
    if (strlen($_POST["first_name"]) < 1 || strlen($_POST["last_name"]) < 1 || strlen($_POST["email"]) < 1 || strlen($_POST["headline"]) < 1 || strlen($_POST["summary"]) < 1) {
        $_SESSION["addfail"] = "All fields are required";
        header("Location: add.php");
        return;
    } else {
        if (strpos($_POST["email"], "@") !== false) {
            $stmt = $pdo->prepare("insert into profile(user_id, first_name, last_name, email, headline, summary) values(:id, :fn, :ln, :em, :hd, :sm);");
            $stmt->execute(array(
                ":id" => $_SESSION["user_id"],
                ":fn" => $_POST["first_name"],
                ":ln" => $_POST["last_name"],
                "em" => $_POST["email"],
                ":hd" => $_POST["headline"],
                ":sm" => $_POST["summary"]
            ));

            $_SESSION["success"] = "Profile added";
            header("Location: index.php");
            return;
        } else {
            $_SESSION["addfail"] = "Email address must contain @";
            header("Location: add.php");
            return;
        }
    }
}
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
        <?php
        if (isset($_SESSION["addfail"])) {
            echo "<p style='color: red'>" . htmlentities($_SESSION["addfail"]) . "</p>";
            unset($_SESSION["addfail"]);
        }
        ?>
        <form method="post">
            <p>First Name: <input type="text" name="first_name" size="60" /></p>
            <p>Last Name: <input type="text" name="last_name" size="60" /></p>
            <p>Email: <input type="text" name="email" size="30" /></p>
            <p>Headline: <br /><input type="text" name="headline" size="80" /></p>
            <p>Summary: <br /><textarea name="summary" cols="80" rows="8"></textarea>
                <p><input type="submit" value="Add"> <input type="submit" name="cancel" value="Cancel"></p>
        </form>
    </div>
</body>

</html>