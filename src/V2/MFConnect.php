<?php
/**
 * Created by PhpStorm
 * FileName: MFConnect.php
 * User: imokhles
 * Date: 11/11/2020
 * Time: 03:36
 * Copyright 2020 imokhles, All rights reserved
 */

namespace iMokhles\MyFatoorahAPI\V2;


use iMokhles\MyFatoorahAPI\V2\Traits\MFHttpRequest;

class MFConnect
{

    use MFHttpRequest;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var boolean
     */
    protected $isTest;

    /**
     * @var array
     */
    protected $header;

    /**
     * @var string
     */
    protected $host = 'https://api.myfatoorah.com/v2/';

    /**
     * @var string
     */
    protected $hostTest = 'https://apitest.myfatoorah.com/v2/';

    /**
     * MFConnect constructor.
     * @param $token
     * @param bool $isTest
     */
    public function __construct($token, $isTest = false )
    {
        $this->setIsTest($isTest);
        $this->setToken($token);
        $this->setHeader();
    }

    /**
     * @param $isTest
     */
    protected function setIsTest($isTest)
    {
        $this->isTest = $isTest;
    }

    /**
     * @param $token
     * @return $this
     */
    protected function setToken($token)
    {
        $this->token = 'Bearer ' . $token;
        return $this;
    }

    /**
     * @param array $header
     * @return $this
     */
    protected function setHeader(array $header = [])
    {
        $header['Authorization'] = $this->token;
        $this->header = $header;
        return $this;
    }

    /**
     * @param $path
     * @return string
     */
    protected function getUrl($path)
    {
        return ($this->isTest) ? $this->hostTest . $path : $this->host . $path;
    }

}
