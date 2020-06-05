<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
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
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Admin\Models\Account', new NullAccount());
    }

    public function testId() : void
    {
        $null = new NullAccount(2);
        self::assertEquals(2, $null->getId());
    }
}