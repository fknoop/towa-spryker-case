<?php

declare(strict_types=1);

namespace Pyz\Yves\CheckoutPage\Form\Steps;

use Spryker\Yves\Kernel\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @method \Pyz\Yves\CheckoutPage\CheckoutPageConfig getConfig()
 */
class OrderNameForm extends AbstractType
{
    public const FIELD_ORDER_NAME = 'orderName';
    public const GLOSSARY_LABEL_ORDER_NAME = 'page.checkout.order_name.label';

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'orderNameForm';
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addOrderNameField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addOrderNameField(FormBuilderInterface $builder)
    {
        $builder->add(static::FIELD_ORDER_NAME, TextType::class, [
            'label' => self::GLOSSARY_LABEL_ORDER_NAME,
            'required' => true,
        ]);

        return $this;
    }
}
