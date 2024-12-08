<?php

declare(strict_types=1);

namespace Pyz\Yves\CheckoutPage\Process;

use Pyz\Yves\CheckoutPage\Plugin\Router\CheckoutPageRouteProviderPlugin;
use Pyz\Yves\CheckoutPage\Process\Steps\OrderNameStep;
use SprykerShop\Yves\CheckoutPage\Process\StepFactory as SprykerStepFactory;

class StepFactory extends SprykerStepFactory
{
    /**
     * @return array<\Spryker\Yves\StepEngine\Dependency\Step\StepInterface>
     */
    public function getSteps(): array
    {
        return [
            $this->createEntryStep(),
            $this->createCustomerStep(),
            $this->createAddressStep(),
            $this->createOrderNameStep(),
            $this->createShipmentStep(),
            $this->createPaymentStep(),
            $this->createSummaryStep(),
            $this->createPlaceOrderStep(),
            $this->createSuccessStep(),
            $this->createErrorStep(),
        ];
    }

    /**
     * @return \Pyz\Yves\CheckoutPage\Process\Steps\OrderNameStep
     */
    public function createOrderNameStep(): OrderNameStep
    {
        return new OrderNameStep(
            CheckoutPageRouteProviderPlugin::ROUTE_NAME_CHECKOUT_ORDER_NAME,
            $this->getConfig()->getEscapeRoute(),
        );
    }
}
