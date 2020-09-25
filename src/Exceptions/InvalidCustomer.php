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

class InvalidCustomer extends Exception
{
    /**
     * Create a new InvalidCustomer instance.
     *
     * @param $owner
     * @return static
     */
    public static function notYetCreated($owner)
    {
        return new static(class_basename($owner) . ' is not a Cashier customer yet. See the createAsCashierCustomer method.');
    }
}
