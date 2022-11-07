$(".hamburger").on("click", function (){
    $(this).toggleClass("is-active");
    $(".nav").toggleClass("nav--open");
});