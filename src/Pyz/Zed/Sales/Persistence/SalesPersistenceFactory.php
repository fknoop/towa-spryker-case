<?php

declare(strict_types=1);

namespace Pyz\Zed\Sales\Persistence;

use Pyz\Zed\Sales\Persistence\Propel\QueryBuilder\OrderSearchFilterFieldQueryBuilder;
use Spryker\Zed\Sales\Persistence\SalesPersistenceFactory as SprykerSalesPersistenceFactory;

/**
 * @method \Pyz\Zed\Sales\SalesConfig getConfig()
 * @method \Spryker\Zed\Sales\Persistence\SalesQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Sales\Persistence\SalesEntityManagerInterface getEntityManager()
 * @method \Spryker\Zed\Sales\Persistence\SalesRepositoryInterface getRepository()
 */
class SalesPersistenceFactory extends SprykerSalesPersistenceFactory
{
    /**
     * @return \Pyz\Zed\Sales\Persistence\Propel\QueryBuilder\OrderSearchFilterFieldQueryBuilder
     */
    public function createOrderSearchFilterFieldQueryBuilder(): OrderSearchFilterFieldQueryBuilder
    {
        return new OrderSearchFilterFieldQueryBuilder();
    }
}
