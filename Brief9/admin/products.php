<?php
session_start();

if (isset($_SESSION['username']) || isset($_SESSION['user'])) {

    $pagetitle = 'products';
    include "init.php"; // include init

    $do = isset($_GET['do']) ? $_GET['do'] : 'welcome';

    if ($do == 'welcome') {

        $stmt = $db->prepare("SELECT * FROM products");
        $stmt->execute(array());

        $rows = $stmt->fetchAll();

?>

        <div class="container product-container">
            <?php foreach ($rows as $row) {
            ?>
                <div class="product-parent-div">
                    <div class="product-div">
                        <div class="img-product">
                            <img src="layout/images/<?php echo $row['name'] ?>.png" alt="">
                        </div>
                        <div class="info-product">
                            <div class="details">
                                <div class="name-product">
                                    <h3><?php echo $row['name'] ?></h3>
                                </div>
                                <div class="description-product">
                                    <h6><?php echo $row['description'] ?></h6>
                                </div>
                            </div>
                            <div class="price-product">
                                <h4><?php echo $row['price'] ?> DH</h4>
                            </div>
                        </div>
                    </div>
                    <a href="" class="btn btn-success">Ajouter au panier</a>
                </div>
            <?php } ?>
        </div>

<?php

    } // elseif ($do == 'add') {

    // } elseif ($do == 'insert') {

    // } elseif ($do == 'edit') { // edit page 

    // } elseif ($do == 'update') {

    // } elseif ($do == 'delete') {

    // }
    include $tplDirName . "footer.php";
} else {
    header('location: index.php');
}
