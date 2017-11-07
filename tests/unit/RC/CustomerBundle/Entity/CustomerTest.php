<?php
namespace RC\CustomerBundle\Entity;


class CustomerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testCustomerHasUuid(){
        $em = $this->getModule('Doctrine2')->em;
        $customer = new Customer();
        $customer->setFirstname('testFirstName');
        $customer->setLastname('testLastName');
        $customer->setEmail('test@mail.com');
        $customer->setPlainPassword('password');
        $em->persist($customer);
        $this->assertNotNull($customer->getUuid());
    }
}