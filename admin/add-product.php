<?php
include "../app/connection.php";
include "../app/helper.php";
$msg = "";
$error = 0;
$id = $_GET['id'];
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image'];
    $o_price = $_POST['o_price'];
    $d_price = $_POST['d_price'];
    $category_id = $_POST['category_id'];
    if ($image['name'] != "") {
        $imageName = rand(1000, 1000000) . time() . $image['name'];
        $destination = "../img/product/" . $imageName;
        $tmpPath =  $image['tmp_name'];
    } else if ($id != "") {
        $imageName = $_POST['img_name'];
    }
    try {
        if ($id != "") {
            if ($image != "") {
                if (move_uploaded_file($tmpPath, $destination) == true) {
                    $oldImageName = $_POST['img_name'];
                    unlink("../img/product/$oldImageName");
                }
            }
            $qry = "UPDATE products SET product_name = '$name', description='$description',image='$imageName', 
            original_price = $o_price, discounted_price = $d_price, category_id = $category_id WHERE product_id = $id";
            $conn->query($qry);
            header('LOCATION:view-product.php');
        } else {
            if (move_uploaded_file($tmpPath, $destination) == true) {
                $qry = "INSERT INTO products 
                SET product_name = '$name', description='$description',image='$imageName', 
                original_price = $o_price, discounted_price = $d_price, category_id = $category_id
                ";
                $conn->query($qry);
                header('LOCATION:view-product.php');
            } else {
                $msg = "Unable to upload the image";
                $error = 1;
            }
        }
    } catch (Exception $err) {
        $msg = "Internal server error";
        $error = 1;
    }
}

include "common/header.php";
?>
<!-- Content Wrapper -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <h4 class="text-center my-2 <?php echo $error == 1 ? 'text-danger' : 'text-success'  ?>">
        <?php echo $msg ?>
    </h4>
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                <?php echo $id != "" ? 'Update' : 'Add' ?> Product
            </h6>
        </div>
        <?php
        if ($id != "") {
            $sel = "SELECT * FROM products WHERE product_id = $id";
            $result = $conn->query($sel);
            $data = $result->fetch_assoc();
        }
        ?>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Please enter product name here" value="<?php echo $data['name'] ?>">
                    </div>
                    <div class="col-12 my-3">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" id="desc_editor" rows="5"><?php echo $data['description'] ?></textarea>
                    </div>
                    <div class="col-4 my-3">
                        <label for="">Category</label>
                        <?php
                        $selCat = "SELECT * FROM categories";
                        $resCat = $conn->query($selCat)
                        ?>
                        <select name="category_id" id="" class="form-control">
                            <option value="0">Select a category</option>
                            <?php
                            while ($catData = $resCat->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $catData['id'] ?>" <?php echo $catData['id'] ==  $data['category_id'] ? 'selected' : '' ?>>
                                    <?php echo $catData['name'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="img_name" value="<?php echo $data['image'] ?>">
                    <div class="col-4 my-3">
                        <label for="">Original Price</label>
                        <input type="number" name="o_price" min="1" max="9999.99" step="0.01" class="form-control" id="o_price" value="<?php echo $data['original_price'] ?>">
                    </div>
                    <div class="col-4 my-3">
                        <label for="">Discounted Price</label>
                        <input type="number" name="d_price" id="d_price" min="1" step="0.01" class="form-control" <?php echo $id == "" ? "disabled" : "" ?> placeholder="Please enter original price first" max="<?php echo $data['original_price'] - 1 ?>" value="<?php echo $data['discounted_price'] ?>">
                    </div>
                    <div class="col-12 my-3">
                        <label for="">Image</label>
                        <input type="file" name="image" id="" class="dropify" data-default-file="../img/product/<?php echo $data['image'] ?>">
                    </div>
                    <input type="hidden" name="img_name" value="<?php echo $data['image'] ?>">

                    <div class="col-12">
                        <button class="btn btn-primary" name="save">
                            <?php echo $id != "" ? 'Update' : 'Add' ?>
                        </button>
                        <button class="btn btn-warning">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include "common/footer.php"; ?>
<script>
    ClassicEditor
        .create(document.querySelector('#desc_editor'))
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    $("#o_price").change(
        function() {
            var oPrice = $(this).val();
            if (oPrice != "" && oPrice > 1) {
                $("#d_price").prop('disabled', false);
                $("#d_price").attr("max", oPrice - 1);
            } else {
                $("#d_price").prop('disabled', true);
            }
        }
    )
</script>