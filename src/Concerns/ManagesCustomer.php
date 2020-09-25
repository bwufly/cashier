<?php
/**
 * Created by PhpStorm.
 * User: wufly
 * Date: 2020/9/25 16:11
 */

namespace Wufly\Cashier\Concerns;

use Wufly\Cashier\Exceptions\CustomerAlreadyCreated;
use Wufly\Cashier\Exceptions\InvalidCashierChannel;
use Wufly\Cashier\Exceptions\InvalidCustomer;


trait ManagesCustomer
{
    protected $customer_id; // 客户ID

    // 支持的支付渠道
    protected $cashier_channels = [
        'stripe' => ['cashier' => '', 'cashier_customer' => ''],
        'paypal' => ['cashier' => '', 'cashier_customer' => ''],
    ];

    public function hasCustomerId()
    {
        return !is_null($this->customer_id);
    }

    public function supportCashierChannels()
    {
        return array_keys($this->cashier_channels);
    }

    public function getCashierChannelClass($cashier_channel)
    {
        return $this->cashier_channels[$cashier_channel]['cashier'];
    }

    public function getCashierChannelCustomerClass($cashier_channel)
    {
        return $this->cashier_channels[$cashier_channel]['cashier_customer'];
    }

    public function createAsCashierCustomer($cashier_channel, array $options = [])
    {
        // 判断是否已经存在
        if ($this->hasCustomerId()) {
            throw CustomerAlreadyCreated::exists($this);
        }

        // 判断参数是否含有cashier_channel
        if (!$cashier_channel || !in_array($cashier_channel,
                $this->supportCashierChannels())) {
            throw InvalidCashierChannel::notYetSupport($options['cashier_channel'] ?? '');
        }

        if (!array_key_exists('email', $options) && $email = $this->stripeEmail()) {
            $options['email'] = $email;
        }

        $customer_class = $this->getCashierChannelCustomerClass($cashier_channel);

        // Here we will create the customer instance on Stripe and store the ID of the
        // user from Stripe. This ID will correspond with the Stripe user instances
        // and allow us to retrieve users from Stripe later when we need to work.
        $customer = $customer_class::create(
            $options, $this->parseOptions($cashier_channel)
        );

        $this->customer_id = $customer->id;

        $this->cashier_channel = $cashier_channel;

        $this->save();

        return $customer;
    }

    public function createOrGetStripeCustomer($options)
    {
        if ($this->hasCustomerId()) {
            return $this->asCashierCustomer();
        }

        return $this->createAsCashierCustomer($options);
    }

    public function asCashierCustomer()
    {
        $this->assertCustomerExists();

        $cashier_channel = $this->cashier_channel;
        $customer_class = $this->getCashierChannelCustomerClass($cashier_channel);
        return $customer_class::retrieve($this->customer_id, $this->parseOptions($cashier_channel));
    }

    public function assertCustomerExists()
    {
        if (!$this->hasCustomerId()) {
            throw InvalidCustomer::notYetCreated($this);
        }
    }

    public function parseOptions($cashier_channel, array $options = [])
    {
        return $this->getCashierChannelCustomerClass($this->cashier_channel)::parseOptions($options);
    }

    public function updateCashierCustomer(array $options = [])
    {
        $customer_class = $this->getCashierChannelCustomerClass($this->cashier_channel);
        return $customer_class::update(
            $this->customer_id, $options, $this->parseOptions()
        );
    }
}
