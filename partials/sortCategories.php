<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

// PRODUCT NAME SEARCH OPTION
$search_option = '';
if (isset($_GET['search'])) {
    $search_option = "WHERE name LIKE '%" . $_GET['search'] . "%'";
} else {
    $search_option = '';
}

// CATEGORY SEARCH
$category = $_GET['category'] ?? null;
var_dump($category);
if(!empty($_GET['category'])){
    $sql = "SELECT * FROM catalog 
            JOIN products ON catalog.id_product = products.id
            JOIN category ON catalog.id_category = category.id 
            WHERE category_name = '$category'";
}else{
    $sql = "SELECT * FROM catalog 
            JOIN products ON catalog.id_product = products.id
            JOIN category ON catalog.id_category = category.id 
            $search_option";
}

$res = $db->prepare($sql);


include_once($_SERVER['DOCUMENT_ROOT'] . '/partials/header.php');
?>

<section class="" id="">
        <div class="container">
            <div class="wrraper-content">
                <div class="intro-picture">

                    <div class="photos">
                        <img  class="header_picture" src="/assets/img/Liefes.png" alt="">
                        <img   src="/assets/img/forSlider1.png" alt="">
                        <img   src="/assets/img/forSlider2.jpg" alt="">
                    </div>

                    <div class="buttons">
                        <button class="prev">prev</button>
                        <button class="next">next</button>
                    </div>

                </div>
                <div class="header-pic">
                    <img  src="/assets/img/Frame 150.png" alt="">
                </div>
             </div>  <!--wrraper-content -->

             <div class="wrraper-choose">
                <div class="all-prod">
                    <h2>Our products.</h2>
                </div>
                <nav class="choose-prod">
                    <ul class="menu_list">
                        <li> <a href="/Seedra" class="forSort">Sort by price</a>
                        <span class="menu_arrow arrow"></span>
                            <ul class="sub-menu1">
                                <li>
                                <a  class="sort" href="index.php?sort_by=most_expensive">Most expensive</a>
                                </li>
                                <div class="v3"></div>
                                <li > <a class="sort" href="index.php?sort_by=most_chep">Most cheap</a> </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
             </div>

             <div class="our-prod">
                <ul class="main-menu">
                    <li><a href="/partials/sortCategories.php"><img src="/assets/img/liefs-chooce.png" >ALL</a></li>
                    <li><img src="/assets/img/bundles.png" alt=""><a href="#">BUNDLES</a>
                        <ul class="sub-menu">
                            <li><a class="sub-menu-link" href="/partials/sortCategories.php?category=ALL BUNDLES">ALL BUNDLES</a></li>
                            <div class="v3"></div>
                            <li><a class="sub-menu-link" href="/partials/sortCategories.php?category=BUNDLES VEGETABLES">BUNDLES VEGETABLES</a></li>
                        </ul>
                    </li>
                    <li><img src="/assets/img/heart.png" alt=""><a href="/partials/sortCategories.php?category=HERBS">HERBS</a>
                        <ul class="sub-menu">
                            <li><a class="sub-menu-link" href="/partials/sortCategories.php?category=ALL HERBS">ALL HERBS</a></li>
                            <div class="v3"></div>
                            <li><a class="sub-menu-link" href="/partials/sortCategories.php?category=BUNDLES HERBS">BUNDLES HERBS</a></li>
                        </ul>
                    </li>
                    <li><img src="/assets/img/vegetabless.png" alt="#"><a class="veg" href="/partials/sortCategories.php?category=VEGETABLES">VEGETABLES</a>
                        <ul class="sub-menu">
                            <li><a class="sub-menu-link" href="/partials/sortCategories.php?category=ALL VEGETABLES">ALL VEGETABLES</a></li>
                            <div class="v3"></div>
                            <li><a class="sub-menu-link" href="/partials/sortCategories.php?category=CART VEGETABLES">CART VEGETABLES</a></li>
                        </ul>
                    </li>
                    <li><img src="/assets/img/fruits.png" alt=""><a href="/partials/sortCategories.php?category=FRUITS">FRUITS</a>
                        <ul class="sub-menu">
                            <li><a class="sub-menu-link" href="/partials/sortCategories.php?category=ALL FRUITS">ALL FRUITS</a></li>
                            <div class="v3"></div>
                            <li><a class="sub-menu-link" href="/partials/sortCategories.php?category=CART FRUITS">CART FRUITS</a></li>
                        </ul>
                    </li>
                    <li><img src="/assets/img/gardening tool.png" alt=""><a href="/partials/sortCategories.php?category=SUPPLIES">SUPPLIES</a>
                        <ul class="sub-menu">
                            <li><a class="sub-menu-link" href="/partials/sortCategories.php?category=ALL SUPPLIES">ALL SUPPLIES</a></li>
                            <div class="v3"></div>
                            <li><a class="sub-menu-link" href="/partials/sortCategories.php?category=BUNDLES SUPPLIES">BUNDLES SUPPLIES</a></li>
                        </ul>
                    </li>
                    <li><img src="/assets/img/Flower (2).png" alt=""><a class="veg" href="/partials/sortCategories.php?category=FLOWERS">FLOWERS</a>
                        <ul class="sub-menu">
                            <li><a class="sub-menu-link" href="/partials/sortCategories.php?category=ALL FLOWERS">ALL FLOWERS</a></li>
                            <div class="v3"></div>
                            <li><a class="sub-menu-link" href="/partials/sortCategories.php?category=BUNDLES FLOWERS">BUNDLES FLOWERS</a></li>
                        </ul>
                    </li>
                </ul>
             </div>
             <div class="dateWhitBD">
        <?php


            $res->execute();

            if(isset($_GET['sort_by'])){
                if($_GET['sort_by'] == 'most_expensive'){
                    $sql = "SELECT * FROM catalog 
            JOIN products ON catalog.id_product = products.id
            JOIN category ON catalog.id_category = category.id ORDER BY price DESC";

                    $result = $db->prepare($sql);
                    $result->execute();

                }elseif($_GET['sort_by'] == 'most_chep'){
                    $sql = "SELECT * FROM catalog 
            JOIN products ON catalog.id_product = products.id
            JOIN category ON catalog.id_category = category.id ORDER BY price ";
                    $result = $db->prepare($sql);
                    $result->execute();
                }
            }
            $row = $res->fetchAll(PDO::FETCH_ASSOC);

            foreach ($row as $key => $value):?>

                <div class="products">
                    <form action="">
                        <div class="likePost">
                            <a href="/partials/like.php?id=<?= $value['id_product']; ?>"> <img src="/assets/img/<?= $value['imageLike']; ?>" alt=""></a>
                        </div>
                        <img src="/assets/img/<?php echo $value['img']; ?>" alt="">
                        <div class="products-title"><a href="#"><?php echo $value['name']; ?></a></div>
                        <div id="error_product" class="error_product<?= json_encode($value['id_product']); ?>"></div>
                        <div class="products-but-price">
                            <div class="price"><?php echo $value['price']; ?>$</div>
                            <div>
                                <button id="addToCart_<?php echo $value['id_product']; ?>"
                                 class="buy" onclick="addToCart(<?= $value['id_product']; ?>); return false">
                                 Buy Now
                            </button>
                            </div>
                        </div>
                    </form>
                </div>

        <?php endforeach; ?>

             </div>
             <div class="grow-fast">
                <div class="rew">
                    <h2>Seedra helps to grow fast and efficiant</h2>
                    <p>
                         SEEDRA Spinach Seeds - contains 600 seeds in 2 Packs and professional instructions created by PhD Helga George
                        <p class="p1">
                            Be sure of our quality - the freshest batches of this season. Non-GMO, Heirloom - our seeds were tested and have the best germination ratings.
                            Your easy growing experience is our guarantee
                            Spinach commom culinary uses: salads, soups, smoothies, lasagne, pizza, pies, risotto, and more
                        </p>

                        <p class="p1">
                            Proudly sourced in the USA - our garden seeds are grown, harvested, and packaged in the USA. We support local farmers and are happy to produce this American-made product
                        </p>

                </div>
                <div class="pictureW">
                    <img src="/assets/img/Ellipse 2.png" alt="">
                </div>
             </div>


            <div class="clients">
                <div class="review">
                    <h2 class="prev_review">What out clients say</h2>



                    <div class="rev_slider">
                            <?php
                            $sql = "SELECT reviews.*, users.user AS username FROM reviews 
                            JOIN users ON reviews.id_user = users.id ORDER BY td_add DESC LIMIT 5";

                            $allReviews = $db->prepare($sql);
                            $allReviews->execute();
                            $posts = $allReviews->fetchAll(PDO::FETCH_ASSOC); ?>
                            <?php foreach ($posts as $post): ?>


                                <div class="slider_p">
                                    <div class="for_av">
                                        <div class="photo" style="background-image: url('/assets/img/avatar.png');"></div>
                                        <div class="nickname"><?= $post['username']?></div>
                                        <div class="post_time"><?= $post['td_add']?></div>
                                    </div>

                                    <div class="cnt_likes" style="background-image: url('/assets/img/rev_like.png');"></div>
                                    <div class="review_ps"><?= $post['text']?></div>
                                </div>


                            <?php endforeach; ?>
                    </div>

<!--                            <div class="line_next">-->
<!--                                <button class="prev_post"><div class="review_slider"></div></button>-->
<!--                                <button ><div class="review_slider"></div></button>-->
<!--                                <button class="next_post"><div class="review_slider"></div></button>-->
<!--                            </div>-->



                    <?php
                        // Додавання коментарів , якщо користувач авторізувався
                        if(isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])){?>

                        <?php
                            $sessionUser = isset($_SESSION['user_id']);

                            $cookieUser = isset($_COOKIE['user_id']);

                            $nameUser = $sessionUser ?: $cookieUser;

                        $sql = "SELECT user FROM users WHERE id = $nameUser";
                        $res = $db->prepare($sql);
                        $res->execute();
                        $row_user = $res->fetch();
                        // дод коментарів в базу  $row_user['user']
                    ?>
    <form class="formForReview" method="post">

    <h3 class="userr">Name: </h3>
    <textarea id="text_review" name="text_review" type="text" ></textarea><br>
    <input  class="buttonForReview" type="submit" value="Add Review" onclick="writeReview(); return false";>
    <div class="error-mess" id="error-block"></div>

    </form>
    <?php } else{
        echo "<p class='comment' style='color: green; text-align: center; margin-top: 10px; margin-left: -50px'>
            Для того, щоб написати коментарій, зареєструйтесь.
        </p>";
     }?>
        </div>
    </div>
  </div> <!--container -->
    </section>

<!--scroll Top -->
<div id="scrollTop" class="isShowBtn isShowBtn_hide">
    <i class="fa-solid fa-arrow-up"></i>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php');
