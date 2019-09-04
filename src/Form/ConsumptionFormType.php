<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Consumption;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ConsumptionFormType
 * @package App\Form
 */
class ConsumptionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', EntityType::class, [
                'class' => 'App\Entity\Products',
                'choice_label' => 'name',
            ])
            ->add('how_much', IntegerType::class, [
                'attr' => ['class' => 'ea-form__field'],
                'label_attr' => ['class' => 'ea-form__label']
            ])
            ->add('meals_of_the_day', ChoiceType::class, [
                'attr' => ['class' => 'ea-form__field'],
                'label_attr' => ['class' => 'ea-form__label'],
                'choices' => [
                    'Breakfast' => 'Breakfast',
                    'Dinner' => 'Dinner',
                    'Supper' => 'Supper'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consumption::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_consumption_form_type';
    }
}
