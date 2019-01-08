$(document).ready(function() {

    $('#sort-order').change(function() {
        var url = $(this).val();

        location.href = url;
    });

});
