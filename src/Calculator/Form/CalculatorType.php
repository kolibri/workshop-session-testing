<?php

namespace App\Calculator\Form;

use App\Calculator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalculatorType extends AbstractType
{
    public function __construct(private Calculator $calculator)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numberA', NumberType::class)
            ->add('modifier', ChoiceType::class, [
                'choices' => array_combine(
                    $this->calculator->getModifierNames(),
                    $this->calculator->getModifierNames()
                )])
            ->add('numberB', NumberType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CalculatorDto::class,
        ]);
    }
}
