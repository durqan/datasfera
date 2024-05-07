<?php

namespace App\Http\Controllers;

use App\Api\Get;
use App\Models\Orders;
use App\Models\Sales;
use App\Models\Stocks;
use App\Models\Incomes;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function view()
    {
        $methods =
            [
                'sales' => Sales::class,
                'orders' => Orders::class,
                'stocks' => Stocks::class,
                'incomes' => Incomes::class,
            ];

        foreach ($methods as $method => $class) {
            $response = Get::getRequest($method, ['dateFrom' => '2024-05-07', 'dateTo' => '2024-05-07', 'limit' => 5]);

            if(isset($response['data']))
                $response = $response['data'];
            else
                continue;

            foreach ($response as $arr) {

                $insert = [];

                foreach ($arr as $key => $value) {
                    $insert[$key] = $value;
                }

                $class::insert($insert);
            }
        }
    }
}
