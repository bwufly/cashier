<?php
// +----------------------------------------------------------------------
// | StripeCashier.php
// +----------------------------------------------------------------------
// | Description: 
// +----------------------------------------------------------------------
// | Time: 2020/9/25 16:44
// +----------------------------------------------------------------------
// | Author: wufly <wfxykzd@163.com>
// +----------------------------------------------------------------------

namespace Wufly\Cashier\Cashiers;

use Wufly\Cashier\Cashier;

class StripeCashier extends Cashier implements CashierInterface
{
    /**
     * The Stripe API version.
     *
     * @var string
     */
    const STRIPE_VERSION = '2020-03-02';

    public function parseOptions(array $options = [])
    {
        return array_merge([
            'api_key'        => config('cashier.stripe.secret'),
            'stripe_version' => static::STRIPE_VERSION,
        ], $options);
    }
}
