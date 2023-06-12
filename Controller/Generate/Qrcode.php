<?php
declare(strict_types=1);

namespace GFNL\PixQrCode\Controller\Generate;

use chillerlan\QRCode\QRCode as QRCodePackage;
use chillerlan\QRCode\QROptions;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Sales\Model\Order;

/**
 * Controller for the 'gfnlpix/generate/qrcode' URL route.
 */
class Qrcode implements HttpGetActionInterface
{
    public function __construct(
        QRCodePackage $QRCode,
        Http          $request,
        RawFactory    $resultRawFactory,
        Order         $orderModel
    )
    {
        $this->QRCode = $QRCode;
        $this->request = $request;
        $this->resultRawFactory = $resultRawFactory;
        $this->orderModel = $orderModel;
    }

    /**
     * Execute controller action.
     */
    public function execute()
    {

        $payment = $this->getOrder($this->request->getParam('increment_id'))->getPayment();

        $resultRaw = $this->resultRawFactory->create();
        $resultRaw->setHeader('Content-Type', 'image/png');
        $imageFile = base64_decode($this->getImage());
        $resultRaw->setContents($imageFile);
        return $resultRaw;
    }

    private function getImage()
    {
        $payment = $this->getOrder($this->request->getParam('increment_id'))->getPayment();
        $paymentQrcode = $payment->getAdditionalInformation()['qrcode'];
        $imageBase64 = str_contains($paymentQrcode, 'data:image/png;base64,') ? explode('data:image/png;base64,', $paymentQrcode)[1] : $paymentQrcode;
        return $imageBase64;
    }

    private function getOrder($orderId)
    {
        return $this->orderModel->loadByIncrementId($orderId);
    }
}
