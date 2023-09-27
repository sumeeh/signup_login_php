<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $mysqli = require_once "db.inc.php";
        $sql =sprintf("SELECT * FROM users WHERE email = '%s'", $mysqli->real_escape_string($_POST["email"]));
        $result = $mysqli->query($sql);
        $user = $result->fetch_assoc();

        if($user){
            if(password_verify($_POST["pwd"], $user["pwd"])){
                //link to other file that has a session started inside it bc its safer than starting the session in the same file
                require_once 'config_session.inc.php';
                $_SESSION["user_id"] = $user["id"];
                $_SESSION['last_regeneration'] = time(); 

                header("Location: index.php");
                exit;
            }
        }
        $is_invalid = true;
}

//link to other file that has a session started inside it bc its safer than starting the session in the same file
// require_once 'config_session.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
    if ($is_invalid):
    ?>
    <em>Invalid Login</em>
    <?php endif; ?>

<div class="container">

    <form method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="email" id="email" placeholder="email" novalidate value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="pwd" id="pwd" placeholder="password">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="submit" id="submit" value="submit">
        </div>
    </form>
</div>
    
</body>
</html>