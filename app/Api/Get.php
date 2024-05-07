<?php

namespace App\Api;

use Illuminate\Support\Facades\Http;

class Get
{
    public static function getRequest(string $method, array $params): array
    {
        $url = ENV('DATA_SFERA_API_URL');
        $key = ENV('DATA_SFERA_API_KEY');

        if (isset($params['dateFrom']))
            $params['dateFrom'] = date('Y-m-d&H:i:s', strtotime($params['dateFrom']));

        if (isset($params['dateTo']))
            $params['dateTo'] = date('Y-m-d&H:i:s', strtotime($params['dateTo']));

        $arguments = '';

        foreach ($params as $paramName => $paramValue) {

            if (empty($arguments))
                $separator = '?';
            else
                $separator = '&';

            $arguments .= $separator . $paramName . '=' . $paramValue;
        }

        $url = $url . '/api/' . $method . $arguments . '&key=' . $key;

        $response = Http::get($url);

        return json_decode($response, true);
    }
}
