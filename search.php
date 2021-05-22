<?php

session_start();

use Models\Item;

require './Models/Item.php';
spl_autoload_register();

if (!$_GET['query']) {
    header("Location:./");
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $query = $_GET['query'];

    $items = Item::getByName($query);
}

include './Templates/header.php';
include './Templates/message.php';
?>
<section class="hero hero-search-page">
    <div class="container">
        <div class="col-12">
            <div class="search">
                <form method="GET" action="./search.php">
                    <input class="input" type="text" name="query" placeholder="Search your favourite food">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
    <img src="./assets/images/hero-image.jpg" alt="">

</section><!-- .hero-->

<section id="=restaurant" class="p-4">
    <div class="container-fluid text-center">
        <div class="col-md-6 mx-auto p-2">
            <h2>Results for <?= ucwords($query) ?></h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php while ($item = $items->fetch_array()) {
                $item_name = $item['name'];
                $item_price = $item['price'];
                $item_name = $item['name'];
                $item_type = $item['type'];
                $item_restaurant = $item['restaurant_id'];
                $item_restaurant_name = $item['restaurant_name'];
            ?>
                <div class="col-md-3 col-sm-12 mb-3">
                    <div class="card" style="width: 18rem;">
                        <span class="badge bg-warning text-dark dish-type"><?= $item_type ?></span>
                        <img src="./assets/images/carousel/carousel-1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item_name ?></h5>
                            <span class="fs-5 text-info">Starts From ₹<?= $item_price ?>-</span>
                            <p class="card-text fs-5">Restaurant Name</p>
                            <a href="./menu.php?id=<?= $item_restaurant ?>" class="card-link btn btn-block btn-primary w-100">View
                                Menu</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php include './Templates/footer.php'; ?>