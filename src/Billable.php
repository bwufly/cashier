<?php
/**
 * Created by PhpStorm.
 * User: wufly
 * Date: 2020/9/25 15:48
 */

namespace Wufly\Cashier;


trait Billable
{
    // 客户管理
    use ManagesCustomer;

    // 客户支付方式管理
    use ManagesPaymentMethods;

    // 订阅管理
    use ManagesSubscriptions;
}
