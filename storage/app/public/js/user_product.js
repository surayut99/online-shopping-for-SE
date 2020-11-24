$("a#purchasing").click(function() {
    $.ajax({
        url: "/user_product/purchasing",
        type: "get",
        success: function(data) {
            $("#products").html(data)
        }
    })
})

$("a#verifying").click(function() {
    $.ajax({
        url: "/user_product/verifying",
        type: "get",
        success: function(data) {
            $("#products").html(data)
        }
    })
})

$("a#verified").click(function() {
    $.ajax({
        url: "/user_product/verified",
        type: "get",
        success: function(data) {
            $("#products").html(data)
        }
    })
})

$("a#deliveried").click(function() {
    $.ajax({
        url: "/user_product/deliveried",
        type: "get",
        success: function(data) {
            $("#products").html(data)
        }
    })
})

$("a#completed").click(function() {
    $.ajax({
        url: "/user_product/completed",
        type: "get",
        success: function(data) {
            $("#products").html(data)
        }
    })
})

$("a#cancelled").click(function() {
    $.ajax({
        url: "/user_product/cancelled",
        type: "get",
        success: function(data) {
            $("#products").html(data)
        }
    })
})

window.onload = function() {
    $("a#purchasing").click();
}