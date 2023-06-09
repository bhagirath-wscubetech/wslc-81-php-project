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
    if ($image['name'] != "") {
        $imageName = rand(1000, 1000000) . time() . $image['name'];
        $destination = "../img/category/" . $imageName;
        $tmpPath =  $image['tmp_name'];
    } else if ($id != "") {
        $imageName = $_POST['img_name'];
    }
    try {
        if ($id != "") {
            if ($image != "") {
                if (move_uploaded_file($tmpPath, $destination) == true) {
                    $oldImageName = $_POST['img_name'];
                    unlink("../img/category/$oldImageName");
                }
            }
            $qry = "UPDATE categories SET name = '$name', description='$description',image='$imageName' WHERE id = $id";
            $conn->query($qry);
            header('LOCATION:view-category.php');
        } else {
            if (move_uploaded_file($tmpPath, $destination) == true) {
                $qry = "INSERT INTO categories SET name = '$name', description='$description',image='$imageName'";
                $conn->query($qry);
                header('LOCATION:view-category.php');
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
                <?php echo $id != "" ? 'Update' : 'Add' ?> Category
            </h6>
        </div>
        <?php
        if ($id != "") {
            $sel = "SELECT * FROM categories WHERE id = $id";
            $result = $conn->query($sel);
            $data = $result->fetch_assoc();
        }
        ?>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Please enter categroy name here" value="<?php echo $data['name'] ?>">
                    </div>
                    <div class="col-12 my-3">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" id="desc_editor" rows="5"><?php echo $data['description'] ?></textarea>
                    </div>
                    <div class="col-12 my-3">
                        <label for="">Image</label>
                        <input type="file" name="image" id="" class="dropify" data-default-file="../img/category/<?php echo $data['image'] ?>">
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