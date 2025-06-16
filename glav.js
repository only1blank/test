$('navbar').hover(function() {
    $(this).children('ul').slideDown();
}, function() {
    $(this).children('ul').stop(true).slideUp();
});


