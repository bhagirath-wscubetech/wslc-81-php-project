<?php
include "../app/connection.php";
include "../app/helper.php";
$msg = "";
$error = 0;
// 0 no error; 1 error
$id = $_GET['id'];

if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    if ($title != "" && $description != "") {
        if ($id != "") {
            //update
            $qry = "UPDATE announcements SET title = '$title', description = '$description' WHERE id = $id";
        } else {
            // insert
            $qry = "INSERT INTO announcements SET title = '$title', description = '$description'";
        }
        try {
            if ($conn->query($qry) == true) {
                //$msg = "Data added successfully";
                header("LOCATION:view-announcement.php");
            }
        } catch (Exception $err) {
            if ($id != "") {
                $msg = "Unable to update the data";
            } else {
                $msg = "Unable to add the data";
            }
            $error = 1;
        }
    } else {
        $msg = "Please enter all the required data";
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
                <?php echo $id == '' ? 'Add' : 'Update' ?> Annoucement
            </h6>
        </div>
        <?php
        if ($id != "") {
            $sel = "SELECT * FROM announcements WHERE id = $id";
            $result = $conn->query($sel);
            $data = $result->fetch_assoc();
            // p($data);
        }
        ?>
        <div class="card-body">
            <form action="" method="post">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Please enter title here" value="<?php echo $data['title'] ?>">
                    </div>
                    <div class="col-12 my-3">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" id="" rows="5"><?php echo $data['description'] ?></textarea>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" name="save">
                            <?php echo $id == '' ? 'Add' : 'Update' ?>
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