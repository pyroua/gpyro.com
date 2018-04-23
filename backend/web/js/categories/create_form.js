$(document).ready(function () {

    document.category_engine = {

        onOptionSelect: function (event) {
            var option = event.params.data;
            $.get('/categories/get-item-option-block/' + parseInt(option.id), function (data) {
                $('.field-categoryform-item-options').after(data);
            });
        },
        onOptionUnselect: function (event) {
            var option = event.params.data;

            $('#item-form-option-id-' + option.id).hide();
        },
        onAllOptionSelect: function (event) {
            console.log(event);
            //var option = event.params.data;

            //$('#item-form-option-id-' + option.id).hide();
        }

    };

});