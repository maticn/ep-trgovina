var dodajVKosarico = function (cartUrl, izdelekId) {

    $.post(cartUrl, {
            'do': 'add_into_cart',
            'id': izdelekId
        })
        .done(function () {
            $.toast({
                heading: 'Information',
                text: 'Izdelek je bil dodan v košarico.',
                showHideTransition: 'slide',
                icon: 'info'
            })
        }).fail(function (response) {
        $.toast({
            heading: 'Error',
            text: 'Napaka!',
            showHideTransition: 'slide',
            icon: 'error'
        });
        console.log(response)
    })
};
var povecajKolicino = function (cartUrl, izdelekId) {

    $.post(cartUrl, {
            'do': 'vecvec',
            'id': izdelekId
        })
        .done(function () {
            window.location.reload(true);
        })
};
var zmanjsajKolicino = function (cartUrl, izdelekId) {

    $.post(cartUrl, {
            'do': 'manjmanj',
            'id': izdelekId
        })
        .done(function () {
            window.location.reload(true);
        })
};