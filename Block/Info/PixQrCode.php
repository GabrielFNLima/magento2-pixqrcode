<?php

namespace GFNL\PixQrCode\Block\Info;

use Magento\Framework\View\Element\Template;

class PixQrCode extends \Magento\Payment\Block\Info
{
    /**
     * @var string
     */
    protected $_template = 'GFNL_PixQrCode::info/pixqrcode.phtml';

    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        Template\Context                $context,
        array                           $data = []
    )
    {
        $this->_checkoutSession = $checkoutSession;
        parent::__construct($context, $data);
    }

    public function getOrder()
    {
        return $this->getInfo()->getOrder();
    }

    public function getPaymentInfo()
    {
        $order = $this->getOrder();
        if ($payment = $order->getPayment()) {
            return $payment->getAdditionalInformation();
        }

        return false;
    }

    public function getPayloadPix()
    {
        $info = $this->getPaymentInfo();
        return $info['payload_pix'] ?? '';
    }
}
