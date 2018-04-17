$(document).ready(function () {

    document.item_index = {

        onCategoryChange: function (event) {
            document.location.href = '/items/index/' + parseInt(event.target.value);
        }

    };

});