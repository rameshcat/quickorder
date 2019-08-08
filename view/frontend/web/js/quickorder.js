define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'mage/translate',
    'domReady!'
], function ($, modal, $t) {
    return function(config, node) {
     var options = {
        type: 'popup',
        responsive: true,
        innerScroll: true,
        title: $t('Fill in the fields, please!'),
        buttons: []
    };

    var popup = modal(options, $('.quick-order-popup'));

    var button = $('.quick-order-button');

        button.on('click', function (event) {
        $(node).find('#sku-field').val(event.target.dataset.productSku);
        $('#quick-order-popup').modal('openModal');
        return false;
    });
    $('body').on('submit', '#qoform', function (e) {
        e.preventDefault();
        $.ajax({
            url: node.action,
            method: 'post',
            data: $(e.target).serialize(),
            context: this,
            afterSend: $("#quick-order-submit").prop('disabled', true),
            beforeSend: function(){if ($('.error').length) {
                $('.error').remove()}},
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 500) {
                    $("#quick-order-submit").before( $("<div class='error'>"+jqXHR.responseJSON.message+"</div>") );
                    $("#quick-order-submit").prop('disabled', false);
                } else {
                    alert('Unexpected error.');
                }
            },
            success: function (event) {
                $("#quick-order-submit").prop('disabled', false);
                popup.closeModal(event);
            }
        });
        return false;
    });
    }
});