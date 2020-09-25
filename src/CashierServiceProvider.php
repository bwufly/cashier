<?php
// +----------------------------------------------------------------------
// | CashierServiceProvider.php
// +----------------------------------------------------------------------
// | Description:
// +----------------------------------------------------------------------
// | Time: 2020/9/25 17:33
// +----------------------------------------------------------------------
// | Author: wufly <wfxykzd@163.com>
// +----------------------------------------------------------------------

namespace Wufly\Cashier;

use Illuminate\Support\ServiceProvider;

class CashierServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPublishing();
    }

    public function register()
    {

    }

    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations' => $this->app->databasePath('migrations'),
            ], 'cashier-migrations');

        }
    }

}
