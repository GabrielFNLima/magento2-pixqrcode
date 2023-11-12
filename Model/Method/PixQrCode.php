<?php

namespace GFNL\PixQrCode\Model\Method;

use chillerlan\QRCode\QRCode;
use GFNL\PixQrCode\Helper\Data;
use GFNL\PixQrCode\Model\Payload;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Payment\Model\InfoInterface;
use Magento\Sales\Model\Order;

class PixQrCode extends \Magento\Payment\Model\Method\AbstractMethod
{
    const CODE = 'gfnl_pixqrcode';

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::CODE;

    /**
     * @var string
     */
    protected $_infoBlockType = \GFNL\PixQrCode\Block\Info\PixQrCode::class;

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
        QRCode                                                  $qrCode,
        \Psr\Log\LoggerInterface                                $log,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb           $resourceCollection = null,
        array                                                   $data = [],
        DirectoryHelper                                         $directory = null
    )
    {
        $this->helper = $helper;
        $this->payload = $payload;
        $this->qrCode = $qrCode;
        $this->log = $log;

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
        $qrcode = $this->generateQrCodeImage($payloadPix);
        $additional = ['payload_pix' => (string)$payloadPix, 'qrcode' => (string)$qrcode];
        $payment->setAdditionalInformation($additional);

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
        $chavePix = $this->helper->getStoreConfigValue('payment/gfnl_pixqrcode/pix_key');
        if (!$chavePix) {
            $this->log->critical('GFNL_PixQrcode', ['exception' => 'A chave Pix da loja não pôde ser encontrada. Por favor, verifique as configurações do meio de pagamento.']);
            throw new \Magento\Framework\Exception\LocalizedException(__("An error occurred in your payment, Please contact the store."));
        }
        return $chavePix;
    }

    /**
     * Cidade do titular da conta
     * @return string
     */
    public function getMerchantCity()
    {
        $merchantCity = $this->helper->getStoreConfigValue('payment/gfnl_pixqrcode/merchantCity');
        if (!$merchantCity) {
            $this->log->critical('GFNL_PixQrcode', ['exception' => 'A cidade do titular da conta Pix não pôde ser encontrada. Por favor, verifique as configurações do meio de pagamento.']);
            throw new \Magento\Framework\Exception\LocalizedException(__("An error occurred in your payment, Please contact the store."));
        }
        return $merchantCity;
    }

    /**
     * Nome do titular da conta
     * @return string
     */
    public function getMerchantName()
    {
        $merchantName = $this->helper->getStoreConfigValue('payment/gfnl_pixqrcode/merchantName');
        if (!$merchantName) {
            $this->log->critical('GFNL_PixQrcode', ['exception' => __("O nome do titular da conta Pix não pôde ser encontrado. Por favor, verifique as configurações do meio de pagamento.")]);
            throw new \Magento\Framework\Exception\LocalizedException(__("An error occurred in your payment, Please contact the store."));
        }
        return $merchantName;
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

    public function generateQrCodeImage($qrcode)
    {
        return $this->qrCode->render($qrcode);
    }
}
