 $(document).ready(function () {
    $('form#formAuthor').validate({
        rules: {
            author_name: {
                required: true,
                maxlength: 200,
                minlength: 1
            }
        }
    });
});