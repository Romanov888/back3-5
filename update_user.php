<?php
session_start();
 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
 
$servername = "localhost";
$username = "u52981";
$password = "6580876";
$dbname = "u52981";
 
//
try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
 
$user_id = $_SESSION['user_id'];
 
// 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $birth_year = $_POST['birth_year'];
    $gender = $_POST['gender'];
    $bio = $_POST['bio'];
    $contract = 1;
 
    $stmt = $db->prepare("UPDATE users SET name = ?, email = ?, birth_year = ?, gender = ?, bio = ?, contract = ? WHERE id = ?");
    $stmt->execute([$name, $email, $birth_year, $gender, $bio, $contract, $user_id]);
 
    header("Location: userinfo.php");
    exit();
}
?>