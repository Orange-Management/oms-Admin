<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Admin\Models;

/**
 * Account class.
 *
 * @package    Modules\Admin
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Account extends \phpOMS\Account\Account
{
    /**
     * Remaining login tries.
     *
     * @var int
     * @since 1.0.0
     */
    protected $tries = 0;

    /**
     * Get remaining login tries
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function getLoginTries() : int
    {
        return $this->tries;
    }

    /**
     * Set remaining login tries
     *
     * @param int $tries Remaining login tries
     * 
     * @return void
     *
     * @since  1.0.0
     */
    public function setLoginTries(int $tries = 0) : void
    {
        $this->tries = $tries;
    }
}
