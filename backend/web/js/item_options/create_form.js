$(document).ready(function () {

    document.item_options_engine = {

        typeSelector: 'select[name="ItemOptionForm[type]"]',
        typeDefaulValueSelector: 'input[name="ItemOptionForm[default_value]"]',

        init: function () {
            this.onChangeDataType($(this.typeSelector));
        },

        onChangeDataType: function (element) {
            var data_type = $(element).find(' :selected').val();

            if (data_type == 3) // if date
            {
                $(this.typeDefaulValueSelector).kvDatepicker({
                    format: 'dd-mm-yyyy',
                    clearBtn: true
                });
            } else {
                $(this.typeDefaulValueSelector).kvDatepicker('destroy');
            }
        }

    };

    // init engine
    document.item_options_engine.init();

});