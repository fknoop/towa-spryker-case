<?php

declare(strict_types=1);

namespace PyzTest\Yves\CheckoutPage\Form;

use Pyz\Yves\CheckoutPage\Form\Steps\OrderNameForm;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\Validation;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Yves
 * @group CheckoutPage
 * @group Form
 * @group OrderNameFormTest
 * Add your own group annotations below this line
 */
class OrderNameFormTest extends TypeTestCase
{
    public const VALID_ORDER_NAME = 'validname123';
    public const INVALID_ORDER_NAME = 'InvalidName123#';

    /**
     * @var \Symfony\Component\Form\FormInterface
     */
    private FormInterface $form;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->form = $this->factory->create(OrderNameForm::class);
    }

    /**
     * @return void
     */
    public function testFormConfiguration(): void
    {
        // Assert
        $this->assertTrue($this->form->has(OrderNameForm::FIELD_ORDER_NAME));

        $orderNameField = $this->getOrderNameField();

        $this->assertEquals(OrderNameForm::GLOSSARY_LABEL_ORDER_NAME, $orderNameField->getConfig()->getOption('label'));
        $this->assertEquals(OrderNameForm::GLOSSARY_HELP_TEXT_ORDER_NAME, $orderNameField->getConfig()->getOption('help'));
        $this->assertTrue($orderNameField->getConfig()->getOption('required'));
    }

    /**
     * @return void
     */
    public function testSubmitValidOrderName(): void
    {
        // Arrange
        $data = [
            OrderNameForm::FIELD_ORDER_NAME => static::VALID_ORDER_NAME,
        ];

        // Act
        $this->form->submit($data);

        // Assert
        $this->assertTrue($this->form->isSynchronized());
        $this->assertEquals($data, $this->form->getData());
        $this->assertTrue($this->form->isValid());
    }

    /**
     * @return void
     */
    public function testSubmitInvalidOrderName(): void
    {
        // Arrange
        $data = [
            OrderNameForm::FIELD_ORDER_NAME => static::INVALID_ORDER_NAME,
        ];

        // Act
        $this->form->submit($data);

        // Assert
        $this->assertTrue($this->form->isSynchronized());
        $this->assertFalse($this->form->isValid());

        $errors = $this->getOrderNameField()->getErrors();

        $this->assertCount(1, $errors);
        $this->assertSame(OrderNameForm::GLOSSARY_VALIDATION_LOWERCASE_NUMBERS_MESSAGE, $errors[0]->getMessage());
    }

    /**
     * @return void
     */
    public function testSubmitEmptyOrderName(): void
    {
        // Arrange
        $data = [
            OrderNameForm::FIELD_ORDER_NAME => '',
        ];

        // Act
        $this->form->submit($data);

        // Assert
        $this->assertTrue($this->form->isSynchronized());
        $this->assertFalse($this->form->isValid());

        $errors = $this->getOrderNameField()->getErrors();

        $this->assertCount(1, $errors);
        $this->assertSame(OrderNameForm::GLOSSARY_VALIDATION_NOT_BLANK_MESSAGE, $errors[0]->getMessage());
    }

    /**
     * @return void
     */
    public function testSubmitOrderNameExceedingMaxLength(): void
    {
        // Arrange
        $data = [
            OrderNameForm::FIELD_ORDER_NAME => str_repeat('a', OrderNameForm::VALIDATION_MAX_LENGTH + 1),
        ];

        // Act
        $this->form->submit($data);

        // Assert
        $this->assertTrue($this->form->isSynchronized());
        $this->assertFalse($this->form->isValid());

        $errors = $this->getOrderNameField()->getErrors();

        $this->assertCount(1, $errors);
        $this->assertSame(OrderNameForm::GLOSSARY_VALIDATION_MAX_LENGTH_MESSAGE, $errors[0]->getMessage());
    }

    /**
     * @return \Symfony\Component\Form\Extension\Validator\ValidatorExtension[]
     */
    protected function getExtensions(): array
    {
        $validator = Validation::createValidator();

        return [
            new ValidatorExtension($validator),
        ];
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    private function getOrderNameField(): FormInterface
    {
        return $this->form->get(OrderNameForm::FIELD_ORDER_NAME);
    }
}
