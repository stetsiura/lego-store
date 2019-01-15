(function() {
    
    $(document).ready(function() {
        $('#nav-toggle').click(function() {
            var mobileMenu = $('#menu');
            mobileMenu.slideToggle(300);
        });
    });
    
    $(window).resize(function() {
        var windowWidth = $(window).width(),
            mobileMenu = $('#menu');
        
        if (windowWidth > settings.mobileBreakPoint) {
            mobileMenu.show();
        } else {
            mobileMenu.hide();
        }
    });
})();