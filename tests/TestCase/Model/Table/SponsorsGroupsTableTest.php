<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SponsorsGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SponsorsGroupsTable Test Case
 */
class SponsorsGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SponsorsGroupsTable
     */
    public $SponsorsGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sponsors_groups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SponsorsGroups') ? [] : ['className' => 'App\Model\Table\SponsorsGroupsTable'];
        $this->SponsorsGroups = TableRegistry::get('SponsorsGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SponsorsGroups);

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
