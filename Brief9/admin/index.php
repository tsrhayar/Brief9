<?php
session_start(); // ouvrir une session
$noNavBar = '';
$pagetitle = "Home";
if (isset($_SESSION['username'])) { // si il y'a une session ouvert
    header('location: dashbord.php'); // redirect vers la page dashbord
    exit();
} elseif (isset($_SESSION['user'])) {
    header('location: products.php');
    exit();
}

include "init.php"; // include init

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // si la methode de la formulaire est POST

    $username = $_POST['user'];
    $password = $_POST['pass'];
    $shapassword = sha1($password);

    $stmt = $db->prepare("SELECT userID, username, password FROM users WHERE username = ? AND password = ? AND groupeID = 1");
    $stmt->execute(array($username, $shapassword));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();

    if ($count > 0) {
        $_SESSION['username'] = $username; // SESSION USERNAME
        $_SESSION['id'] = $row['userID']; // SESSION ID
        header('location: dashbord.php'); // REDIRECT VERS PAGE DASHBORD
        exit();
    } 

    $stmt2 = $db->prepare("SELECT userID, username, password FROM users WHERE username = ? AND password = ? AND groupeID = 0");
    $stmt2->execute(array($username, $shapassword));
    $row2 = $stmt2->fetch();
    $count2 = $stmt2->rowCount();

    if ($count2 > 0) {
        $_SESSION['user'] = $username; // SESSION USERNAME
        $_SESSION['id'] = $row['userID']; // SESSION ID
        header('location: products.php'); // REDIRECT VERS PAGE DASHBORD
        exit();
    }
}

?>


<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <h4 class="text-center">Admin Login</h4>
    <input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off">
    <input class="form-control" type="text" name="pass" placeholder="Password" autocomplete="new-password">
    <input type="submit" class="btn btn-primary btn-block" value="login">
    <a href="sign-up.php">S'inscrire sur notre site</a>
</form>


<?php include $tplDirName . "footer.php"; // include la page (footer) 
?>