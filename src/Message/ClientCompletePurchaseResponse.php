<?php

namespace Omnipay\Asiapay\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Class ClientCompletePurchaseResponse
 * @package Omnipay\Asiapay\Message
 */
class ClientCompletePurchaseResponse extends AbstractResponse
{

    public function isPaid()
    {
        return $this->data['is_paid'];
    }


    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->data['verify_success'];
    }
}
