//navigation hamburger menu
var menuToggle = document.querySelector('.menu-toggle');
var nav = document.querySelector('nav');

menuToggle.addEventListener('click',() => {
    if(nav.className!='active') {
        nav.className='active';
}
else {
    nav.className='';
}
})

// active a class navbar
$(document).on('click', 'header nav ul li', function(){
    $(this).addClass('active').siblings().removeClass('active')
})
