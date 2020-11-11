<?php
/**
 * Created by PhpStorm
 * FileName: MFHttpRequest.php
 * User: imokhles
 * Date: 11/11/2020
 * Time: 03:35
 * Copyright 2020 imokhles, All rights reserved
 */

namespace iMokhles\MyFatoorahAPI\V2\Traits;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

trait MFHttpRequest
{

    /**
     * @param array $options
     * @return Client
     */
    protected function getHttpClient(array $options = [])
    {
        return new Client($options);
    }

    /**
     * @return float[]
     */
    protected function getBaseOptions()
    {
        $options = [
            'timeout' => method_exists($this, 'getTimeOut') ? $this->getTimeOut() : 5.0,
        ];
        return $options;
    }

    /**
     * @param $method
     * @param $uri
     * @param array $options
     * @return mixed|string
     */
    protected function request($method, $uri, $options = [])
    {
        return $this->unwrapResponse($this->getHttpClient($this->getBaseOptions())->{$method}($uri, $options));
    }

    /**
     * @param ResponseInterface $response
     * @return mixed|string
     */
    protected function unwrapResponse(ResponseInterface $response)
    {
        $contentType = $response->getHeaderLine('Content-Type');
        $contents = $response->getBody()->getContents();
        if (false !== stripos($contentType, 'json') || stripos($contentType, 'javascript')) {
            return json_decode($contents, true);
        } elseif (false !== stripos($contentType, 'xml')) {
            return json_decode(json_encode(simplexml_load_string($contents)), true);
        }
        return $contents;
    }

    /**
     * @param $uri
     * @param array $query
     * @param array $headers
     * @return mixed|string
     */
    protected function get($uri, $query = [], $headers = [])
    {
        return $this->request('get', $uri, [
            'headers' => $headers,
            'query' => $query,
        ]);
    }

    /**
     * @param $uri
     * @param array $params
     * @param array $headers
     * @return mixed|string
     */
    protected function post($uri, $params = [], $headers = [])
    {
        return $this->request('post', $uri, [
            'headers' => $headers,
            'form_params' => $params,
        ]);
    }

    /**
     * @param $uri
     * @param array $params
     * @param array $headers
     * @return mixed|string
     */
    protected function postJson($uri, $params = [], $headers = [])
    {
        return $this->request('post', $uri, [
            'headers' => $headers,
            'json' => $params,
        ]);
    }
}
