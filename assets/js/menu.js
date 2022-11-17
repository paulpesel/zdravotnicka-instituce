var form = $(".search-form");
var nav = $(".nav");
$(".hamburger").on("click", function () {
    $(this).toggleClass("is-active");
    nav.toggleClass("nav--open");
});

$(".search").on("click", function () {
    form.toggleClass("search--open");
    if (nav.hasClass("nav--open")) {
        $(".hamburger").toggleClass("is-active");
        nav.toggleClass("nav--open");
    }
});