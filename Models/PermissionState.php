<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\Admin\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Admin\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package Modules\Admin\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
abstract class PermissionState extends Enum
{
    public const SETTINGS = 1;

    public const ACCOUNT = 2;

    public const GROUP = 3;

    public const MODULE = 4;

    public const LOG = 5;

    public const ROUTE = 6;

    public const APP = 7;

    public const ACCOUNT_SETTINGS = 8;

    public const SEARCH = 9;
}
