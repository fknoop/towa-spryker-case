<?php

declare(strict_types=1);

namespace Pyz\Zed\Sales\Business\OrderWriter;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderEntityTransfer;
use Spryker\Zed\Sales\Business\OrderWriter\SalesOrderWriter as SprykerOrderWriter;

class SalesOrderWriter extends SprykerOrderWriter
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\SpySalesOrderEntityTransfer $salesOrderEntityTransfer
     * @param string $orderReference
     *
     * @return \Generated\Shared\Transfer\SpySalesOrderEntityTransfer
     */
    protected function hydrateSalesOrderEntityTransfer(
        QuoteTransfer $quoteTransfer,
        SpySalesOrderEntityTransfer $salesOrderEntityTransfer,
        string $orderReference
    ): SpySalesOrderEntityTransfer {
        $salesOrderEntityTransfer->setCustomerReference($quoteTransfer->getCustomer()->getCustomerReference());
        $salesOrderEntityTransfer = $this->hydrateSalesOrderCustomer($quoteTransfer, $salesOrderEntityTransfer);
        $salesOrderEntityTransfer->setPriceMode($quoteTransfer->getPriceMode());
        $salesOrderEntityTransfer->setStore($quoteTransfer->getStore() ? $quoteTransfer->getStore()->getName() : $this->storeFacade->getCurrentStore()->getName());
        $salesOrderEntityTransfer->setCurrencyIsoCode($quoteTransfer->getCurrency()->getCode());
        $salesOrderEntityTransfer->setOrderReference($orderReference);
        $salesOrderEntityTransfer->setIsTest($this->salesConfiguration->isTestOrder($quoteTransfer));
        $salesOrderEntityTransfer->setOrderName($quoteTransfer->getOrderName());

        return $this->executeOrderExpanderPreSavePlugins($quoteTransfer, $salesOrderEntityTransfer);
    }
}
