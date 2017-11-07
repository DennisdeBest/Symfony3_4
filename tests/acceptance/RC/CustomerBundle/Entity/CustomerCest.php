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

    private $baseUrl = '/app_test.php/admin/customers';

    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    /**
     * @param AcceptanceTester $I
     * @return AcceptanceTester
     */
    private function loginAsAdmin(AcceptanceTester $I){
        $I->wantTo('Login as admin');
        $I->amOnPage('/app_test.php/login');
        $I->fillField('Username', 'admin');
        $I->fillField('Password', 'password');
        $I->click('#_submit');
        return $I;
    }

    /**
     * @param AcceptanceTester $I
     */
    protected function createCustomerFromForm(AcceptanceTester $I)
    {
        $I = $this->loginAsAdmin($I);
        $I->wantTo('create a customer');
        $I->amOnPage($this->baseUrl);
        $this->fillCustomerForm($I);
    }

    /**
     * Reused snippet to fill in the customer form
     * @param AcceptanceTester $I
     * @param bool $withAddress
     */
    protected function fillCustomerForm(AcceptanceTester $I, $withAddress = false, $withPlace = false)
    {
        $I->amOnPage($this->baseUrl);
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
    protected function removeLastCustomer(AcceptanceTester $I)
    {
        $I->amOnPage($this->baseUrl);
        $I->performOn('div.pagination .item:nth-last-child(2)', ['click' => 'div.pagination .item:nth-last-child(2)'], 5); //click last page
        $I->performOn('.trash', ['click' => 'tbody .item:last-child .trash'], 5);
    }


    /**
     * @param AcceptanceTester $I
     */
    protected function checkThatCreatedUserIsInDatabase(AcceptanceTester $I)
    {
        $I->seeInRepository('RCCustomerBundle:Customer', ['email' => $this->user['email']]);
        $I->canSeeInCurrentUrl($this->baseUrl);
    }

    /**
     * @param AcceptanceTester $I
     */
    protected function createSameUserTwiceShouldFail(AcceptanceTester $I)
    {
        $I->wantTo('create a customer with an email that is already used');
        $this->fillCustomerForm($I);
        $I->canSeeInCurrentUrl($this->baseUrl.'/new');
    }

    /**
     * @param AcceptanceTester $I
     */
    protected function createAddressWithoutPlaceIdIsImpossible(AcceptanceTester $I){
        $I->wantTo('create a customer with an an address and no placeId');
        $this->fillCustomerForm($I, true);
        $I->canSeeInCurrentUrl($this->baseUrl.'/new');
    }

    /**
     * @param AcceptanceTester $I
     */
    protected function createUserWithAddress(AcceptanceTester $I){
        $I->wantTo('create a customer with an an address');
        $this->fillCustomerForm($I, true, true);
        $I->canSeeInCurrentUrl($this->baseUrl);
    }


    /**
     * User needs to be logged in to perform tests
     * in order to keep the user logged in we need to pass $I to the test functions
     * @param AcceptanceTester $I
     */
    public function runTests(AcceptanceTester $I){
        $I = $this->loginAsAdmin($I);
        $this->createCustomerFromForm($I);
        $this->checkThatCreatedUserIsInDatabase($I);
        $this->createSameUserTwiceShouldFail($I);
        $this->createAddressWithoutPlaceIdIsImpossible($I);
        $this->removeLastCustomer($I);
        $this->createUserWithAddress($I);
    }
}
