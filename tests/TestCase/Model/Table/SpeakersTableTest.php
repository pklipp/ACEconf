<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SpeakersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SpeakersTable Test Case
 */
class SpeakersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SpeakersTable
     */
    public $Speakers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.speakers',
        'app.offers',
        'app.sponsors',
        'app.editions',
        'app.settings',
        'app.submissions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Speakers') ? [] : ['className' => 'App\Model\Table\SpeakersTable'];
        $this->Speakers = TableRegistry::get('Speakers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Speakers);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
