<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubmissionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubmissionsTable Test Case
 */
class SubmissionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SubmissionsTable
     */
    public $Submissions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.submissions',
        'app.talktypes',
        'app.editions',
        'app.offers',
        'app.sponsors',
        'app.speakers',
        'app.settings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Submissions') ? [] : ['className' => 'App\Model\Table\SubmissionsTable'];
        $this->Submissions = TableRegistry::get('Submissions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Submissions);

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
