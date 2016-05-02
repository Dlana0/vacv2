$(document).ready(function () {
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
    });

    tinymce.init({
        selector:'textarea.tinymce',
        height: 400,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: [
            '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });

    $('#delete_vacancy').click(function(){
        var r = confirm("Tiešām vēlaties dzēst vakanci??s");
        if (r != true) {
            return false;
        }
    });



})
