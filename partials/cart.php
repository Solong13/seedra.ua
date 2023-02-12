
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/partials/header.php');
//include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/CartController.php');

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
                </header>

            <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])){

                include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');
                $itProducts = $_SESSION['cart'];

                print_r($itProducts);

                $str = implode(',', $itProducts);
                $sql = "SELECT * FROM catalog 
                JOIN products ON catalog.id_product = products.id
                JOIN category ON catalog.id_category = category.id WHERE products.id IN($str)";

                $result = $db->prepare($sql);
                $result->execute();
                $row = $result->fetchAll();

                foreach ($row as $key => $cartProducts):?>

                <section class="product" id="product<?php echo $cartProducts['id'] ?>">

                    <div class="product__img">
                        <img src="/assets/img/<?= $cartProducts['img'] ?>">
                    </div>
                    <div class="product__title">
                        <?= $cartProducts['name'] ?>
                    </div>

                    <div class="product__count">

                        <div class="count">
                           
                        <div class="count__box">
                                <input type="number"  id="count__input<?= $cartProducts['id'] ?>" class="count__input" min="1"
                                       name="count_products<?= $cartProducts['id'] ?>" max="50"  step="1" value="1"
                                       onchange="conversionPrice(<?= $cartProducts['id'] ?>)" >
                            </div>
                            <div class="count__controls">
                                <button type="button" id="increment"   class="count__up"  onclick="stepper(this)">
                                    <img src="/assets/img/count_up.svg" alt="increase">
                                </button>
                                <button type="button" id="decrement"  class="count__down" onclick="stepper(this)";>
                                    <img src="/assets/img/count_down.svg" alt="decrease">
                                </button>
                            </div>

                        </div>

                    </div>

                    <div class="product__price<?= $cartProducts['id'] ?>">
                        <span id="itemPrice_<?= $cartProducts['id'] ?>" value="<?= $cartProducts['price'] ?>">
                            <?= $cartProducts['price'] ?>$
                        </span>
                    </div>
                    <div class="product__controls">
                        <button type="button">
                            <img src="/assets/img/x.svg" id="delete_id<?= $cartProducts['id']; ?>" onclick='deleteProduct(<?=  $cartProducts['id']; ?>)' alt="Видалення з корзини">
                        </button>
                    </div>
                </section>

            <?php endforeach; ?>

                <footer class="cart-footer">
                    <?php
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
                        $sum = $result->fetchAll();?>

                <?php if(isset($_SESSION['user_id'])):
                        $user_id = $_SESSION['user_id'];
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
                                //header("Location:/index.php");
                                exit();
                            } else {
                                echo "Замовлення НЕ додано";
                            }
                        }
                        ?>
                    <div class="c">
                        <form method="POST" >
                            <input style="cursor: pointer;" name="submit" type="submit" class="footer__order" value="Order" >
                        </form></div>

                <?php endif;?>
                    <div class="cart-footer__count"><?= $count[0]['COUNT(id_product)'] ?></div>
                    <div class="cart-footer__price" id="all_price"><?= $order_sum?>$</div>
                </footer>
        <?php  }else{ ?>
                <div id="restart">
            </section>
            <h3 style="text-align: center; font-size: 20px; color: coral; margin: 30px 0;">Your cart is empty</h3>
            <footer class="cart-footer" id="else">
                <div class="cart-footer__count">0</div>
                <div class="cart-footer__price">0$</div>
            </footer>
        <?php  } ?>
                </div>

        </div>
    </div>
</section>
<script>
    function conversionPrice(id){
        // звертаємося до елемента #itemCnt_ і беремо значення поля value
        let newCnt = $('#count__input' + id).val();
       // console.log(newCnt)
        let itemPrice = $('#itemPrice_' + id).attr('value');
       // console.log(itemPrice);
        let itemRealPrice = newCnt * itemPrice;
        console.log(itemRealPrice)
        // // вивід заміна кода в полі
         //$('#all_price' + id).text(itemRealPrice + '$');
    }
</script>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php');  ?>

