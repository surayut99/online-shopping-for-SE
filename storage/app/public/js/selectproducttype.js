$("#primeProdType").change(function() {
    $.ajax({
        url: '/product_types/' + $("#primeProdType").val(),
        method: 'get',
        success: function(data) {
            document.getElementById('secondProdType').innerHTML = ''
            data.forEach(secondary => {
                $('#secondProdType').append("<option value=' " + secondary + "'" + ">" + secondary + "</option>")
            })
        }
    })
})