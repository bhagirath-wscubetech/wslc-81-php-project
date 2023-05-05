<section class="item-category-area section-gap ">
    <div class="container ">
        <div class="row d-flex justify-content-center ">
            <div class="col-md-12 pb-80 header-text text-center ">
                <h1 class="pb-10 ">Category of available items</h1>
                <p>
                    They are grilling celebrities in their own right.
                </p>
            </div>
        </div>
        <div class="row">
            <?php
            $selCat = "SELECT * FROM categories WHERE status = 1";
            $resCat = $conn->query($selCat);
            $totalRows = $resCat->num_rows;
            while ($catData = $resCat->fetch_assoc()) {
            ?>
                <div class="col-lg-3 col-md-6 ">
                    <div class="single-cat-item ">
                        <div class="thumb ">
                            <img class="img-fluid " src="img/category/<?php echo $catData['image'] ?> " alt=" ">
                        </div>
                        <a href="menu.php?cid=<?php echo $catData['id'] ?>">
                            <h4><?php echo $catData['name'] ?></h4>
                        </a>
                        <p>
                            <?php echo $catData['description'] ?>
                        </p>
                    </div>
                </div>
                <?php
            }
            if ($totalRows < 4) {
                $remaining = 4 - $totalRows;
                // echo $remaining;
                for ($i = 1; $i <= $remaining; $i++) {
                ?>
                    <div class="col-lg-3 col-md-6 "></div>
            <?php
                }
            }
            ?>
            <a class="primary-btn mx-auto mt-80 " href="# ">View Full Menu</a>
        </div>
    </div>
</section>