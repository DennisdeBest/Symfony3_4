<?php


namespace RC\CustomerBundle\Fixture;


use Doctrine\ORM\EntityManager;
use Faker\Generator;
use RC\CustomerBundle\Entity\Customer;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Bundle\FixturesBundle\Fixture\FixtureInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CustomerFixture extends AbstractFixture implements FixtureInterface
{
    private $container;

    /**
     * @param ContainerInterface $container
     * @param Generator $faker
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param array $options
     */
    public function load(array $options)
    {
        /** @var Container $container */
        $container = $this->container;

        /** @var EntityManager $customerManager */
        $customerManager = $container->get('rc.manager.customer');

        /** @var Generator $faker */
        $faker = $container->get('davidbadura_faker.faker');

        //Create the first user with defined attributes
        $customer = new Customer();
        $customer->setEmail($options['user']);
        $customer->setFirstname('John');
        $customer->setLastname('Doe');
        $customer->setPlainPassword('password');
        $customer->setEnabled(true);
        $customer->setAddress('Troll Burger, Via di Val Favara, Rome, Metropolitan City of Rome, Italy');
        $customer->setPlaceId('ChIJ6zcUBzheLxMRnH6uFN2zqKw');

        $customerManager->persist($customer);

        for($i=0;$i<=$options['amount'];$i++){
            $customer = new Customer();
            $customer->setFirstname($faker->firstName());
            $customer->setLastname($faker->lastName);
            $customer->setEmail($faker->email);
            $customer->setEnabled(true);
            $customer->setPlainPassword('password');

            $customerManager->persist($customer);
        }

        $customerManager->flush();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'customer';
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode)
    {
        $optionsNode
            ->children()
            ->integerNode('amount')
            ->defaultValue(10);

        $optionsNode
            ->children()
            ->scalarNode('user')
            ->defaultValue('admin@symfony.com');
    }
}