<?php
include "app/connection.php";
include "app/helper.php";
$pageTitle = "Cart Page";
include "common/header.php";
?>

<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Cart
                </h1>
                <p class="text-white link-nav"><a href="index.php">Home </a> <span class="lnr lnr-arrow-right"></span> <a href="menu.php"> Cart</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- Start menu-list Area -->
<section class="menu-list-area section-gap">
    <div class="container bg-white p-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $userId = $_SESSION['user_id'];
                if (isset($userId)) {
                    $selUserCart = "SELECT * FROM cart LEFT JOIN products ON products.product_id = cart.product_id WHERE user_id = $userId";
                    $resUserCart = $conn->query($selUserCart);
                    $sr = 1;
                    while ($dataUserCart = $resUserCart->fetch_assoc()) {
                        // p($dataUserCart);
                        $itemPrice = $dataUserCart['discounted_price'] == 0 ? $dataUserCart['original_price'] : $dataUserCart['discounted_price'];
                ?>
                        <tr>
                            <td><?php echo $sr++ ?></td>
                            <td><?php echo $dataUserCart['product_name'] ?></td>
                            <td><img src="img/product/<?php echo $dataUserCart['image'] ?>" alt="" width="100"></td>
                            <td>₹ <?php echo $itemPrice ?></td>
                            <td>
                                <button class="btn">-</button>
                                <input type="text" style="width: 50px;text-align:center" value="<?php echo $dataUserCart['qty'] ?>">
                                <button class="btn">+</button>
                            </td>
                            <td>
                                ₹ <?php echo $itemPrice * $dataUserCart['qty']; ?>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</section>
<?php
include "common/footer.php";
?>