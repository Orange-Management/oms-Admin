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

use Modules\Admin\Models\NullAccount;

/**
 * @internal
 */
final class NullAccountTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Admin\Models\NullAccount
     * @group module
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Admin\Models\Account', new NullAccount());
    }

    /**
     * @covers Modules\Admin\Models\NullAccount
     * @group module
     */
    public function testId() : void
    {
        $null = new NullAccount(2);
        self::assertEquals(2, $null->getId());
    }
}
