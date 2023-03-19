<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');
?>

<?php

require($_SERVER['DOCUMENT_ROOT'] . '/partials/header.php');
?>

<?php
/*
1)get приймати гет айді
2) створити сесію лфки та додати в сесіонний масив айді
3) розбиваємо маси сепаратором в строку та  створюємо пошук по даному списку айді в табліці та виводимо
 */

 ?>

    <section class="section-cart">
        <header class="section-cart__header">
            <div class="container">
                <h1 class="title-1">Мій список бажань</h1>
            </div>
        </header>
        <div class="section-cart_body">
            <div class="container1">

                    <?php

                    if (isset($_SESSION['like']) && !empty($_SESSION['like'])):?>

                    <?php
                        $likes = $_SESSION['like'];
                        $countStrLikes = implode(',', $likes);
                        //var_dump($countStrLikes);
                    $sql = "SELECT id_product FROM likes
                    JOIN users ON likes.id_user = users.id
                    JOIN products ON likes.id_product = products.id";

                    $result = $db->prepare($sql);
                    $result->execute();
                   $likes = $result->fetchAll();

                   $like = [];
                        foreach($likes as $item){
                            $like[] = $item['id_product'];
                        }
                        $liy = implode(',', $like);
 
                    $sql = "SELECT * FROM catalog 
                    JOIN products ON catalog.id_product = products.id
                    WHERE products.id IN($liy)";
                    $res = $db->prepare($sql);
                    $res->execute();
                    $likeResult = $res->fetchAll();

                   foreach ($likeResult as $key => $like):?>
                            <section class="product" id="product<?php echo $like['id'] ?>">

                                <div class="product__img">
                                    <img src="/assets/img/<?= $like['img'] ?>">
                                </div>

                            </section>
                            <?php endforeach; ?>

                        <footer class="cart-footer">
                            <div class="c"><a href="/partials/cart.php" style="cursor: pointer;" name="submit" type="submit" class="footer__order" value="Перейти в корзину">Перейти в корзину</a></div>
                            <div class="cart-footer__count"><?= count($_SESSION['like']) ?></div>
                        </footer>
                    <div id="restart">
                        <?php endif; ?>
            </div>

        </div>
        </div>
    </section>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php');
?>