<?php
declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class LoginFormType
 * @package App\Form
 */
class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', null, [
                'attr' => ['class' => 'ea-form__field'],
                'label_attr' => ['class' => 'ea-form__label']
            ])
            ->add('_password', PasswordType::class, [
                'attr' => ['class' => 'ea-form__field'],
                'label_attr' => ['class' => 'ea-form__label']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr' => ['class' => 'ea-form__inside']
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_login_form_type';
    }
}
