<?php


namespace RC\CustomerBundle\Form\Type;


use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;
use RC\CoreBundle\Form\AddressType;
use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends BaseType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $var = 'place_autocomplete';
        $handle = "
            function () {
                var place = $var.getPlace();
                console.log('coucou')
                console.log(place)
            }";

        $event = new Event($var, 'place_changed', $handle);


        $builder
            ->add('firstname', TextType::class, [
                'label' => 'rc.form.customer.firstname',
                'required' => true,
            ])
            ->add('lastname', TextType::class, [
                'label' => 'rc.form.customer.lastname',
                'required' => true,
            ])
            ->add('email', TextType::class, [
                'label' => 'rc.form.customer.email',
                'required' => true,
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'rc.form.customer.enabled',
                'required' => true,
            ])
            ->add('address', AddressType::class, [
                'label' => 'rc.form.customer.address',
            ]);


    }

    public function getBlockPrefix()
    {
        return 'rc_customer_registration';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}