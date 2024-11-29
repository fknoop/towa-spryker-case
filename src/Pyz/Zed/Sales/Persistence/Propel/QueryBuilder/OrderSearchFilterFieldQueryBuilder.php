<?php

declare(strict_types=1);

namespace Pyz\Zed\Sales\Persistence\Propel\QueryBuilder;

use Generated\Shared\Transfer\SpySalesOrderEntityTransfer;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderTableMap;
use Spryker\Zed\Sales\Persistence\Propel\QueryBuilder\OrderSearchFilterFieldQueryBuilder as SprykerOrderSearchFilterFieldQueryBuilder;

class OrderSearchFilterFieldQueryBuilder extends SprykerOrderSearchFilterFieldQueryBuilder
{
    /**
     * @var array<string, string>
     */
    protected const ORDER_BY_COLUMN_MAPPING = [
        self::SEARCH_TYPE_ORDER_REFERENCE => SpySalesOrderTableMap::COL_ID_SALES_ORDER,
        'date' => SpySalesOrderTableMap::COL_CREATED_AT,
        SpySalesOrderEntityTransfer::ORDER_NAME => SpySalesOrderTableMap::COL_ORDER_NAME,
    ];
}