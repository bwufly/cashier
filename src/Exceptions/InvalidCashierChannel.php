<?php
// +----------------------------------------------------------------------
// | InvalidCashierChannel.php
// +----------------------------------------------------------------------
// | Description: 
// +----------------------------------------------------------------------
// | Time: 2020/9/25 16:24
// +----------------------------------------------------------------------
// | Author: wufly <wfxykzd@163.com>
// +----------------------------------------------------------------------

namespace Wufly\Cashier\Exceptions;

use Exception;

class InvalidCashierChannel extends Exception
{
    /**
     * Create a new InvalidCashierChannel instance.
     *
     * @param $cashier_channel
     * @return static
     */
    public static function notYetSupport($cashier_channel)
    {
        return new static($cashier_channel . ' is not supported yet. See the supportCashierChannels method.');
    }
}
