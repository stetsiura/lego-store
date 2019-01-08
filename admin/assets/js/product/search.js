function setMovingProductDialogInputValues(id) {
    $('input#moving-product-category-id').val(id);

    console.log(id);
}

$(document).ready(function() {

    $('#sort-order').change(function() {
        var url = $(this).val();

        location.href = url;
    });

    $('#moving-product-categories-tree').jstree({
        "core" : {
            "themes" : {
                "variant" : "small",
                "stripes" : true
            }
        }
    });

    $('.moving-product-btn').click(function() {
        var productId = $(this).attr('data-product-id');

        $('input#moving-product-id').val(productId);
    });

    $('.removing-product-btn').click(function() {
        var productId = $(this).attr('data-product-id'),
            name = $(this).attr('data-product-name'),
            categoryId = $(this).attr('data-category-id');

        $('input#removing-product-id').val(productId);
        $('input#removing-product-category-id').val(categoryId);
        $('#removing-product-name').html(name);
    });

    $('#moving-product-categories-tree').on("select_node.jstree", function (e, data) {
        var selectedCategoryId = data.node.li_attr['data-cat-id'];

        setMovingProductDialogInputValues(selectedCategoryId);
    });

});
