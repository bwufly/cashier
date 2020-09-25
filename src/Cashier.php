<?php
// +----------------------------------------------------------------------
// | Cashier.php
// +----------------------------------------------------------------------
// | Description:
// +----------------------------------------------------------------------
// | Time: 2020/9/25 15:51
// +----------------------------------------------------------------------
// | Author: wufly <wfxykzd@163.com>
// +----------------------------------------------------------------------

namespace Wufly\Cashier;

class Cashier
{
    public static function findBillable($customerId)
    {
        if ($customerId === null) {
            return;
        }

        $model = config('cashier.model');

        return (new $model)->where('customer_id', $customerId)->first();
    }
}
