<?php

declare(strict_types=1);

namespace PyzTest\Yves\Checkout\Process\Steps;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Pyz\Yves\CheckoutPage\CheckoutPageConfig;
use Pyz\Yves\CheckoutPage\Plugin\Router\CheckoutPageRouteProviderPlugin;
use Pyz\Yves\CheckoutPage\Process\Steps\OrderNameStep;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Yves
 * @group Checkout
 * @group Process
 * @group Steps
 * @group OrderNameStepTest
 * Add your own group annotations below this line
 */
class OrderNameStepTest extends Unit
{
    /**
     * @var \PyzTest\Yves\Checkout\CheckoutBusinessTester
     */
    public $tester;

    /**
     * @return void
     */
    public function testOrderNamePostConditionsShouldReturnTrueWhenOrderNameIsSet(): void
    {
        $quoteTransfer = (new QuoteTransfer())->setOrderName('ordernametest');

        $orderNameStep = $this->createOrderNameStep();

        $this->assertTrue($orderNameStep->postCondition($quoteTransfer));
    }

    /**
     * @return \Pyz\Yves\CheckoutPage\Process\Steps\OrderNameStep
     */
    protected function createOrderNameStep(): OrderNameStep
    {
        return new OrderNameStep(
            CheckoutPageRouteProviderPlugin::ROUTE_NAME_CHECKOUT_ORDER_NAME,
            CheckoutPageConfig::ESCAPE_ROUTE,
        );
    }
}
