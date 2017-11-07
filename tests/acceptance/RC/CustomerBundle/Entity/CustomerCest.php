<?php

namespace RC\CustomerBundle\Entity;

use \AcceptanceTester;

class CustomerCest
{

    private $user = [
        'firstname' => 'John',
        'lastname' => 'Doe',
        'email' => 'john@doe.com',
        'address' => 'Bordeaux'
    ];

    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    /**
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
     * @param bool $withAddress
     */
    protected function fillCustomerForm(AcceptanceTester $I, $withAddress = false, $withPlace = false)
    {
        $I->amOnPage('/app_test.php/app/customers');
        $I->click('Create');
        $I->fillField('Firstname', $this->user['firstname']);
        $I->fillField('Lastname', $this->user['lastname']);
        $I->fillField('Email', $this->user['email']);
        if($withAddress){
            $I->fillField('#rc_customer_registration_address_address', $this->user['address']);
            if($withPlace){
                $I->performOn('.pac-item-query', ['click' => '.pac-item-query'], 5);
            }
        }
        $I->click('Create');
    }

    /**
     * Delete the customer before retesting
     * @param AcceptanceTester $I
     */
    protected function removeCustomerIfExists(AcceptanceTester $I)
    {
        $I->amOnPage('/app_test.php/app/customers');
        $I->performOn('.trash', ['click' => 'Delete'], 5);
    }


    /***** Tests *****/

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
     * @param AcceptanceTester $I
     */
    public function createAddressWithoutPlaceIdIsImpossible(AcceptanceTester $I){
        $I->wantTo('create a customer with an an address and no placeId');
        $this->fillCustomerForm($I, true);
        $I->canSeeInCurrentUrl('/app_test.php/app/customers/new');
    }

    /**
     * @before removeCustomerIfExists
     * @param AcceptanceTester $I
     * @after removeCustomerIfExists
     */
    public function createUserWithAddress(AcceptanceTester $I){
        $I->wantTo('create a customer with an an address');
        $this->fillCustomerForm($I, true, true);
        $I->canSeeInCurrentUrl('/app_test.php/app/customers');
    }
}
