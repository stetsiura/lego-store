$(document).ready(function() {

    $('#sort-order').change(function() {
        var url = $(this).val();

        location.href = url;
    });

    $('.removing-news-btn').click(function() {
        var newsId = $(this).attr('data-news-id');

        $('input#removing-news-id').val(newsId);
    });

});