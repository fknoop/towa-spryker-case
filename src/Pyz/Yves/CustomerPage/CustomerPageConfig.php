<?php

declare(strict_types=1);

namespace Pyz\Yves\CustomerPage;

use SprykerShop\Yves\CustomerPage\CustomerPageConfig as SprykerCustomerPageConfig;

class CustomerPageConfig extends SprykerCustomerPageConfig
{
    /**
     * @var bool
     */
    protected const CUSTOMER_SECURITY_BLOCKER_ENABLED = true;
    /**
     * @uses \Pyz\Zed\Customer\CustomerConfig::MIN_LENGTH_CUSTOMER_PASSWORD
     *
     * @var int
     */
    protected const MIN_LENGTH_CUSTOMER_PASSWORD = 8;
    /**
     * @uses \Pyz\Zed\Customer\CustomerConfig::MAX_LENGTH_CUSTOMER_PASSWORD
     *
     * @var int
     */
    protected const MAX_LENGTH_CUSTOMER_PASSWORD = 64;
    /**
     * @var bool
     */
    protected const IS_ORDER_HISTORY_SEARCH_ENABLED = true;
    /**
     * @uses \Spryker\Shared\Sales\SalesConfig::ORDER_SEARCH_TYPES
     *
     * @var array<int, string>
     */
    protected const ORDER_SEARCH_TYPES = [
        'all',
        'orderReference',
        'orderName',
        'itemName',
        'itemSku',
    ];

    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function isDoubleOptInEnabled(): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @deprecated Will be removed without replacement. If the future the locale-specific URL will be used.
     *
     * @return bool
     */
    public function isLocaleInLoginCheckPath(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isRememberMeEnabled(): bool
    {
        return false;
    }
}
