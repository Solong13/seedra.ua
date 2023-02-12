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