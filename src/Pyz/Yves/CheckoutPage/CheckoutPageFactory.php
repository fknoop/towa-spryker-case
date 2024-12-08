<?php

declare(strict_types=1);

namespace Pyz\Yves\CheckoutPage;

use Pyz\Yves\CheckoutPage\Form\FormFactory;
use Pyz\Yves\CheckoutPage\Process\StepFactory;
use SprykerShop\Yves\CheckoutPage\CheckoutPageFactory as SprykerCheckoutPageFactory;

class CheckoutPageFactory extends SprykerCheckoutPageFactory
{
    /**
     * @return \Pyz\Yves\CheckoutPage\Process\StepFactory
     */
    public function createStepFactory(): StepFactory
    {
        return new StepFactory();
    }

    /**
     * @return \Pyz\Yves\CheckoutPage\Form\FormFactory
     */
    public function createCheckoutFormFactory(): FormFactory
    {
        return new FormFactory();
    }
}
