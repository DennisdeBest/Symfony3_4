<?php

namespace RC\CustomerBundle\Entity;

use \AcceptanceTester;
use JMS\Serializer\Tests\Fixtures\AccessorOrderParent;

class CustomerCest
{

    private $user = [
        'firstname' => 'John',
        'lastname' => 'Doe',
        'email' => 'john@doe.com'
    ];

    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    /**
     * @before removeCustomerIfExists
     * @param AcceptanceTester $I
     */
    protected function createCustomerFromForm(AcceptanceTester $I)
    {
        $I->wantTo('create a customer');
        $this->fillCustomerForm($I);
    }

    /**
     * Reused snippet to fill in the customer form
     * @param AcceptanceTester $I
     */
    protected function fillCustomerForm(AcceptanceTester $I)
    {
        $I->amOnPage('/app_test.php/app/customers');
        $I->click('Create');
        $I->fillField('Firstname', $this->user['firstname']);
        $I->fillField('Lastname', $this->user['lastname']);
        $I->fillField('Email', $this->user['email']);
        $I->click('Create');
    }

    /**
     * @before createCustomerFromForm
     * @param AcceptanceTester $I
     */
    public function checkThatCreatedUserIsInDatabase(AcceptanceTester $I)
    {
        $I->seeInRepository('RCCustomerBundle:Customer', ['email' => $this->user['email']]);
        $I->canSeeInCurrentUrl('/app_test.php/app/customers');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function createSameUserTwiceShouldFail(AcceptanceTester $I)
    {
        $I->wantTo('create a customer with an email that is already used');
        $this->fillCustomerForm($I);
        $I->canSeeInCurrentUrl('/app_test.php/app/customers/new');
    }

    /**
     * Delete the customer before retesting
     * @param AcceptanceTester $I
     */
    protected function removeCustomerIfExists(AcceptanceTester $I)
    {
        $I->wantTo('delete a customer');
        $I->amOnPage('/app_test.php/app/customers');
        $I->click('Delete');
    }
}
