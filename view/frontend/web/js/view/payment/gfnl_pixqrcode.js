define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'gfnl_pixqrcode',
                component: 'GFNL_PixQrCode/js/view/payment/method-renderer/gfnl_pixqrcode_method'
            },
        );
        /** Add view logic here if needed */
        return Component.extend({});
    }
);
