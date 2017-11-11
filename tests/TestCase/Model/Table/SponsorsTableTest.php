<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SponsorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SponsorsTable Test Case
 */
class SponsorsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SponsorsTable
     */
    public $Sponsors;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sponsors',
        'app.offers',
        'app.editions',
        'app.settings',
        'app.speakers',
        'app.submissions',
        'app.talktypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Sponsors') ? [] : ['className' => 'App\Model\Table\SponsorsTable'];
        $this->Sponsors = TableRegistry::get('Sponsors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sponsors);

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
}
