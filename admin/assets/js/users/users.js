$(document).ready(function() {

    $('#sort-order').change(function() {
        var url = $(this).val();

        location.href = url;
    });

    $('.delete-user').click(function() {
        var btn = $(this),
            id = btn.attr('data-id'),
            role = btn.attr('data-role');

        $('input#delete-id').val(id);
        $('input#delete-role').val(role);
    });

});
