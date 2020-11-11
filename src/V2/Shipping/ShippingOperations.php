<?php
/**
 * Created by PhpStorm
 * FileName: ShippingOperations.php
 * User: imokhles
 * Date: 11/11/2020
 * Time: 22:27
 * Copyright 2020 imokhles, All rights reserved
 */

namespace iMokhles\MyFatoorahAPI\V2\Shipping;


use iMokhles\MyFatoorahAPI\V2\MFConnect;

class ShippingOperations extends MFConnect
{

    /**
     * @return mixed|string
     */
    public function listCountries() {
        $url = $this->getUrl('GetCountries');
        return $this->get($url, [], $this->header);
    }

    /**
     * @param $shippingMethod
     * @param $countryCode
     * @return mixed|string
     */
    public function listCities($shippingMethod, $countryCode) {
        $parameters = [
            'shippingMethod' => $shippingMethod,
            'countryCode' => $countryCode
        ];
        $url = $this->getUrl('GetCities');
        return $this->get($url, $parameters, $this->header);
    }

    /**
     * @param $shippingMethod
     * @param $countryCode
     * @param $params
     * @return mixed|string
     */
    public function calculateCharge($shippingMethod, $countryCode, $params) {

        $parameters = [
            'ShippingMethod' => $shippingMethod,
            'CountryCode' => $countryCode,
        ];

        if (array_key_exists('Items', $params)) {
            $parameters['Items'] = $params['Items'];
        }
        if (array_key_exists('CityName', $params)) {
            $parameters['CityName'] = $params['CityName'];
        }
        if (array_key_exists('PostalCode', $params)) {
            $parameters['PostalCode'] = $params['PostalCode'];
        }

        $url = $this->getUrl('CalculateShippingCharge');
        return $this->postJson($url, $parameters, $this->header);
    }

    /**
     * @param $shippingMethod
     * @param $orderStatusChangedTo
     * @param $params
     * @return mixed|string
     */
    public function updateStatus($shippingMethod, $orderStatusChangedTo, $params) {

        $parameters = [
            'ShippingMethod' => $shippingMethod,
            'OrderStatusChangedTo' => $orderStatusChangedTo,
        ];

        if (array_key_exists('InvoiceNumbers', $params)) {
            $parameters['InvoiceNumbers'] = $params['InvoiceNumbers'];
        }


        $url = $this->getUrl('UpdateShippingStatus');
        return $this->postJson($url, $parameters, $this->header);
    }

    /**
     * @param $shippingMethod
     * @return mixed|string
     */
    public function requestPickup($shippingMethod) {

        $parameters = [
            'shippingMethod' => $shippingMethod,
        ];


        $url = $this->getUrl('UpdateShippingStatus');
        return $this->postJson($url, $parameters, $this->header);
    }

    /**
     * @param $shippingMethod
     * @param $orderStatus
     * @return mixed|string
     */
    public function orderList($shippingMethod, $orderStatus) {

        $parameters = [
            'shippingMethod' => $shippingMethod,
            'orderStatus' => $orderStatus,
        ];


        $url = $this->getUrl('GetShippingOrderList');
        return $this->get($url, $parameters, $this->header);
    }
}