<?php


namespace RC\AdminBundle\Fixture;


use Doctrine\ORM\EntityManager;
use Faker\Generator;
use RC\AdminBundle\Entity\Admin;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Bundle\FixturesBundle\Fixture\FixtureInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AdminFixture extends AbstractFixture implements FixtureInterface
{
    private $container;

    private $em;

    /**
     * @param ContainerInterface $container
     * @param EntityManager $em
     * @internal param Generator $faker
     */
    public function __construct(ContainerInterface $container, EntityManager $em)
    {
        $this->container = $container;
        $this->em = $em;
    }

    /**
     * @param array $options
     */
    public function load(array $options)
    {
        /** @var EntityManager $adminManager */
        $adminManager = $this->em;
        /** @var Generator $faker */
        //Create the first user with defined attributes
        $admin = new Admin();
        $admin->setEmail($options['user']);
        $admin->setPlainPassword('password');
        $admin->setUsername('admin');
        $admin->setEnabled(true);
        $admin->setRoles(['ROLE_SUPER_ADMIN']);
        $adminManager->persist($admin);

        $adminManager->flush();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'admin';
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode)
    {
        $optionsNode
            ->children()
            ->scalarNode('user')
            ->defaultValue('admin@symfony.com');
    }
}