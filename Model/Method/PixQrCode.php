<?php

namespace GFNL\PixQrCode\Model\Method;

use Magento\Payment\Model\InfoInterface;

class PixQrCode extends \Magento\Payment\Model\Method\AbstractMethod
{
    const CODE = 'gfnl_pixqrcode';

    protected $_code = self::CODE;

    /**
     * @param InfoInterface $payment
     * @param $amount
     * @return $this|PixQrCode
     */
    public function order(\Magento\Payment\Model\InfoInterface $payment, $amount){

        return $this;
    }
}
