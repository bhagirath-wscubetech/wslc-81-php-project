<?php
include "../app/connection.php";
include "../app/helper.php";

$limit = 5;
$page = $_GET['page'] ?? 0; // 3
$start = $page * $limit;

// start = 0 x 5; = 0


$msg = "";
$error = 0;
$id = $_GET['id'];
if ($id != "") {
    $newStatus = $_GET['newstatus'];
    if ($newStatus != "") {
        $upd = "UPDATE countries SET status = $newStatus WHERE country_id = $id";
        try {
            $conn->query($upd);
            $msg = "Status changed successfully";
            $error = 0;
        } catch (Exception $err) {
            $msg = "Unable to change the status";
            $error = 1;
        }
    } else {
        $imgName = $_GET['img'];
        $del = "DELETE FROM countries WHERE country_id = $id";
        try {
            $msg = "Data deleted";
            $error = 0; // no error
        } catch (Exception $err) {
            $msg = "Unable to delete the data";
            $error = 1; // some error is there
        }
    }
}

$query = $_GET['query'];

include "common/header.php";
?>
<!-- Content Wrapper -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <h4 class="text-center my-2 <?php echo $error == 1 ? 'text-danger' : 'text-success'  ?>">
        <?php echo $msg ?>
    </h4>
    <form method="get" class="bg-white p-3 my-2">
        <div class="row">
            <div class="col-9">
                <input type="text" name="query" value="<?php echo $query; ?>" class="form-control" placeholder="Search your data here...">
            </div>
            <div class="col-3">
                <button class="btn btn-primary" name="search" type="submit">Search</button>
                <a href="view-country.php">
                    <button class="btn btn-danger" type="button">Clear</button>
                </a>
            </div>
        </div>
    </form>
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">View countries</h6>
        </div>
        <div class="card-body">
            <?php
            if ($query != "") {
                $sel = "SELECT * FROM countries WHERE country_name LIKE '%$query%' ORDER BY country_id DESC";
            } else {
                $sel = "SELECT * FROM countries ORDER BY country_id DESC LIMIT $start,$limit";
                echo   $sel;
            }
            $result = $conn->query($sel);
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Name</th>
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
                            <td><?php echo $data['country_name'] ?></td>
                            <td>
                                <?php
                                if ($data['status'] == 1) {
                                ?>
                                    <!-- active -->
                                    <a href="view-country.php?id=<?php echo $data['country_id'] ?>&newstatus=0">
                                        <button class="btn btn-primary">Active</button>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <!-- inactive -->
                                    <a href="view-country.php?id=<?php echo $data['country_id'] ?>&newstatus=1"><button class="btn btn-warning">Inactive</button></a>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <!-- <a href="view-country.php?id=<?php echo $data['country_id'] ?>&img=<?php echo $data['image'] ?>"> -->
                                <button class="btn btn-danger" onclick="delImage(<?php echo $data['country_id'] ?>)">Delete</button>
                                <!-- </a> -->
                                <!-- edit button -->
                                <a href="add-country.php?id=<?php echo $data['country_id'] ?>"><button class="btn btn-secondary">Edit</button></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
            $selAll = "SELECT * FROM countries";
            $exeAll = $conn->query($selAll);
            $total = $exeAll->num_rows;
            $noOfPage = ceil($total / $limit);
            ?>
            <div class="row">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        for ($i = 0; $i < $noOfPage; $i++) :
                        ?>
                            <li class="page-item <?php echo $i == $page ? 'active' : '' ?>" aria-current="page">
                                <a class="page-link" href="view-country.php?page=<?php echo $i ?>">
                                    <?php echo $i + 1; ?>
                                </a>
                            </li>
                        <?php
                        endfor;
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include "common/footer.php"; ?>