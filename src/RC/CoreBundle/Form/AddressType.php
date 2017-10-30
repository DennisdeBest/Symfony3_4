<?php


namespace RC\CoreBundle\Form;


use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Set the event handler to capture the google place id and put it's value in the hidden field
        $form_id = $options['form_name'];
        $place_id_selector = '"'.$form_id.'['.$this->getName().'][place_id]"';
        $var = 'place_autocomplete';
        $handle = "
            function () {
            var place_id_input = document.getElementsByName($place_id_selector);
            var place = $var.getPlace();
            place_id_input[0].value = place.place_id;
            }";

        $event = new Event($var, 'place_changed', $handle);


        $builder
            ->add('address', PlaceAutocompleteType::class, [
                'variable' => $var,
                'events' => [$event]
            ])
            ->add('place_id', HiddenType::class, [
            ]);


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_mapping' => array(
                'addressHasPlaceId' => 'address',
            ),
        'error_bubbling' => false,
        'inherit_data' => true,
        'form_name' => null,
    ));
    }

    public function getBlockPrefix()
    {
        return 'address';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}