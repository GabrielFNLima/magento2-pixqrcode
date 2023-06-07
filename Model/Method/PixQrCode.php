<?php

namespace GFNL\PixQrCode\Model\Method;

use GFNL\PixQrCode\Helper\Data;
use GFNL\PixQrCode\Model\Payload;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Payment\Model\InfoInterface;
use Magento\Sales\Model\Order;

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
        Payload                                                 $payload,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb           $resourceCollection = null,
        array                                                   $data = [],
        DirectoryHelper                                         $directory = null
    )
    {
        $this->helper = $helper;
        $this->payload = $payload;
        parent::__construct($context, $registry, $extensionFactory, $customAttributeFactory, $paymentData, $scopeConfig, $logger, $resource, $resourceCollection, $data, $directory);
    }

    /**
     * @param InfoInterface $payment
     * @param $amount
     * @return $this|PixQrCode
     */
    public function order(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {
        /** @var Order $order */
        $order = $payment->getOrder();
        $incrementId = $order->getIncrementId();

        $payloadPix = $this->payload
            ->setTxId($incrementId)
            ->setAmount(number_format($amount, 2, ".", ""))
            ->setPixKey($this->getChavePix())
            ->setMechantCity($this->getMerchantCity())
            ->setMechantName($this->getMerchantName())
            ->setDesciption($this->getDescription())
            ->getPayload();
        $order->setPayloadPix($payloadPix);

        return $this;
    }

    public function getComment()
    {
        return __($this->helper->getStoreConfigValue('payment/gfnl_pixqrcode/comment'));
    }

    /**
     * Chave pix
     * @return string
     */
    public function getChavePix()
    {
        return $this->helper->getStoreConfigValue('payment/gfnl_pixqrcode/pix_key');
    }

    /**
     * Cidade do titular da conta
     * @return string
     */
    public function getMerchantCity()
    {
        return $this->helper->getStoreConfigValue('payment/gfnl_pixqrcode/merchantCity');
    }

    /**
     * Nome do titular da conta
     * @return string
     */
    public function getMerchantName()
    {
        return $this->helper->getStoreConfigValue('payment/gfnl_pixqrcode/merchantName');
    }

    /**
     * Descrição do pagamento
     * @return string
     */
    public function getDescription()
    {
        $description = $this->helper->getStoreConfigValue('payment/gfnl_pixqrcode/description');
        return $description !== null ? $description : '';
    }
}
