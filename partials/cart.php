
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/partials/header.php');
//include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/CartController.php');
/*
 * 1 При запросе к корзине в скрытых input-ах присылаешь клиенту из базы значения минимума и максимума количества товаров
 * и прочую актуальную на момент покупки инфу.
2 На html странице скрипт изменяет значения + и - с проверкой на минимум и максимум без обращения к серверу.
3 Жмешь submit а на сервере проверяешь timeout работы с корзиной, берешь из базы актуальные минимум и максимум 
и снова проверяешь, пишешь результат в базу и обновляешь количество на складе в базе и отправляешь клиенту html окно с подтверждением*/
?>

<section class="section-cart">
    <header class="section-cart__header">
        <div class="container">
            <h1 class="title-1">Корзина товарів</h1>
        </div>
    </header>
    <div class="section-cart_body">
        <div class="container1">

            <section class="cart">


                <header class="cart-header">
                    <div class="cart-header__title">Назва</div>
                    <div class="cart-header__count">Кількість</div>
                    <div class="cart-header__cost">Вартість</div>
                    <div class="cart-total">Вартість елементів</div>
                </header>

            <?php
            $done = false;
            $error = false;
            $order = false;
            if (isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])){
                include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');



                $sql = "SELECT id_product FROM cart";
                $res = $db->prepare($sql);
                $res->execute();
                $keysWthisDb = $res->fetchAll();

                $keys_of_products = [];
                foreach ($keysWthisDb as $key => $item){
                    $keys_of_products[] = $item['id_product'];
                }

                $_SESSION['cart'] = $keys_of_products;
                $itProducts = $_SESSION['cart'];

                $str = implode(',', $itProducts);
                if ($str){
                    $sql = "SELECT * FROM catalog 
                    JOIN products ON catalog.id_product = products.id
                    JOIN category ON catalog.id_category = category.id WHERE products.id IN($str)";

                    $result = $db->prepare($sql);
                    $result->execute();
                    $row = $result->fetchAll();
                    $done = true;
                    $order = true;
                }else{
                    $error = true;
                }

            }else{
            // для не авторізованих користувачів
                $itProducts = [];
                if(isset($_SESSION['cart'])){
                    $itProducts = $_SESSION['cart'];
                }else{
                    $error = true;
                }

                $done = '';
                $error = '';

                $str = implode(',', $itProducts) ?? null;

                if ($str){
                    $sql = "SELECT * FROM catalog 
                    JOIN products ON catalog.id_product = products.id
                    JOIN category ON catalog.id_category = category.id 
                    WHERE products.id IN($str)";

                    $result = $db->prepare($sql);
                    $result->execute();
                    $row = $result->fetchAll();
                    $order = true;
                    $done = true;
                }else{
                    $error = true;
                }

            }?>

             <?php

                if(!empty($done)){
                    foreach ($row as $key => $cartProducts):?>
                    <section class="product" id="product<?php echo $cartProducts['id_product'] ?>">

                        <div class="product__img">
                            <img src="/assets/img/<?= $cartProducts['img'] ?>">
                        </div>
                        <div class="product__title">
                            <?= $cartProducts['name'] ?>
                        </div>

                        <div class="product__count">

                            <div class="count">

                                <div class="count__box">
                                    <input type="number" id="count__input<?= $cartProducts['id_product'] ?>" class="count__input" min="1" name="count_products<?= $cartProducts['id_product'] ?>" max="50" step="1" value="1" onchange="conversionPrice(<?= $cartProducts['id_product'] ?>)">
                                </div>
                                <div class="count__controls">
                                    <button type="button" id="increment" class="count__up" onclick="stepper(this, <?= $cartProducts['id_product'] ?>)"><!-- передаємо додатковий параметер id продукта -->
                                        <img src="/assets/img/count_up.svg" alt="increase">
                                    </button>
                                    <button type="button" id="decrement" class="count__down" onclick="stepper(this, <?= $cartProducts['id_product'] ?>)" ;>
                                        <img src="/assets/img/count_down.svg" alt="decrease">
                                    </button>
                                </div>

                            </div>

                        </div>

                        <div class="product__price<?= $cartProducts['id_product'] ?>">
                                <span class="itemPrice" id="itemPrice_<?= $cartProducts['id_product'] ?>" value="<?= $cartProducts['price'] ?>">
                                    <?= $cartProducts['price'] ?>$
                                </span>
                        </div>
                        <!--ВАРТІСТЬ ОДНОГО ТОВАРА З РАХУНКОМ КІЛЬКОСТІ ТОВАРУ -->
                        <div class="product__total-price<?= $cartProducts['id_product'] ?>">
                                <span class="itemTotalPrice" id="itemTotalPrice_<?= $cartProducts['id_product'] ?>" value="<?= $cartProducts['price'] ?>">
                                    <?= $cartProducts['price'] ?>$
                                </span>
                        </div>
                        <div class="product__controls">
                            <button type="button">
                                <img src="/assets/img/x.svg" class="btn_delete" id="delete_id<?= $cartProducts['id_product']; ?>" onclick='deleteProduct(this, <?= $cartProducts['id_product']; ?>)' alt="Видалення з корзини"><!-- onclick='deleteProduct( $cartProducts['id_product']; ?>)'-->
                            </button>
                        </div>
                    </section>

                    <?php endforeach; ?>
                <?php } ?>
                <footer class="cart-footer">
                 <?php
                    if($order){
                        $id_products_cart = implode(',', $_SESSION['cart']);

                         // Вивід кількості товарів
                         $sql = "SELECT COUNT(id_product) FROM catalog 
                        JOIN products ON catalog.id_product = products.id WHERE products.id IN($id_products_cart)";
                         $result = $db->prepare($sql);
                         $result->execute();
                         $count = $result->fetchAll();

                        // Вивід загальної суми товарів в корзині
                        $sql = "SELECT SUM(price) FROM catalog 
                        JOIN products ON catalog.id_product = products.id WHERE products.id IN($id_products_cart)";
                        $result = $db->prepare($sql);
                        $result->execute();
                        $sum = $result->fetchAll();

                        $sessionUser = isset($_SESSION['user_id']) && $_SESSION['user_id'] != null;
                        $cookieUser = isset($_COOKIE['user_id']) && $_COOKIE['user_id'] != null;
                        if($sessionUser || $cookieUser):


                        $user_id =  $sessionUser ?? $cookieUser;

                        $arrayOfProducts = implode(',', $_SESSION['cart']);
                        $quantity =$count[0]['COUNT(id_product)'];
                        $order_sum = ROUND($sum[0]['SUM(price)'], 2);

                        if(isset($_POST['submit']) == 'Order') {
                            $sql = "INSERT INTO `user_order` (id_user, id_product, order_sum) VALUES (:id_user, :id_product, :order_sum)";
                            $orderResult = $db->prepare($sql);
                            $param =['id_user' => $user_id, 'id_product' => $arrayOfProducts,  'order_sum' => $order_sum];

                            if($orderResult->execute($param)) {
                                echo '<script>alert("Order successful")</script>';
                                $_SESSION['cart'] = null;
                                exit();
                            } else {
                                echo "Замовлення НЕ додано";
                            }
                        }

                 ?>

                   <?php endif; ?>
                    <div class="c">
                        <form method="POST" >
                            <input style="cursor: pointer;" name="submit" type="submit" class="footer__order" value="Order" onclick='order(); return false'>
                        </form></div>

                   <?php }?>

                    <div class="cart-footer__count" id="all_count"><?// isset($_SESSION['cart']) ? count(array_keys($_SESSION['cart'])) : null ?></div>
                    <div class="cart-footer__price" id="all_price"><?// ROUND($sum[0]['SUM(price)'], 2) ?></div>
                </footer>
        <?php if ($error):?>
                <div id="restart">
            </section>
            <h3  class="empty_cart" style="text-align: center; font-size: 20px; color: coral; margin: 30px 0;">Your cart is empty</h3>
            <footer class="cart-footer" id="else">
                <div class="cart-footer__count">0</div>
                <div class="cart-footer__price">0$</div>
            </footer>
        <?php endif; ?>
                </div>

        </div>
    </div>
</section>
<script>
    function conversionPrice(id) {
        // звертаємося до елемента #itemCnt_ і беремо значення поля value
        let newCnt = $(`#count__input${id}`).val();
        console.log(newCnt);
        let itemPrice = $(`#itemPrice_${id}`).attr('value');
        console.log(itemPrice);
        let itemRealPrice = newCnt * itemPrice;
        console.log(itemRealPrice)
        // // вивід заміна кода в полі
        $('#all_price' + id).text(itemRealPrice + '$');
    }
</script>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php');  ?>

