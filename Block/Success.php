<?php

namespace GFNL\PixQrCode\Block;

use GFNL\PixQrCode\Helper\Data;
use Magento\Checkout\Block\Onepage\Success as SuccessBlock;

class Success extends SuccessBlock
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Checkout\Model\Session                  $checkoutSession,
        Data                                             $helper,
        \Magento\Sales\Model\Order\Config                $orderConfig,
        \Magento\Framework\App\Http\Context              $httpContext,
        \Magento\Sales\Model\Order                       $orderModel,
        array                                            $data = []
    )
    {
        parent::__construct($context, $checkoutSession, $orderConfig, $httpContext, $data);
        $this->orderModel = $orderModel;
        $this->helper = $helper;
    }

    public function getOrder()
    {
        $orderId = $this->getOrderId();

        return $this->orderModel->loadByIncrementId($orderId);
    }

    public function getEmailForConfirmation(){
        return $this->helper->getStoreConfigValue('payment/gfnl_pixqrcode/send_proof_payment');
    }
}
