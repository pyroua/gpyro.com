$(document).ready(function () {

    document.item_engine = {

        onCategoryChange: function (event) {
            $.get('/items/get-options/' + parseInt(event.target.value), function (data) {
                $('.default-fields-end').html(data);
            });
        }

    };

});