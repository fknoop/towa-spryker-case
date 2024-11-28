<?php

declare(strict_types=1);

namespace Pyz\Yves\CheckoutPage\Form;

use Pyz\Yves\CheckoutPage\Form\Steps\OrderNameForm;
use Spryker\Yves\StepEngine\Form\FormCollectionHandlerInterface;
use SprykerShop\Yves\CheckoutPage\Form\FormFactory as SprykerFormFactory;

/**
 * @method \SprykerShop\Yves\CheckoutPage\CheckoutPageConfig getConfig()
 */
class FormFactory extends SprykerFormFactory
{
    /**
     * @return array<string>
     */
    public function getOrderNameFormTypes(): array
    {
        return [
            $this->getOrderNameForm(),
        ];
    }

    /**
     * @return string
     */
    public function getOrderNameForm(): string
    {
        return OrderNameForm::class;
    }

    /**
     * @return \Spryker\Yves\StepEngine\Form\FormCollectionHandlerInterface
     */
    public function createOrderNameFormCollection(): FormCollectionHandlerInterface
    {
        return $this->createFormCollection($this->getOrderNameFormTypes());
    }
}
