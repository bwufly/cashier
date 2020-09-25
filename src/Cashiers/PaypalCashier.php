<?php
// +----------------------------------------------------------------------
// | PaypalCashier.php
// +----------------------------------------------------------------------
// | Description: 
// +----------------------------------------------------------------------
// | Time: 2020/9/25 16:44
// +----------------------------------------------------------------------
// | Author: wufly <wfxykzd@163.com>
// +----------------------------------------------------------------------

namespace Wufly\Cashier\Cashiers;

use Wufly\Cashier\Cashier;

class PaypalCashier extends Cashier implements CashierInterface
{
    public function parseOptions(array $options = [])
    {
        return [];
    }
}
