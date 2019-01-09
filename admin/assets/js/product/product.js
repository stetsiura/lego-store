function imagePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#product-image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {
	
	$('input#has-discount').change(function () {
		var isChecked = $(this).is(':checked'),
			discountPriceGroup = $('#discountPriceGroup');
		if (isChecked) {
			discountPriceGroup.slideDown(300);
		} else {
			discountPriceGroup.slideUp(300);
		}
    });
    
    $('select#item-condition').change(function() {
        var value = $(this).val(),
            usedProductDetailsGroup = $('#used-product-details-group');

        if (value == 'used') {
            usedProductDetailsGroup.slideDown(300);
        } else {
            usedProductDetailsGroup.slideUp(300);
        }
    });

	$('.summernote').summernote({
        lang: 'ru-RU',
        height: 300,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
			['misc', ['codeview', 'undo', 'redo']]
        ]
    });

	$('#description-editor').summernote(
		'code', $('textarea#description').val()
	);

    $('input#product-image-file').change(function(e) {
        var fileName = e.target.files[0].name;
        $('#cover-btn').html(fileName);
        imagePreview(this);
    });

    var editForm = $('#edit-form');

    editForm.submit(function(e) {

        $('textarea#description').val($('#description-editor').summernote('code'));

        var valid = validation
            .init()
            .notEmpty('name', 'Пожалуйста, укажите название')
            .notEmpty('original-name', 'Пожалуйста, укажите оригинальное название')
            .notEmpty('item-code', 'Пожалуйста, укажите номер набора')
            .notEmpty('year-released', 'Пожалуйста, укажите год выпуска')
            .notEmpty('parts-count', 'Пожалуйста, укажите количество деталей')
            .notEmpty('minifigures-count', 'Пожалуйста, укажите количество человечков')
            .notEmpty('price', 'Пожалуйста, укажите цену')
            .result();
        if (!valid) {
            e.preventDefault();
        }
    });
	
});