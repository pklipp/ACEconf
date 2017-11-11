<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TalktypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TalktypesTable Test Case
 */
class TalktypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TalktypesTable
     */
    public $Talktypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.talktypes',
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
        $config = TableRegistry::exists('Talktypes') ? [] : ['className' => 'App\Model\Table\TalktypesTable'];
        $this->Talktypes = TableRegistry::get('Talktypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Talktypes);

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
