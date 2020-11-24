$("#addProduct").click(function() {
    $.ajax({
        url: 'products/create',
        method: 'get',
        success: function(data) {
            $("div#productForm").html(data);
        }
    })
})
