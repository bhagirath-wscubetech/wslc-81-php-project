<?php
include "app/connection.php";
include "app/helper.php";
$pId = $_GET['pId'];
$res = [];
if (isset($_SESSION['user_id'])) {
    // add to cart 
    $userId = $_SESSION['user_id'];
    $selProd = "SELECT * FROM cart WHERE user_id = $userId AND product_id = $pId";
    $resProd = $conn->query($selProd);
    if ($resProd->num_rows != 0) {
        $data = $resProd->fetch_assoc();
        $newQty = $data['qty'] + 1;
        $cartId = $data['cart_id'];
        $qry = "UPDATE cart SET qty =$newQty WHERE cart_id = $cartId";
    } else {
        $qry = "INSERT INTO cart SET user_id = $userId, product_id = $pId";
    }
    try {
        $conn->query($qry);

        $sel = "SELECT * FROM cart WHERE user_id = $userId";
        $cartRes = $conn->query($sel);

        $res['message'] = 'Added to cart';
        $res['status'] = 1;
        $res['count'] = $cartRes->num_rows;
    } catch (Exception $err) {
        $res['message'] = 'Unable to add to cart';
        $res['status'] = 0;
    }
} else {
    $res['message'] = 'Please login first';
    $res['status'] = 0;
}
echo json_encode($res);
