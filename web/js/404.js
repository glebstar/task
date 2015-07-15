function support() {
    var vendorPrefixes = "O Ms Webkit Moz".split(' '),
            i = vendorPrefixes.length, support = true,
            divStyle = document.createElement('div').style;

    while (i--) {
        for (var a = 0, support = true; a < arguments.length; a++) {
            support = (vendorPrefixes[ i ] + arguments[ a ] in divStyle);
        }

        if (support)
            return true;
    }

    return false;
}

$(document).ready(function() {
    support('Animation') && $('#error-digits > span').each(function(i, span) {
        $(span).addClass('bounceInDown');
    });
});