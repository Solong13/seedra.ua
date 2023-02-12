

function stepper(btn){
    const countField = document.querySelector('.count__input');
    let id = btn.getAttribute("id");
    let min = countField.getAttribute("min");
    let max = countField.getAttribute("max");
    let step = countField.getAttribute("step");
    let val = countField.getAttribute("value");

    let calcStep = +(id == "increment") ? (step*+1) : (step* -1);
    let newValue = parseInt(val) + calcStep;

    console.log(newValue);

    if (newValue >= min && newValue <= max){
        countField.setAttribute("value", newValue);
    }
}


    function addToCart(id){

        $.ajax({
            type: "POST",
            url:"/controllers/CartController.php",
            data: {id: id},
            dataType: 'html',
            success:( function (data){
                //if(data['success']) {
                    $('#addToCart_' + id).html("Added to cart");
                    $('#count_products_cart').html(data);
                    console.log(data);
               // }
            })
        })
    }


    async function deleteProduct(id){
            $.ajax({
                url:"/controllers/DeleteCartController.php",
                type: "post",
                data: {id: id},
                }).done(function (result) {
                 //$('#product' + id).remove(result);
                // $('#restart').html(result);
                //$('#product' + id).html('');
                $('#count_products_cart').html(result);
                   //location.reload();
                }).fail(function () {
                    console.log('fail');
            });
    }


