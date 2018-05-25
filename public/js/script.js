$(function () {
    if (document.getElementById('msg_s') != null)
        document.getElementById('sel1_s').value = document.getElementById('msg_s').value;
});

function OnSelectionChange(select) {
    document.getElementById('msg_s').value = select.value;
}

function OnSelectionInput(input, key, id) {
    $('#inputTD_' + key).replaceWith
    ("<div id=\"inputTD_" + key + "\"><input id='but_" + key + "\'type=\"text\" class=\"form-control\" name=\"price\" placeholder=\"Цена\" value=" + input + ">" +
        "<button onclick=\"OnSelectionInputOut(" + input + "," + key + "," + id + ")\" type=\'button\' class=\"btn btn-success\">Сохранить</button></div>");
}

function OnSelectionInputOut(input, key, id) {
    var price = document.getElementById('but_' + key).value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.post("/product/edit",
        {id: id, price: price}
    )
        .done(function (result) {
        });

    $('#inputTD_' + key).replaceWith
    ("<td class=\"mycursor\" id=\"inputTD_" + key + "\" onclick=\"OnSelectionInput(" + input + "," + key + "," + id + ")\">" + price + "</td>");
}



