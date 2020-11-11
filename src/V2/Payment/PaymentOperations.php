<?php
/**
 * Created by PhpStorm
 * FileName: PaymentOperations.php
 * User: imokhles
 * Date: 11/11/2020
 * Time: 22:39
 * Copyright 2020 imokhles, All rights reserved
 */

namespace iMokhles\MyFatoorahAPI\V2\Payment;


use iMokhles\MyFatoorahAPI\V2\Exception\MFInvalidArgumentException;
use iMokhles\MyFatoorahAPI\V2\MFConnect;

class PaymentOperations extends MFConnect
{


    /**
     * @param $invoiceAmount
     * @param $currencyIso
     * @return mixed|string
     */
    public function initPayment($invoiceAmount, $currencyIso) {

        $parameters = [
            'InvoiceAmount' => $invoiceAmount,
            'CurrencyIso' => $currencyIso
        ];
        $url = $this->getUrl('InitiatePayment');

        return $this->postJson($url, $parameters, $this->header);
    }

    /**
     * @param $paymentMethodId
     * @param $invoiceValue
     * @param $callBackUrl
     * @param $errorUrl
     * @param $params
     * @return mixed|string
     */
    public function executePayment($paymentMethodId, $invoiceValue, $callBackUrl, $errorUrl, $params) {

        $parameters = [
            'PaymentMethodId' => $paymentMethodId,
            'InvoiceValue' => $invoiceValue,
            'CallBackUrl' => $callBackUrl,
            'ErrorUrl' => $errorUrl,
        ];

        if (array_key_exists('CustomerName', $params)) {
            $parameters['CustomerName'] = $params['CustomerName'];
        }

        if (array_key_exists('DisplayCurrencyIso', $params)) {
            $parameters['DisplayCurrencyIso'] = $params['DisplayCurrencyIso'];
        }

        if (array_key_exists('MobileCountryCode', $params)) {
            $parameters['MobileCountryCode'] = $params['MobileCountryCode'];
        }

        if (array_key_exists('CustomerMobile', $params)) {
            $parameters['CustomerMobile'] = $params['CustomerMobile'];
        }

        if (array_key_exists('CustomerEmail', $params)) {
            $parameters['CustomerEmail'] = $params['CustomerEmail'];
        }

        if (array_key_exists('Language', $params)) {
            $parameters['Language'] = $params['Language'];
        }

        if (array_key_exists('CustomerReference', $params)) {
            $parameters['CustomerReference'] = $params['CustomerReference'];
        }

        if (array_key_exists('CustomerCivilId', $params)) {
            $parameters['CustomerCivilId'] = $params['CustomerCivilId'];
        }

        if (array_key_exists('UserDefinedField', $params)) {
            $parameters['UserDefinedField'] = $params['UserDefinedField'];
        }

        if (array_key_exists('ExpireDate', $params)) {
            $parameters['ExpireDate'] = $params['ExpireDate'];
        }

        if (array_key_exists('SupplierCode', $params)) {
            $parameters['SupplierCode'] = $params['SupplierCode'];
        }

        if (array_key_exists('CustomerAddress', $params)) {
            $parameters['CustomerAddress'] = $params['CustomerAddress'];
        }

        if (array_key_exists('InvoiceItems', $params)) {
            $parameters['InvoiceItems'] = $params['InvoiceItems'];
        }

        $url = $this->getUrl('ExecutePayment');

        return $this->postJson($url, $parameters, $this->header);
    }

    /**
     * @param $paymentUrl
     * @param $cardInfo
     * @param $params
     * @return mixed|string
     */
    public function payWithCard($paymentUrl, $cardInfo, $params) {
        $parameters = [
            'paymentType' => 'card',
            'card' => $cardInfo,
        ];
        if (array_key_exists('SaveToken', $params)) {
            $parameters['SaveToken'] = $params['SaveToken'];
        }
        if (array_key_exists('IsRecurring', $params)) {
            if ($parameters['IsRecurring'] == true) {
                if ($parameters['SaveToken'] == true) {
                    throw new MFInvalidArgumentException(
                        "IsRecurring & SaveToken shouldn't be true at same time"
                    );
                }
                $parameters['IsRecurring'] = $params['IsRecurring'];
                if ($params['IntervalDays'] < 1) {
                    throw new MFInvalidArgumentException(
                        "IntervalDays should be greater than 0"
                    );
                } else {
                    $parameters['IntervalDays'] = $params['IntervalDays'];
                }
            }
        }
        return $this->postJson($paymentUrl, $parameters, $this->header);
    }

    /**
     * @param $paymentUrl
     * @param $token
     * @return mixed|string
     */
    public function payWithToken($paymentUrl, $token) {
        $parameters = [
            'paymentType' => 'token',
            'token' => $token,
        ];
        return $this->postJson($paymentUrl, $parameters, $this->header);
    }

    /**
     * @param $customerName
     * @param $invoiceValue
     * @param $params
     * @return mixed|string
     */
    public function sendPayment($customerName, $invoiceValue, $params) {

        $notificationOption = 'LNK';
        if (array_key_exists('NotificationOption', $params)) {
            $notificationOption = $params['NotificationOption'];
        }

        $parameters = [
            'NotificationOption' => $notificationOption,
            'CustomerName' => $customerName,
            'InvoiceValue' => $invoiceValue,
        ];


        if (array_key_exists('DisplayCurrencyIso', $params)) {
            $parameters['DisplayCurrencyIso'] = $params['DisplayCurrencyIso'];
        }

        if (array_key_exists('MobileCountryCode', $params)) {
            $parameters['MobileCountryCode'] = $params['MobileCountryCode'];
        }

        if (array_key_exists('CustomerMobile', $params)) {
            $parameters['CustomerMobile'] = $params['CustomerMobile'];
        }

        if (array_key_exists('CustomerEmail', $params)) {
            $parameters['CustomerEmail'] = $params['CustomerEmail'];
        }

        if (array_key_exists('CallBackUrl', $params)) {
            $parameters['CallBackUrl'] = $params['CallBackUrl'];
        }

        if (array_key_exists('ErrorUrl', $params)) {
            $parameters['ErrorUrl'] = $params['ErrorUrl'];
        }

        if (array_key_exists('Language', $params)) {
            $parameters['Language'] = $params['Language'];
        }

        if (array_key_exists('CustomerReference', $params)) {
            $parameters['CustomerReference'] = $params['CustomerReference'];
        }

        if (array_key_exists('CustomerCivilId', $params)) {
            $parameters['CustomerCivilId'] = $params['CustomerCivilId'];
        }

        if (array_key_exists('UserDefinedField', $params)) {
            $parameters['UserDefinedField'] = $params['UserDefinedField'];
        }

        if (array_key_exists('ExpireDate', $params)) {
            $parameters['ExpireDate'] = $params['ExpireDate'];
        }

        if (array_key_exists('CustomerAddress', $params)) {
            $parameters['CustomerAddress'] = $params['CustomerAddress'];
        }

        if (array_key_exists('InvoiceItems', $params)) {
            $parameters['InvoiceItems'] = $params['InvoiceItems'];
        }

        $url = $this->getUrl('SendPayment');

        return $this->postJson($url, $parameters, $this->header);
    }

    /**
     * @param $key
     * @param $keyType
     * @return mixed|string
     */
    public function getPaymentStatus($key, $keyType) {

        $parameters = [
            'Key' => $key,
            'KeyType' => $keyType,
        ];

        $url = $this->getUrl('GetPaymentStatus');
        return $this->postJson($url, $parameters, $this->header);
    }

    /**
     * @return mixed|string
     */
    public function getActiveRecurringPayment() {
        $url = $this->getUrl('GetActiveRecurringPayment');
        return $this->get($url, [], $this->header);
    }

    /**
     * @param $recurringId
     * @return mixed|string
     */
    public function cancelRecurringPayment($recurringId) {
        $parameters = [
            'recurringId' => $recurringId,
        ];

        $url = $this->getUrl('CancelRecurringPayment');
        return $this->postJson($url, $parameters, $this->header);
    }

    /**
     * @param $cardToken
     * @return mixed|string
     */
    public function cancelCardToken($cardToken) {
        $parameters = [
            'token' => $cardToken,
        ];

        $url = $this->getUrl('CancelToken');
        return $this->postJson($url, $parameters, $this->header);
    }

    /**
     * @param $key
     * @param $keyType
     * @param $params
     * @return mixed|string
     */
    public function makeRefund($key, $keyType, $params) {
        $parameters = [
            'Key' => $key,
            'KeyType' => $keyType,
        ];

        if (array_key_exists('RefundChargeOnCustomer', $params)) {
            if (!is_bool($params['RefundChargeOnCustomer'])) {
                throw new MFInvalidArgumentException(
                    "RefundChargeOnCustomer accepts only true or false boolean values"
                );
            }
            $parameters['RefundChargeOnCustomer'] = $params['RefundChargeOnCustomer'];
        }

        if (array_key_exists('ServiceChargeOnCustomer', $params)) {
            if (!is_bool($params['ServiceChargeOnCustomer'])) {
                throw new MFInvalidArgumentException(
                    "ServiceChargeOnCustomer accepts only true or false boolean values"
                );
            }
            $parameters['ServiceChargeOnCustomer'] = $params['ServiceChargeOnCustomer'];
        }

        if (array_key_exists('Amount', $params)) {
            $parameters['Amount'] = $params['Amount'];
        }

        if (array_key_exists('Comment', $params)) {
            $parameters['Comment'] = $params['Comment'];
        }

        if (array_key_exists('AmountDeductedFromSupplier', $params)) {
            $parameters['AmountDeductedFromSupplier'] = $params['AmountDeductedFromSupplier'];
        }

        $url = $this->getUrl('MakeRefund');
        return $this->postJson($url, $parameters, $this->header);
    }
}