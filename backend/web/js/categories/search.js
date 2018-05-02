$(document).ready(function () {

    $('input[name="search"]').keyup(function (e) {
        var query = $(e.target).val();
        $('.treeview .cat-title').parent('li').show();
        $('.treeview .cat-title').each(function (i, e) {
            if ($(e).text().search(query) < 0) {
                $(e).parent('li').hide();
            }
        });
    });

});