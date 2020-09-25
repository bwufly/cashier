<?php
// +----------------------------------------------------------------------
// | CustomerAlreadyCreated.php
// +----------------------------------------------------------------------
// | Description: 
// +----------------------------------------------------------------------
// | Time: 2020/9/25 16:15
// +----------------------------------------------------------------------
// | Author: wufly <wfxykzd@163.com>
// +----------------------------------------------------------------------

namespace Wufly\Cashier\Exceptions;

use Exception;

class CustomerAlreadyCreated extends Exception
{
    public static function exists($owner)
    {
        return new static(class_basename($owner) . " is already a Cashier customer with ID {$owner->customer_id}.");
    }
}
