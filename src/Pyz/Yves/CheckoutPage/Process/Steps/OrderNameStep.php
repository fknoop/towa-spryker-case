<?php

declare(strict_types=1);

namespace Pyz\Yves\CheckoutPage\Process\Steps;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\Step\StepWithBreadcrumbInterface;
use SprykerShop\Yves\CheckoutPage\Process\Steps\AbstractBaseStep;

class OrderNameStep extends AbstractBaseStep implements StepWithBreadcrumbInterface
{
    /**
     * @var string
     */
    public const STEP_ORDER_NAME_TITLE_GLOSSARY_ENTRY = 'checkout.step.orderName.title';

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $quoteTransfer
     *
     * @return true
     */
    public function requireInput(AbstractTransfer $quoteTransfer): bool
    {
        return true;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function postCondition(AbstractTransfer $quoteTransfer): bool
    {
        return (bool)$quoteTransfer->getOrderName();
    }

    /**
     * @return string
     */
    public function getBreadcrumbItemTitle(): string
    {
        return self::STEP_ORDER_NAME_TITLE_GLOSSARY_ENTRY;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isBreadcrumbItemEnabled(AbstractTransfer $quoteTransfer): bool
    {
        return $this->postCondition($quoteTransfer);
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isBreadcrumbItemHidden(AbstractTransfer $quoteTransfer): bool
    {
        return false;
    }
}
