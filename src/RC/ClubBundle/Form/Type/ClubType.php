<?php


namespace RC\ClubBundle\Form\Type;


use Doctrine\DBAL\Types\StringType;
use RC\ClubBundle\Entity\Club;
use RC\CoreBundle\Form\AddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ClubType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', StringType::class, [
            'label'=> 'rc.form.club.name',
            'required' => true,
        ])
            ->add('website', StringType::class, [
                'label' => 'rc.form.club.website',
                'required' => false,
            ])
            ->add('address', AddressType::class, [
                'label' => 'rc.form.customer.address',
                'data_class' => Club::class,
                'form_name' => $this->getName()
            ]);
        ;

    }

    public function getBlockPrefix()
    {
        return 'rc_club';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }


}