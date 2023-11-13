<?php

namespace GFNL\PixQrCode\Model\Adminhtml\System\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class TypeProofPayment implements ArrayInterface
{

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        $options = [
            "by_whatsapp" => "By Whatsapp",
            "by_email" => "By E-mail"
        ];

        return $options;
    }
}
