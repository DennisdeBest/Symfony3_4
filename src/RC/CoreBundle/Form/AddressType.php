<?php


namespace RC\CoreBundle\Form;


use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
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
            ->add('address', PlaceAutocompleteType::class, [
                'variable' => $var,
                'events' => [$event],
            ])
            ->add('place_id', HiddenType::class, [
                'error_mapping' => [
                    '.' => 'Address'
                ]
            ]);


    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'error_mapping' => array(
                '.' => 'address',
            ),
        ));
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