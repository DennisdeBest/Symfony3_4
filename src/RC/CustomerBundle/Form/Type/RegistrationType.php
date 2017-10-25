<?php


namespace RC\CustomerBundle\Form\Type;


use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends BaseType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label'    => 'rc.form.customer.firstname',
                'required' => true,
            ])
            ->add('lastname', TextType::class, [
                'label'    => 'rc.form.customer.lastname',
                'required' => true,
            ])
            ->add('email', TextType::class, [
                'label'    => 'rc.form.customer.email',
                'required' => true,
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'rc.form.customer.enabled',
                'required' => true,
            ]);

    }

    public function getBlockPrefix()
    {
        return 'rc_customer_registration';
    }

    public function getName(){
        return $this->getBlockPrefix();
    }
}