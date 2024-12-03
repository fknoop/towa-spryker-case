<?php

declare(strict_types=1);

namespace Pyz\Yves\CheckoutPage\Form\Steps;

use Spryker\Yves\Kernel\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * @method \Pyz\Yves\CheckoutPage\CheckoutPageConfig getConfig()
 */
class OrderNameForm extends AbstractType
{
    /**
     * @var string
     */
    public const FIELD_ORDER_NAME = 'orderName';
    /**
     * @var string
     */
    public const GLOSSARY_LABEL_ORDER_NAME = 'page.checkout.order_name.label';
    /**
     * @var string
     */
    public const GLOSSARY_VALIDATION_NOT_BLANK_MESSAGE = 'validation.not_blank';
    /**
     * @var string
     */
    public const GLOSSARY_VALIDATION_MAX_LENGTH_MESSAGE = 'validation.max_length.plural';
    /**
     * @var string
     */
    public const GLOSSARY_VALIDATION_LOWERCASE_NUMBERS_MESSAGE = 'validation.lowercase_numbers';
    /**
     * @var string
     */
    public const GLOSSARY_HELP_TEXT_ORDER_NAME = 'page.checkout.order_name.help';
    /**
     * @var int
     */
    public const VALIDATION_MAX_LENGTH = 30;
    /**
     * @var string
     */
    public const VALIDATION_REGEX_PATTERN = '/^[a-z0-9]+$/';

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
            'help' => static::GLOSSARY_HELP_TEXT_ORDER_NAME,
            'constraints' => [
                new NotBlank([
                    'message' => static::GLOSSARY_VALIDATION_NOT_BLANK_MESSAGE,
                ]),
                new Length([
                    'max' => static::VALIDATION_MAX_LENGTH,
                    'maxMessage' => static::GLOSSARY_VALIDATION_MAX_LENGTH_MESSAGE,
                ]),
                new Regex([
                    'pattern' => static::VALIDATION_REGEX_PATTERN,
                    'message' => static::GLOSSARY_VALIDATION_LOWERCASE_NUMBERS_MESSAGE,
                ]),
            ],
        ]);

        return $this;
    }
}
