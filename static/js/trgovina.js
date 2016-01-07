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
        }).fail(function () {
        $.toast({
            heading: 'Error',
            text: 'Napaka!',
            showHideTransition: 'slide',
            icon: 'error'
        })
    })
};