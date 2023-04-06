<?php
include "../app/connection.php";
include "../app/helper.php";
$msg = "";
$error = 0;
// 0 no error; 1 error

if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    if ($title != "" && $description != "") {
        $qry = "INSERT INTO announcements SET title = '$title', description = '$description'";
        try {
            if ($conn->query($qry) == true) {
                $msg = "Data added successfully";
            }
        } catch (Exception $err) {
            $msg = "Unable to add the data";
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
            <h6 class="m-0 font-weight-bold text-primary">Add Annoucement</h6>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Please enter title here">
                    </div>
                    <div class="col-12 my-3">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" id="" rows="5"></textarea>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" name="save">Add</button>
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