// при сколі вікна запускаємо function showHeader()
window.onscroll = function showHeader(){
    let header = document.querySelector('.header');

    if(window.pageYOffset > 72){
        header.classList.add('header_fixed');
    } else {
        header.classList.remove('header_fixed');
    }
}

/* стрілка для скрола вгору  */
window.onload = () => {
    //обираємо кнопку
    const scrollBtn = document.querySelector('.isShowBtn');
    // при події скролу
    window.onscroll = () => {
        // якщо скрол по осі У більше 700 пікселів
        if(window.scrollY > 700){
            // Свойство classList возвращает псевдомассив DOMTokenList, содержащий все классы элемента.
            scrollBtn.classList.remove('isShowBtn_hide');
        }else if(window.scrollY < 700){
            // дод клас
            scrollBtn.classList.add('isShowBtn_hide');
        }
    };
    //  при кліку повертаємося до верху JS
    scrollBtn.onclick = () => {
        window.scrollTo(0, 0, {
            behavior: 'smooth'
        });
    }
    // також для плавності скролу потрібно додати в ссs
    /*
    html {
        scroll-behavior: smooth;
    }
     */

    // для Qjuery
    // $('.isShowBtn').click(function () {
    //    $(window).scrollTop(0);
    // });
};
