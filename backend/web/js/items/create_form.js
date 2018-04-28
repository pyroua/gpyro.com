
//TODO: move to common js
function dateValidator(value, messages, options) {
    //console.log(value, messages, options);

    var addMessage = function (messages, message, value) {
        messages.push(message.replace(/\{value\}/g, value));
    };

    if(!options.pattern.test(value)) {
        addMessage(messages, 'Incorrect date formast. Correct: ' + options.date_format);
    }

}

$(document).ready(function () {

    document.item_engine = {

        onCategoryChange: function (event) {
            $.get('/items/get-options/' + parseInt(event.target.value), function (data) {
                $('.default-fields-end').html(data);
            });
        }

    };

});