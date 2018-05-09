$(document).ready(function() {

    $(document).on('click', '#change-language', function (e) {
        e.stopPropagation();
    });

    $(document).on('change', '#change-language', function (e) {
       location.href = '/main/change-language?lang=' + $(e.target).val();
    });

});