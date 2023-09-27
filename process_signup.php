<?php 

if(empty($_POST["username"])){
    die("Name is required");
}

if(! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("Valid email is requied");
}

if(strlen($_POST["pwd"])<8){
    die("Password must  be at least 8 characters long");
}

if(! preg_match("/[a-z]/i", $_POST["pwd"])){
    die("Passowd must contain at least one letter");
}

if(! preg_match("/[0-9]/i", $_POST["pwd"])){
    die("Passowd must contain at least one number");
}

if($_POST["pwd"] !== $_POST["repwd"]){
    die("Passowrd does not match");
}

//password hashing
$options = [
    'cost' => 12
];
$pwdHashing = password_hash($_POST["pwd"], PASSWORD_BCRYPT);

$mysqli = require_once "db.inc.php";

$sql = "INSERT INTO users (username, email, pwd) VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();

if(! $stmt->prepare($sql)){
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss", $_POST["username"], $_POST["email"], $pwdHashing);

if($stmt->execute()){
    header("Location: signup_success.html");
}else{
    if($mysqli->errno === 1062){
        die("email alredy taken");
    }
    else{
        die($mysqli->error . " " . $mysqli->errno);
    }
}

