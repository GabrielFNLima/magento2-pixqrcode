<?php

namespace GFNL\PixQrCode\Model\Method;

use GFNL\PixQrCode\Helper\Data;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Payment\Model\InfoInterface;

class PixQrCode extends \Magento\Payment\Model\Method\AbstractMethod
{
    const CODE = 'gfnl_pixqrcode';

    protected $_code = self::CODE;

    public function __construct(
        \Magento\Framework\Model\Context                        $context,
        \Magento\Framework\Registry                             $registry,
        \Magento\Framework\Api\ExtensionAttributesFactory       $extensionFactory,
        \Magento\Framework\Api\AttributeValueFactory            $customAttributeFactory,
        \Magento\Payment\Helper\Data                            $paymentData,
        \Magento\Framework\App\Config\ScopeConfigInterface      $scopeConfig,
        \Magento\Payment\Model\Method\Logger                    $logger,
        Data                                                    $helper,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb           $resourceCollection = null,
        array                                                   $data = [],
        DirectoryHelper                                         $directory = null
    )
    {
        $this->helper = $helper;
        parent::__construct($context, $registry, $extensionFactory, $customAttributeFactory, $paymentData, $scopeConfig, $logger, $resource, $resourceCollection, $data, $directory);
    }

    /**
     * @param InfoInterface $payment
     * @param $amount
     * @return $this|PixQrCode
     */
    public function order(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {

        return $this;
    }

    public function getComment()
    {
        return __($this->helper->getStoreConfigValue('payment/gfnl_pixqrcode/comment'));
    }
}
