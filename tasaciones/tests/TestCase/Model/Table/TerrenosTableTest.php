<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TerrenosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TerrenosTable Test Case
 */
class TerrenosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TerrenosTable
     */
    public $Terrenos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.terrenos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Terrenos') ? [] : ['className' => 'App\Model\Table\TerrenosTable'];
        $this->Terrenos = TableRegistry::get('Terrenos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Terrenos);

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
