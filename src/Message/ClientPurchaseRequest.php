<?php

namespace Omnipay\Asiapay\Message;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Asiapay\Helper;

/**
 * Class ClientPurchaseRequest
 * @package Omnipay\Asiapay\Message
 */
class ClientPurchaseRequest extends AbstractClientRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $this->validateData();

        $data = array (
            'merchantId'     => $this->getMerchantId(),
            'amount'         => $this->getAmount(),
            'orderRef'       => $this->getOrderRef(),
            'currCode'       => $this->getCurrCode(),
            'mpsMode'        => $this->getMpsMode(),
            'successUrl'     => $this->getSuccessUrl(),
            'failUrl'        => $this->getFailUrl(),
            'cancelUrl'      => $this->getCancelUrl(),
            'payType'        => $this->getPayType(),
            'lang'           => $this->getLang(),
            'payMethod'      => $this->getPayMethod(),
            'redirect'       => $this->getRedirect(),
        );

        $data = Helper::filterData($data);

        if ($this->getSecurity()) {
            $data['secureHash'] = Helper::getParamsSignatureWithSecurity($data, $this->getSecurity());
        }

        return $data;
    }


    private function validateData()
    {
        $this->validate(
            'merchantId',
            'amount',
            'orderRef',
            'currCode',
            'mpsMode',
            'successUrl',
            'failUrl',
            'cancelUrl',
            'payType',
            'lang',
            'payMethod',
            'redirect'
        );
    }


    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new ClientPurchaseResponse($this, $data);
    }
}
