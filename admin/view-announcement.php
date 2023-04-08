<?php
include "../app/connection.php";
include "../app/helper.php";
$msg = "";
$error = 0;

$id = $_GET['id'];
if ($id != "") {
    $status = $_GET['status'];
    if ($status != "") {
        //update query
        $upd = "UPDATE announcements SET status=$status WHERE id = $id";
        try {
            $conn->query($upd);
            $msg = "Status changed successfully";
        } catch (Exception $err) {
            $msg = "Unable to change the status";
            $error = 1;
        }
    } else {
        //delete query;
        $qry = "DELETE FROM announcements WHERE id = $id";
        // echo $qry;
        try {
            $conn->query($qry);
            $msg = "Data deleted successfully";
        } catch (Exception $err) {
            $msg = "Unable to delete the data";
            $error = 1;
        }
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
            <h6 class="m-0 font-weight-bold text-primary">View Annoucements</h6>
        </div>
        <div class="card-body">
            <?php
            // SELECT <columns> FROM <table_name> ORDER BY <col_name> DESC|ASC;
            // * -> all columns
            // "SELECT id,title FROM annoucements";
            $sel = "SELECT * FROM announcements ORDER BY id DESC";
            $result = $conn->query($sel);
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($data = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $data['title'] ?></td>
                            <td><?php echo $data['description'] ?></td>
                            <td><?php echo $data['created_at'] ?></td>
                            <td>
                                <?php
                                if ($data['status'] == 1) {
                                ?>
                                    <a href="view-announcement.php?id=<?php echo $data['id'] ?>&status=0">
                                        <button class="btn btn-primary">Active</button>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a href="view-announcement.php?id=<?php echo $data['id'] ?>&status=1">
                                        <button class="btn btn-warning">Inactive</button>
                                    </a>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a href="view-announcement.php?id=<?php echo $data['id'] ?>">
                                    <button class="btn btn-danger">Delete</button>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include "common/footer.php"; ?>