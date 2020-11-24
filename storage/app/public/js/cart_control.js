function getMaxQty(id) {
    var max =
        $.ajax({
            url: "product_qty/" + id
            , method: 'get'
            , success: function(data) {
                return parseInt(data)
            }
        }).val()
    return max
}

function onClickPlus(event) {
    var id = event.target.name
    var curr = parseInt($('input#' + id).val())
    var max = getMaxQty(id)
    console.log(id)
    console.log(curr)
    console.log(max)
}

function onClickMinus(event) {}
