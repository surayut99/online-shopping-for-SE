function validateTelNumber(evt) {
    var new_tel = evt.value;

    if (new_tel.length > 10) {
        evt.value = new_tel.substring(0, 10);
        return;
    }

    if (new_tel[0] != "0") {
        evt.value = new_tel.slice(0, -1);
        return;
    }

    if (!isDigit(new_tel.charAt(new_tel.length - 1))) {
        evt.value = new_tel.slice(0, -1);
        return;
    }
}

function isDigit(n) {
    return /^-?[\d.]+(?:e-?\d+)?$/.test(n)
}

function collapseDelOpt() {
    $("#deleteOpt").attr("hidden", !$("#deleteOpt").attr("hidden"))
}