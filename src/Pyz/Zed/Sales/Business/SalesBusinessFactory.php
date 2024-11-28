<?php

declare(strict_types=1);

namespace Pyz\Zed\Sales\Business;

use Pyz\Zed\Sales\Business\OrderWriter\SalesOrderWriter;
use Spryker\Zed\Sales\Business\SalesBusinessFactory as SprykerSalesBusinessFactory;

/**
 * @method \Pyz\Zed\Sales\SalesConfig getConfig()
 * @method \Spryker\Zed\Sales\Persistence\SalesRepositoryInterface getRepository()
 * @method \Spryker\Zed\Sales\Persistence\SalesQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Sales\Persistence\SalesEntityManagerInterface getEntityManager()
 */
class SalesBusinessFactory extends SprykerSalesBusinessFactory
{
    /**
     * @return \Pyz\Zed\Sales\Business\OrderWriter\SalesOrderWriter
     */
    public function createSalesOrderWriter(): SalesOrderWriter
    {
        return new SalesOrderWriter(
            $this->getCountryFacade(),
            $this->getStoreFacade(),
            $this->createReferenceGenerator(),
            $this->getConfig(),
            $this->getLocaleFacade(),
            $this->getOrderExpanderPreSavePlugins(),
            $this->getOrderPostSavePlugins(),
            $this->getEntityManager(),
        );
    }
}
