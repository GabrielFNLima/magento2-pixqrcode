<?php

namespace GFNL\PixQrCode\Model;

use GFNL\PixQrCode\Model\Method\PixQrCode;
use Magento\Payment\Helper\Data as PaymentHelper;
use Magento\Framework\Escaper;
class PixConfigProvider implements \Magento\Checkout\Model\ConfigProviderInterface
{
    /**
     * @var string[]
     */
    protected $methodCode = PixQrCode::CODE;

    /**
     * @var PixQrCode
     */
    protected $method;

    /**
     * @var Escaper
     */
    protected $escaper;

    public function __construct(
        PaymentHelper $paymentHelper,
        Escaper       $escaper
    )
    {
        $this->escaper = $escaper;
        $this->method = $paymentHelper->getMethodInstance($this->methodCode);
    }

    public function getConfig()
    {
        return $this->method->isAvailable() ? [
            'payment' => [
                PixQrCode::CODE => [
                    'comment' => $this->getComment()
                ],
            ],
        ] : [];
    }

    public function getComment()
    {
        return $this->escaper->escapeHtml($this->method->getComment());
    }
}
