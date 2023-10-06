<?php
/**
 * @author FYB Romania
 * @copyright Copyright (c) FYB Romania (https://fyb.ro)
 * @package Notification Bar for Magento 2
 */

namespace Fyb\NotificationBar\Block;

use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

class Notification extends Template
{
    const BASE_CONFIG_PATH = "notification_bar/general/";

    /**
     * @param string $path
     *
     * @return mixed
     */
    public function getConfig(string $path)
    {
        return $this->_scopeConfig->getValue(
            self::BASE_CONFIG_PATH . $path,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return bool
     */
    public function needDisplay()
    {
        $dateFrom = $this->getConfig('from_date');
        $dateTo = $this->getConfig('to_date');

        return $this->getConfig('enabled') && (!$dateFrom || time() >= strtotime($dateFrom))
            && (!$dateTo || time() <= strtotime($dateTo));
    }
}
