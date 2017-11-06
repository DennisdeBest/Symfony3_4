<?php
namespace RC\CustomerBundle\Entity;
use \AcceptanceTester;

class CustomerCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    /**
     * Todo delete user from database
     * @param AcceptanceTester $I
     */
    protected function createCustomerFromForm(AcceptanceTester $I)
    {
        $I->wantTo('create a customer');
        $I->amOnPage('/app_dev.php/app/customers');
        $I->click('Create');
        $I->fillField('Firstname', 'john');
        $I->fillField('Lastname', 'doe');
        $I->fillField('Email', 'john@doe.com');
        $I->click('Create');
    }

    /**
     * @before createCustomerFromForm
     * @param AcceptanceTester $I
     */
    public function checkThatCreatedUserIsInDatabase(AcceptanceTester $I)
    {
        $I->seeInRepository('RCCustomerBundle:Customer', ['email' => 'john@doe.com']);
    }

    protected function removeCustomerIfExists(AcceptanceTester $I){

    }
}
