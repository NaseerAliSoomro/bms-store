<?php

namespace Bms\Store\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Printful
{
    public $token;

    public function __construct()
    {
        $this->token = env("PRINTFUL_TOKEN");
    }

    public function getAllCategories()
    {
        $response = $this->apiCall("GET", "https://api.printful.com/categories");
        $categories = json_decode($response->getBody(), true)['result']['categories'];
        return $categories;
    }
    public function getCategoryDetailsById($id)
    {
        $response = $this->apiCall("GET", "https://api.printful.com/categories/".$id);
        $category = json_decode($response->getBody(), true)['result']['category'];
        return $category;
    }

    public function getAllProductsByCategory($id)
    {
        $response = $this->apiCall("GET", "https://api.printful.com/products?category_id=".$id);
        $products = json_decode($response->getBody(), true)['result'];
        return $products;
    }

    public function getAllProducts()
    {
        $response = $this->apiCall("GET", "https://api.printful.com/products");
        $products = json_decode($response->getBody(), true)['result'];
        return $products;
    }

    public function getProductDetailsById($id)
    {
        $response = $this->apiCall("GET", "https://api.printful.com/products/".$id);
        $product_details = json_decode($response->getBody(), true)['result'];
        return $product_details;
    }

    public function getShippingRate( $cart, $address_array )
    {
        //dd( $cart );

        if($address_array==null || $address_array=="{}" || $cart==null)
        {
            return 0;
        }

        $address = json_decode($address_array);

        /*
        {
            "address":"1925 Saint Clair Ave NE",
            "city":"Cleveland",
            "street2":"1",
            "state":"Ohio",
            "zip":"44114",
            "country":"United States",
            "country_code":"us",
            "attention":"waqas"
        }
        */

        $items = [];
        foreach( $cart as $c)
        {
            $item = array();
            $item["quantity"] = $c['quantity'];
            $item["variant_id"] = $c['id'];
            array_push($items, $item);
        }

        $postRequest = '{
            "recipient": {
                "address1": "'.$address->address.'",
                "city": "'.$address->city.'",
                "country_code": "'.$address->country_code.'",
                "state_code": "'.$address->state.'",
                "zip": '.$address->zip.'
            },
            "items": '.json_encode($items).',
            "store_id": 5650603
        }';
        //dd( json_encode($items) );

        $client = new Client();
        $url = "https://api.printful.com/shipping/rates";
        $response = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
            'body' =>  $postRequest,
        ]);
        $result = json_decode($response->getBody(), true)['result'];
        return $result[0];

    }

    public function getTaxRate( $address_array )
    {
        if($address_array==null || $address_array=="{}")
        {
            return 0;
        }

        $address = json_decode($address_array);
        $postRequest = '{
            "recipient": {
                "city": "'.$address->city.'",
                "country_code": "'.$address->country_code.'",
                "state_code": "'.$address->state.'",
                "zip": '.$address->zip.'
            }
        }';
        $client = new Client();
        $url = "https://api.printful.com/tax/rates";
        $response = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
            'body' =>  $postRequest,
        ]);
        $result = json_decode($response->getBody(), true)['result'];
        return $result;

    }

    public function apiCall($method, $url)
    {
        $client = new Client();
        return $client->request($method, $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);
    }


}
