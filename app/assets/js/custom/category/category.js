$(document).ready(function() {
    $('.category-section-description .fix-height').matchHeight();

    $('.category-items .title').matchHeight();

    $('select#sort-order').change(function() {
        var url = $(this).val();
        location.href = url;
    });
});
