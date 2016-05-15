(function($) {
$('body').addClass('menu--open');
    $(".btn-toggle-menu, #side-menu").on("mouseenter", function() {
        $('body').addClass('menu--open')
    }).on("mouseleave", function() {
        $('body').removeClass('menu--open')
    });

    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

})(jQuery);
