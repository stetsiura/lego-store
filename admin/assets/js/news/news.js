function imagePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#news-cover').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function sendFile(file) {

    data = new FormData();
    data.append("contentImage", file);

    $.ajax({
        data: data,
        type: "POST",
        url: "/admin/news/upload-content-image/",
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {

            var imgNode = document.createElement("IMG");

            imgNode.setAttribute("src", url);

            $('#content-editor').summernote('insertNode', imgNode);
        }
    });
}

$(document).ready(function() {

    $('input#news-cover-file').change(function(e) {
        var fileName = e.target.files[0].name;
        $('#cover-btn').html(fileName);
        imagePreview(this);
    });

    $('input#title').keyup(function() {
        var input = $(this),
            value = input.val(),
            transliteration = transliterate(value);
        $('input#alias').val(transliteration);
    });

    $('.summernote').summernote({
        lang: 'ru-RU',
        height: 500,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['misc', ['codeview', 'undo', 'redo']],
            ['insert', ['picture', 'link']]
        ],
        callbacks: {
            onImageUpload: function(files) {
                var imageUrl = sendFile(files[0]);
            }
        }
    });

    $(function () {
        $('#publish-date-picker').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: 'ru'
        });
    });

    $('#content-editor').summernote(
        'code', $('textarea#content').val()
    );

    var editForm = $('#edit-form');

    editForm.submit(function(e) {

        $('textarea#content').val($('#content-editor').summernote('code'));

        var valid = validation
            .init()
            .notEmpty('title', 'Пожалуйста, укажите заголовок')
            .notEmpty('alias', 'Пожалуйста, укажите псевдоним')
            .result();
        if (!valid) {
            e.preventDefault();
        }
    });

});