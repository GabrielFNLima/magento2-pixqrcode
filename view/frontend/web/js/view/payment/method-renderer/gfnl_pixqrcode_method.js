define(
    [
        'Magento_Checkout/js/view/payment/default'
    ],
    function (Component) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'GFNL_PixQrCode/payment/gfnl_pixqrcode'
            },

            getComment: function () {
                return window.checkoutConfig.payment.gfnl_pixqrcode.comment;
            },
        });
    }
);
