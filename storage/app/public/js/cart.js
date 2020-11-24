function onClickPlus(event, max) {
    var id = event.target.name
    var curr = parseInt($('input#' + id).val())
    if (curr + 1 <= max) {
        $('input#' + id).val(curr + 1)
        increaseTotal(id)
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "cart/update/"+id,
            type: "put",
            data : {'_token': token, 'amount':$('input#' + id).val()},
            success: function (data) {
                console.log(data)
            }
        })
    }

}

function onClickMinus(event) {
    var id = event.target.name
    var curr = parseInt($('input#' + id).val())
    if (curr - 1 >= 1) {
        $('input#' + id).val(curr - 1)
        decreaseTotal(id)
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "cart/update/"+id,
            type: "put",
            data : {'_token': token, 'amount':$('input#' + id).val()},
            success: function (data) {
                console.log(data)
            }
        })
    } else {
        $('input#' + id).val(1)
        $.ajax({
            url: "cart/update/"+id,
            type: "put",
            data : {'_token': token, 'amount':$('input#' + id).val()},
            success: function (data) {
                console.log(data)
            }
        })
    }

}

function onKeyUp(event, max, id) {
    var curr = parseInt($('input#' + id).val())
    if (curr > max) {
        $('input#' + id).val(max)
    }
    else if(curr<1) {
        $('input#' + id).val(1)
    }


}

function increaseTotal(id){
    var price = parseInt($('#price'+id).text().substring(1))
    var currT = parseInt($('h4#total').text())
    currT+=price
    $('h4#total').text(currT)
}
function decreaseTotal(id){
    var price = parseInt($('#price'+id).text().substring(1))
    var currT = parseInt($('h4#total').text())
    if(currT>0){
        currT-=price
        $('h4#total').text(currT)}
}


