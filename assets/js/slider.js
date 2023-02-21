let btnPrev = document.querySelector('.buttons .prev');
let btnNext = document.querySelector('.buttons .next');

let images = document.querySelectorAll('.intro-picture .photos img');
let i = 0;

btnPrev.onclick = function (){
    images[i].className = '';
    i--;

    if (i <= 0){
        i = images.length-1;
    }
    images[i].className = 'header_picture';
}

btnNext.onclick = function (){
    images[i].className = '';
    i++;
    if (i >= images.length){
        i = 0;
    }
    images[i].className = 'header_picture';
}


//слайдер для постів

 // let posts = document.querySelectorAll('.review_post');
// console.log(posts);
//
// const prev_post = document.querySelector('.prev_post');
// const next_post = document.querySelector('.next_post');
//
// let a = 0;
//
// next_post.onclick = function (){
//     posts[a].className = '';
//     a = a-- ;
//     if (a <= 0){
//         a = posts.length-1;
//     }
//     posts[a].className = 'post_visibility';
// }


$(function (){
    $('.rev_slider').slick({
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
})
