<?php

namespace GFNL\PixQrCode\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\Context;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function __construct(Context $context, ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    /**
     * Returns Store config value
     *
     * @param string $scopeConfigPath
     * @return string/bool
     */
    public function getStoreConfigValue(string $scopeConfigPath): string
    {
        return $this->scopeConfig->getValue($scopeConfigPath, ScopeInterface::SCOPE_STORE);
    }
}
