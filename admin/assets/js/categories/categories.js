function navigateToCategory(id) {
		
	var url = '/admin/categories/';

	if (id * 1 != -1) {
		url += id;
        url += '?page=1&sort=name&order=asc'
	}

	location.href = url;
}

function setMovingCategoryDialogInputValues(id) {
	$('input#targetCategoryId').val(id);
}

function setMovingProductDialogInputValues(id) {
	$('input#moving-product-category-id').val(id);
	
	console.log(id);
}

function imagePreview(input, imageId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#' + imageId).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {

    $('#sort-order').change(function() {
        var url = $(this).val();

        location.href = url;
    });

	$('#categories-tree').jstree({
		"core" : {
			"themes" : {
				"variant" : "small",
				"stripes" : true
			}
		}
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
			name = $(this).attr('data-product-name');

		$('input#removing-product-id').val(productId);
		$('#removing-product-name').html(name);
	});
	
	$('#categories-tree').on("select_node.jstree", function (e, data) {
		var selectedCategoryId = data.node.li_attr['data-cat-id'];

		navigateToCategory(selectedCategoryId);
	});
	
	$('#moving-product-categories-tree').on("select_node.jstree", function (e, data) {
		var selectedCategoryId = data.node.li_attr['data-cat-id'];

		setMovingProductDialogInputValues(selectedCategoryId);
	});

    $('input#category-image-file').change(function(e) {
        var fileName = e.target.files[0].name;
        $('#category-img-btn').html(fileName);
        imagePreview(this, 'category-image');
    });

    $('input#category-thumb-file').change(function(e) {
        var fileName = e.target.files[0].name;
        $('#category-thumb-btn').html(fileName);
        imagePreview(this, 'category-thumb');
    });

    var editForm = $('#edit-form');

    editForm.submit(function(e) {
        var valid = validation
            .init()
			.notEmpty('name', 'Пожалуйста, укажите название')
			.notEmpty('original-name', 'Пожалуйста, укажите оригинальное название')
			.notEmpty('alias', 'Пожалуйста, укажите псевдоним')
			.notEmpty('cover-color', 'Пожалуйста, укажите цвет обложки')
			.notEmpty('description', 'Пожалуйста, укажите описание')
            .result();
        if (!valid) {
            e.preventDefault();
        }
    });

    var createForm = $('#create-form');

    createForm.submit(function(e) {
        var valid = validation
            .init()
            .notEmpty('name', 'Пожалуйста, укажите название')
			.notEmpty('original-name', 'Пожалуйста, укажите оригинальное название')
			.notEmpty('alias', 'Пожалуйста, укажите псевдоним')
			.notEmpty('cover-color', 'Пожалуйста, укажите цвет обложки')
			.notEmpty('description', 'Пожалуйста, укажите описание')
            .result();
        if (!valid) {
            e.preventDefault();
        }
    });
});