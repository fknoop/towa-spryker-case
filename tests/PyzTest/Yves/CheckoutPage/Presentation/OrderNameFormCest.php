<?php

declare(strict_types=1);

namespace PyzTest\Yves\CheckoutPage\Presentation;

use Generated\Shared\Transfer\LocaleTransfer;
use Pyz\Yves\CheckoutPage\Form\Steps\OrderNameForm;
use PyzTest\Yves\CheckoutPage\CheckoutPagePresentationTester;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Yves
 * @group CheckoutPage
 * @group Presentation
 * @group OrderNameFormCest
 * Add your own group annotations below this line
 */
class OrderNameFormCest
{
    public const GLOSSARY_ORDER_NAME_TITLE = 'checkout.step.order_name.title';
    public const CATEGORY_URL = '/en/stationery';
    public const CHECKOUT_URL = '/checkout';
    public const SHIPMENT_URL = '/checkout/shipment';
    public const ORDER_NAME_URL = '/checkout/order-name';
    public const VALID_ORDER_NAME = 'validname123';
    public const INVALID_ORDER_NAME = 'InvalidName123#';

    public LocaleTransfer $locale;

    /**
     * @param \PyzTest\Yves\CheckoutPage\CheckoutPagePresentationTester $i
     *
     * @return void
     */
    public function _before(CheckoutPagePresentationTester $i): void
    {
        $i->amYves();

        $customer = $i->amLoggedInCustomer();
        $this->locale = $i->getCustomerFacade()->getCustomer($customer)->getLocale();

        // Initially add product to cart
        $i->amOnPage(static::CATEGORY_URL);
        $i->click('Add to Cart', '.product-item');
        $i->wait(1);

        // Proceed to Order name step
        $i->amOnPage(static::CHECKOUT_URL);
        $i->processAddressStep();
        $i->click('[data-qa="submit-button"]');
    }

    /**
     * @param \PyzTest\Yves\CheckoutPage\CheckoutPagePresentationTester $i
     *
     * @return void
     */
    public function testRenderOrderNameForm(CheckoutPagePresentationTester $i): void
    {
        $i->amOnPage(static::ORDER_NAME_URL);
        $i->seeElement('input[name="orderNameForm[orderName]"]');
        $i->see($this->translateGlossaryEntry($i, static::GLOSSARY_ORDER_NAME_TITLE), 'label[for="orderNameForm_orderName"]');
        $i->see($this->translateGlossaryEntry($i, OrderNameForm::GLOSSARY_HELP_TEXT_ORDER_NAME), '#orderNameForm_orderName_help');
    }

    /**
     * @param \PyzTest\Yves\CheckoutPage\CheckoutPagePresentationTester $i
     *
     * @return void
     */
    public function testSubmitValidOrderName(CheckoutPagePresentationTester $i): void
    {
        $i->amOnPage(static::ORDER_NAME_URL);
        $i->fillField('orderNameForm[orderName]', static::VALID_ORDER_NAME);
        $i->click('[data-qa="submit-button"]');

        $currentUrl = $i->grabFromCurrentUrl();
        $i->dontSeeElement('.list--alert');
        $i->assertStringContainsString(static::SHIPMENT_URL, $currentUrl);
    }

    /**
     * @param \PyzTest\Yves\CheckoutPage\CheckoutPagePresentationTester $i
     *
     * @return void
     */
    public function testSubmitInvalidOrderName(CheckoutPagePresentationTester $i): void
    {
        $i->amOnPage(static::ORDER_NAME_URL);
        $i->fillField('orderNameForm[orderName]', static::INVALID_ORDER_NAME);
        $i->click('[data-qa="submit-button"]');

        $i->seeElement('.list--alert');
        $i->seeInFormFields('#order-name-form', ['orderNameForm[orderName]' => static::INVALID_ORDER_NAME]);
        $i->see($this->translateGlossaryEntry($i, OrderNameForm::GLOSSARY_VALIDATION_LOWERCASE_NUMBERS_MESSAGE), '.list__item');
    }

    /**
     * @param \PyzTest\Yves\CheckoutPage\CheckoutPagePresentationTester $i
     *
     * @return void
     */
    public function testSubmitEmptyOrderName(CheckoutPagePresentationTester $i): void
    {
        $i->amOnPage(static::ORDER_NAME_URL);
        $i->fillField('orderNameForm[orderName]', '');
        $i->click('[data-qa="submit-button"]');

        $i->seeElement('.list--alert');
        $i->seeInFormFields('#order-name-form', ['orderNameForm[orderName]' => '']);
        $i->see($this->translateGlossaryEntry($i, OrderNameForm::GLOSSARY_VALIDATION_NOT_BLANK_MESSAGE), '.list__item');
    }

    /**
     * @param \PyzTest\Yves\CheckoutPage\CheckoutPagePresentationTester $i
     *
     * @return void
     */
    public function testSubmitOrderNameExceedingMaxLength(CheckoutPagePresentationTester $i): void
    {
        $longString = str_repeat('a', OrderNameForm::VALIDATION_MAX_LENGTH + 1);

        $i->amOnPage(static::ORDER_NAME_URL);
        $i->fillField('orderNameForm[orderName]', $longString);
        $i->click('[data-qa="submit-button"]');

        $i->seeElement('.list--alert');
        $i->seeInFormFields('#order-name-form', ['orderNameForm[orderName]' => $longString]);

        $expectedMessage = $this->translateGlossaryEntry(
            $i,
            OrderNameForm::GLOSSARY_VALIDATION_MAX_LENGTH_MESSAGE,
            ['{{ limit }}' => OrderNameForm::VALIDATION_MAX_LENGTH],
        );

        $i->see($expectedMessage, '.list__item');
    }

    /**
     * @param \PyzTest\Yves\CheckoutPage\CheckoutPagePresentationTester $i
     * @param string $entry
     * @param $data
     *
     * @return string
     */
    private function translateGlossaryEntry(CheckoutPagePresentationTester $i, string $entry, $data = []): string
    {
        return $i->getLocator()->glossary()->facade()->translate($entry, $data, $this->locale);
    }
}
