<?php
/**
 * Created by PhpStorm
 * FileName: ListOperations.php
 * User: imokhles
 * Date: 11/11/2020
 * Time: 23:00
 * Copyright 2020 imokhles, All rights reserved
 */

namespace iMokhles\MyFatoorahAPI\V2\ListOperations;


use iMokhles\MyFatoorahAPI\V2\MFConnect;

class ListOperations extends MFConnect
{

    /**
     * @return mixed|string
     */
    public function listBanks() {

        $url = $this->getUrl('GetBanks');
        return $this->get($url, [], $this->header);
    }

    /**
     * @return mixed|string
     */
    public function listExchanges() {

        $url = $this->getUrl('GetCurrenciesExchangeList');
        return $this->get($url, [], $this->header);
    }
}