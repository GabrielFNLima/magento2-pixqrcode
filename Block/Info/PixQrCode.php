<?php

namespace GFNL\PixQrCode\Block\Info;

use GFNL\PixQrCode\Helper\Data;
use Magento\Framework\View\Element\Template;

class PixQrCode extends \Magento\Payment\Block\Info
{
    /**
     * @var string
     */
    protected $_template = 'GFNL_PixQrCode::info/pixqrcode.phtml';

    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        Data                            $helper,
        Template\Context                $context,
        array                           $data = []
    )
    {
        $this->_checkoutSession = $checkoutSession;
        $this->helper = $helper;
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

    public function getTypeOfProofPayment()
    {
        return $this->helper->getStoreConfigValue('payment/gfnl_pixqrcode/type_proof_payment');
    }

    public function getEmailForConfirmation()
    {
        return $this->helper->getStoreConfigValue('payment/gfnl_pixqrcode/send_proof_payment_to_email');
    }

    public function getWhastappNumber()
    {
        return $this->helper->getStoreConfigValue('payment/gfnl_pixqrcode/send_proof_payment_to_whatsapp_number');
    }
}
