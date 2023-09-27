<?php
require_once 'config_session.inc.php';

//to print the user name in the welcoming message
if (isset($_SESSION["user_id"])){
    $mysqli = require_once "db.inc.php";
    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Home Page</h1>
<?php if (isset($user)): ?>
<p>Hello <?= htmlspecialchars($user["username"])?></p>
<p><a href="logout.php">Log out</a></p>
<?php else: ?>
    <p><a href="login.php">Log in</a> <a href="signup.html">Sign up</a></p>
<?php endif; ?>

</body>
</html>