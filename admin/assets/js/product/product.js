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

	$('.summernote').summernote({
        lang: 'ru-RU',
        height: 300,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
			['misc', ['codeview', 'undo', 'redo']]
        ]
    });

	$('#warning-editor').summernote(
		'code', $('textarea#warning').val()
	);

    $('#usage-editor').summernote(
        'code', $('textarea#usage').val()
    );

    $('input#product-image-file').change(function(e) {
        var fileName = e.target.files[0].name;
        $('#cover-btn').html(fileName);
        imagePreview(this);
    });

    $('input#name').keyup(function() {
    	var input = $(this),
			value = input.val(),
			transliteration = transliterate(value);
    	$('input#alias').val(transliteration);
	});

    var editForm = $('#edit-form');

    editForm.submit(function(e) {

        $('textarea#usage').val($('#usage-editor').summernote('code'));
        $('textarea#warning').val($('#warning-editor').summernote('code'));

        var valid = validation
            .init()
            .notEmpty('name', 'Пожалуйста, укажите название')
            .notEmpty('alias', 'Пожалуйста, укажите псевдоним')
            .notEmpty('sku', 'Пожалуйста, укажите SKU')
            .notEmpty('item_code', 'Пожалуйста, укажите код товара')
            .notEmpty('barcode', 'Пожалуйста, укажите штрихкод')
            .result();
        if (!valid) {
            e.preventDefault();
        }
    });
	
});