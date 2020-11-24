$("a#purchasing").click(function() {
    $.ajax({
        url: "/order_list/purchasing",
        type: "get",
        success: function(data) {
            $("#orders").html(data)
        }
    })
})

$("a#verifying").click(function() {
    $.ajax({
        url: "/order_list/verifying",
        type: "get",
        success: function(data) {
            $("#orders").html(data)
        }
    })
})

$("a#verified").click(function() {
    $.ajax({
        url: "/order_list/verified",
        type: "get",
        success: function(data) {
            $("#orders").html(data)
        }
    })
})

$("a#deliveried").click(function() {
    $.ajax({
        url: "/order_list/deliveried",
        type: "get",
        success: function(data) {
            $("#orders").html(data)
        }
    })
})

$("a#completed").click(function() {
    $.ajax({
        url: "/order_list/completed",
        type: "get",
        success: function(data) {
            $("#orders").html(data)
        }
    })
})

$("a#cancelled").click(function() {
    $.ajax({
        url: "/order_list/cancelled",
        type: "get",
        success: function(data) {
            $("#orders").html(data)
        }
    })
})

$("a#total").click(function() {
    $.ajax({
        url: "/order_list/total",
        type: "get",
        success: function(data) {
            $("#orders").html(data)
        }
    })
})

window.onload = function() {
    $("a#verifying").click();
}