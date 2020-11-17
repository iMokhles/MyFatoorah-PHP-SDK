<?php
/**
 * Created by PhpStorm
 * FileName: SendPaymentTest.php
 * User: imokhles
 * Date: 17/11/2020
 * Time: 01:00
 * Copyright 2020 imokhles, All rights reserved
 */

namespace iMokhles\MyFatoorahAPI\Test\PaymentOperations;


use iMokhles\MyFatoorahAPI\Test\Constants;
use iMokhles\MyFatoorahAPI\V2\Payment\PaymentOperations;
use PHPUnit\Framework\TestCase;

class SendPaymentTest extends TestCase
{

    /**
     * Generate payment url to pay through MyFatoorah pages
     */
    public function testGeneratePaymentUrl() {
        $initPayment = new PaymentOperations(Constants::REGULAR_PAYMENT_TEST_TOKEN, true);
        $result = $initPayment->sendPayment('Customer Name', 350, [
            'DisplayCurrencyIso' => 'SAR',
            'CallBackUrl' => 'https://imokhles.com/payment/success_callback',
            'ErrorUrl' => 'https://imokhles.com/payment/fail_callback',
        ]);
        $this->assertIsArray($result);

        print PHP_EOL.print_r($result, true).PHP_EOL;
    }

    /**
     * Example of how the success callback should be parsed to check the payment status
     */
    public function testCheckPaymentCallback() {

        $paymentId = "100201923790872553";
        if (!empty($_GET['paymentId'])) {
            $paymentId = $_GET["paymentId"];
        }
        $initPaymentStatus = new PaymentOperations(Constants::REGULAR_PAYMENT_TEST_TOKEN, true);
        $result = $initPaymentStatus->getPaymentStatus($paymentId, 'PaymentId');
        $this->assertIsArray($result);

        print PHP_EOL.print_r($result, true).PHP_EOL;
    }

    /**
     * Example of how check the invoice status
     */
    public function testCheckInvoiceStatus() {

        $invoiceId = "24553";
        if (!empty($_GET['invoiceId'])) {
            $invoiceId = $_GET["invoiceId"];
        }
        $initPaymentStatus = new PaymentOperations(Constants::REGULAR_PAYMENT_TEST_TOKEN, true);
        $result = $initPaymentStatus->getPaymentStatus($invoiceId, 'InvoiceId');
        $this->assertIsArray($result);

        print PHP_EOL.print_r($result, true).PHP_EOL;
    }
}