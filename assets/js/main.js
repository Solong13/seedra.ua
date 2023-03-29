
function stepper(btn, idproduct) {
    //const countField = document.querySelector('.count__input');
    let countField = document.querySelector(`#count__input${idproduct}`); //тут вибирається різні елемент з різними id


    let id = btn.getAttribute("id");
    let min = countField.getAttribute("min");
    let max = countField.getAttribute("max");
    let step = countField.getAttribute("step");
    let val = countField.getAttribute("value");

    let calcStep = +(id == "increment") ? step * +1 : step * -1;
    let newValue = parseInt(val) + calcStep;
    console.log(idproduct);
console.log(newValue);
    if (newValue >= min && newValue <= max) {
        countField.setAttribute("value", newValue);
    }

    conversionPrice(idproduct);
    totalConversionPrice();
    totalConversionCount();
}

function conversionPrice(id) {

    // звертаємося до елемента #itemCnt_ ${id} і беремо значення поля value
    let newCnt = $(`#count__input${id}`).val();

    //беремо значення поля
    let itemPrice = $(`#itemPrice_${id}`).attr('value');

    let itemRealPrice = newCnt * itemPrice;

    // // вивід заміна кода в полі
    $('#itemTotalPrice_' + id).text(itemRealPrice.toFixed(2) + '$');


}

function totalConversionPrice(){
    // ініціалізуйте змінну totalPrice рівним 0
    let totalPrice = 0;


    $('.itemTotalPrice').each(function() {
        // переобразувати рядок ціни до значення з плаваючою точкою
        let price = parseFloat($(this).text());
        if (!isNaN(price)) { // перевірити, чи переобразуване значення є числом
            totalPrice += price; // накопичити загальну ціну, додавши до неї проаналізовану ціну
        }
    });

    $('#all_price').text(totalPrice.toFixed(2) + '$');
}

function totalConversionCount(){
    let cntProducts = 0;

    $('.count__input').each(function() {
        // переобразувати рядок ціни до значення з плаваючою точкою
        let count = parseInt($(this).val());

        if (!isNaN(count)) { // перевірити, чи переобразуване значення є числом
            cntProducts += count; // накопичити загальну ціну, додавши до неї проаналізовану ціну
        }

    });


    $('#all_count').text(cntProducts);
}



// батьки
// const stepper = document.querySelector('.count');
// const stepperInput = document.querySelector('.count__input');
// const stepperUp = document.querySelector('#increment');
// const stepperDown = document.querySelector('#decrement');
//
// let count = stepperInput.value;
//
// stepperInput.addEventListener('keyup', (e) => {
//     let self = e.currentTarget;
//
//     if(self.value == '0'){
//         self.value = 1;
//     }
//
//     count = stepperInput.value;
//
//     if(count == 1){
//         stepperDown.classList.add('btn_disabled');
//     }else{
//         stepperDown.classList.remove('btn_disabled');
//     }
// });
//
// stepperUp.addEventListener('click', (e) => {
//     e.preventDefault();
//
//     count++;
//
//     if(count == 1){
//         stepperDown.classList.add('btn_disabled');
//     }else{
//         stepperDown.classList.remove('btn_disabled');
//     }
//
//     if(count == 50){
//         stepperUp.classList.add('btn_disabled');
//     }else{
//         stepperUp.classList.remove('btn_disabled');
//     }
//
//
//     stepperInput.value = count;
//
// });
//
// stepperDown.addEventListener('click', (e) => {
//     e.preventDefault();
//
//     count--;
//
//     if(count == 1){
//         stepperDown.classList.add('btn_disabled');
//     }else{
//         stepperDown.classList.remove('btn_disabled');
//     }
//
//     stepperInput.value = count;
//
// });


// const init = () => {
//     let totalCost = 0;
//
//     [...document.querySelectorAll('#product' + id)].forEach((basketItem) => {
//         totalCost += Number(basketItem.querySelector('.count__input').value) * Number(basketItem.querySelector('.itemPrice_' + id).value);
//     });
//
//     document.getElementById('#all_price').textContent = totalCost;
// };


    function addToCart(id){
        $.ajax({
            type: "POST",
            url:"/controllers/CartController.php",
            data: {id: id},
            cache: false,
            dataType: 'json',
            success: function (data){
                if(data['result']){
                    $('#addToCart_' + id).html(data['message']);
                    $('#count_products_cart').html(data['cart']);
                    setTimeout(function (){
                        $('#addToCart_' + id).html('Buy Now');
                    }, 1000)
                    $(".error_product").hide();
                    console.log('true');
                } else {

                    $(".error_product").show();
                    $('.error_product' + id).html(data['error']);

                    setTimeout(function (){
                        $(".error_product" + id).html('');
                    }, 1000)
                }
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR);
            }
        });
    }


     function deleteProduct(product, id){
            $.ajax({
                url:"/controllers/DeleteCartController.php",
                type: "post",
                data: {id: id},
                dataType: 'json',
                }).done(function (data) {
                    if(data['result']){
                        sb_remove_from_basket(product);
                        $('.cart-footer__count').html(data['cart']);
                        $('#count_products_cart').html(data['cart']);
                    }
                    if(data['cart'] <= 0){
                        $('.product').html('');
                        $('.cart-footer').html('');
                    }
                }).fail(function () {
                    console.log('fail');
            });
    }

    function sb_remove_from_basket(product) {
        $(product).parents(".product").remove(); //удаляємо батьківський елемента з класом .product
    }

    function order(){

    }

    function writeReview(){
            const text_review = $('#text_review').val();
        console.log('falasddse');
            $.ajax({
                url: '/controllers/ReviweController.php',
                type: 'POST',
                cache: false,
                data: {'text_review': text_review},
                dataType: 'json',
                success: function(data) {
                    if(data['Done']) {
                        console.log('true');
                        $('.buttonForReview').val(data['message']);
                        $("#error-block").hide();
                        $(".review_ps").html(data['text']);
                        $(".userr").html(data['userName']);
                        $('#text_review').val("");
                    }
                    else {
                        console.log('false');
                        $("#error-block").show();
                        $("#error-block").html(data['error']);
                    }
                }
            });
    }

    function addToLike(id){
  
        const liked = $('#likedd' + id).attr("src");

        $.ajax({
            url:'/controllers/LikeController.php',
            type: 'POST',
            cache: false,
            data: {'id': id},
            dataType: 'json',
            success: function(data){
                if(data['result']){
                    console.log('add');
                    $('#likedd' + id).attr("src", "/assets/img/liked.png");
                }else if(data['del']){
                    console.log('del');
                    $('#likedd' + id).attr("src", '/assets/img/likePost.png');
                }
            },
            error: function (jqXHR, exception) {
                if (jqXHR.status === 0) {
                    alert('Not connect. Verify Network.');
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found (404).');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error (500).');
                } else if (exception === 'parsererror') {
                    alert('Requested JSON parse failed.');
                } else if (exception === 'timeout') {
                    alert('Time out error.');
                } else if (exception === 'abort') {
                    alert('Ajax request aborted.');
                } else {
                    alert('Uncaught Error. ' + jqXHR.responseText);
                }
            }

        })
        // console.log('2');
        // if(liked == '/assets/img/likePost.png'){

        //     $('#likedd' + id).attr("src", "/assets/img/liked.png");
        // }else{
        //     $('#likedd' + id).attr("src", '/assets/img/likePost.png');
        // }

    }
