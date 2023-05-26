<?php
include "app/connection.php";
include "app/helper.php";
error_reporting(E_ALL);
$cid = $_GET['cid'];
$proSel = "SELECT * FROM products WHERE category_id = $cid AND status = 1";
$proRes = $conn->query($proSel);
if ($proRes->num_rows == 0) {
    echo "<h2 class='text-center'> No Product Found </h2>";
} else {
    while ($proData = $proRes->fetch_assoc()) {
?>
        <div class="tab-pane fade show active" id="pizza" role="tabpanel" aria-labelledby="pizza-tab">
            <div class="single-menu-list row justify-content-between align-items-center">
                <div class="col-lg-9">
                    <a href="product-details.php?pid=<?php echo $proData['product_id'] ?>">
                        <h4><?php echo $proData['product_name'] ?></h4>
                        <!-- CTRL + SHIFT + $ -->
                    </a>
                    <p>
                        <?php echo $proData['description'] ?>
                    </p>
                </div>
                <div class="col-lg-3 flex-row d-flex price-size">
                    <img src="img/product/<?php echo $proData['image'] ?>" width="150" alt="">
                </div>
            </div>
        </div>
<?php
    }
}
?>