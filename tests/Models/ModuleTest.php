<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Admin\tests\Models;

use Modules\Admin\Models\Module;
use phpOMS\Module\ModuleStatus;

/**
 * @testdox Modules\Admin\tests\Models\ModuleTest: Module container
 *
 * @internal
 */
class ModuleTest extends \PHPUnit\Framework\TestCase
{
    protected Module $module;

    protected function setUp() : void
    {
        $this->module = new Module();
    }

    /**
     * @testdox The module has the expected default values after initialization
     * @covers Modules\Admin\Models\Module
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->module->getId());
        self::assertInstanceOf('\DateTimeImmutable', $this->module->createdAt);
        self::assertEquals('', $this->module->name);
        self::assertEquals('', $this->module->description);
        self::assertEquals(ModuleStatus::INACTIVE, $this->module->getStatus());
        self::assertEquals(\json_encode($this->module->jsonSerialize()), $this->module->__toString());
        self::assertEquals($this->module->jsonSerialize(), $this->module->toArray());
    }

    /**
     * @testdox The name can be set and returned
     * @covers Modules\Admin\Models\Module
     * @group module
     */
    public function testNameInputOutput() : void
    {
        $this->module->name = 'Name';
        self::assertEquals('Name', $this->module->name);
    }

    /**
     * @testdox The description can be set and returned
     * @covers Modules\Admin\Models\Module
     * @group module
     */
    public function testDescriptionInputOutput() : void
    {
        $this->module->description = 'Desc';
        self::assertEquals('Desc', $this->module->description);
    }

    /**
     * @testdox The status can be set and returned
     * @covers Modules\Admin\Models\Module
     * @group module
     */
    public function testStatusInputOutput() : void
    {
        $this->module->setStatus(ModuleStatus::ACTIVE);
        self::assertEquals(ModuleStatus::ACTIVE, $this->module->getStatus());
    }

    /**
     * @testdox The module can be serialized
     * @covers Modules\Admin\Models\Module
     * @group module
     */
    public function testSerializations() : void
    {
        self::assertEquals(\json_encode($this->module->jsonSerialize()), $this->module->__toString());
        self::assertEquals($this->module->jsonSerialize(), $this->module->toArray());
    }

    /**
     * @testdox A invalid status throws a InvalidEnumValue exception
     * @covers Modules\Admin\Models\Module
     * @group module
     */
    public function testInvalidStatus() : void
    {
        $this->expectException(\phpOMS\Stdlib\Base\Exception\InvalidEnumValue::class);

        $this->module->setStatus(9999);
    }
}
