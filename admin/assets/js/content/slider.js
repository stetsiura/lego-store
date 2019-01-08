function imagePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#slider-image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {

    $('input#image').change(function(e) {
        var fileName = e.target.files[0].name;
        $('#cover-btn').html(fileName);
        imagePreview(this);
    });
	
});