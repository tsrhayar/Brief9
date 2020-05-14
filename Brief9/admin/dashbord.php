<?php
session_start();

if (isset($_SESSION['username'])) {
    $pagetitle = 'Dashbord';
    include "init.php"; // include init 



?>
    <div class="container text-center">
        <h1>This is dashbord page</h1>
        <div class="blank"></div>
        <div class="container dashbord-table">
            <div>
                <h5>Management <br>des membres</h5>
                <a href="members.php"><?php echo nmbrItms("userID", "users"); ?></a>
            </div>
            <div>
                <h5>Management <br>des produits</h5>
                <a href="manageproducts.php"><?php echo nmbrItms("id", "products"); ?></a>
            </div>
        </div>
        <div class="blank"></div>
        <div>

        </div>
    </div>

<?php
    include $tplDirName . "footer.php";
} elseif (isset($_SESSION['username'])) {

    header('location: products.php');
}else {
    header('location: index.php');
}
