(function() {
    
    $(document).ready(function() {
        $('#mobile-toggle').click(function() {
            var mobileMenu = $('#mobile-nav');
            mobileMenu.slideToggle(300);
        });
    });
    
    $(window).resize(function() {
        var windowWidth = $(window).width();
        
        if (windowWidth > settings.mobileBreakPoint) {
            var mobileMenu = $('#mobile-nav');
            mobileMenu.hide();
        }
    });
})();