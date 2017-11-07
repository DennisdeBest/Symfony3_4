<?php
namespace RC\ClubBundle\Entity;


class ClubTest extends \Codeception\Test\Unit
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

    public function testClubHasUuid(){

        $club = $this->createClub();

        $this->assertNotNull($club->getUuid());
    }

    protected function createClub(){
        $em = $this->getModule('Doctrine2')->em;
        $club = new Club();
        $club->setCompany('testCompany');
        $club->setAddress('testAddress');
        $em->persist($club);

        return $club;
    }
}