<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProductFormType
 * @package App\Form
 */
class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'attr' => ['class' => 'ea-form__field'],
                'label_attr' => ['class' => 'ea-form__label']
            ])
            ->add('kkal_per_100gr', null, [
                'attr' => ['class' => 'ea-form__field' ],
                'label_attr' => ['class' => 'ea-form__label']
            ])
            ->add('proteins_per_100gr', null, [
                'attr' => ['class' => 'ea-form__field' ],
                'label_attr' => ['class' => 'ea-form__label']
            ])
            ->add('fats_per_100gr', null, [
                'attr' => ['class' => 'ea-form__field' ],
                'label_attr' => ['class' => 'ea-form__label']
            ])
            ->add('carbohydrates_per_100gr', null, [
                'attr' => ['class' => 'ea-form__field' ],
                'label_attr' => ['class' => 'ea-form__label']
            ])
            ->add('rating', ChoiceType::class, [
                'attr' => ['class' => 'ea-form__field' ],
                'label_attr' => ['class' => 'ea-form__label'],
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6
                ]
            ])
            ->add('image', FileType::class, [
                'label' => 'Download image (png, jpeg, jpg)',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_products_form_type';
    }
}
