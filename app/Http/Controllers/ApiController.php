<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $phone;
    protected $password;

    public function __construct()
    {
        $this->phone = '923123456789';
        $this->password = '12345678';
    }


    public function getToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://dev.digidokaan.pk/api/v1/digidokaan/auth/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('phone' => $this->phone, 'password' => $this->password),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        $token = $response->token;
        return $token;
    }




    public function get_gateways()
    {
        $token = $this->getToken();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://dev.digidokaan.pk/api/v1/digidokaan/gateways_id',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer {$token}"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        $data = $response->data;
        foreach ($data as $id => $name) {
            $gateway = ShippingMethod::where('name', $name)->first();
            if ($gateway) {
                $gateway->update(['api_id' => $id]);
            } else {
                $gateway = ShippingMethod::create([
                    'name' => $name,
                    'api_id' => $id,
                    'charges' => 250
                ]);
            }

        }

    }

    public function get_cities()
    {
        $token = $this->getToken();
        $gateways = ShippingMethod::all();
        foreach ($gateways as $g) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://dev.digidokaan.pk/api/v1/digidokaan/cities',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('shipment_type' => '3', 'gateway_id' => $g->api_id, 'courier_bulk' => '1'),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: bearer {$token}"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $response = json_decode($response);
            $data = $response->data;

            $overland = $data->OverLand;
            foreach ($overland as $o) {
                $city = City::where('name', $o->city_name)->where('city_id', $o->city_id)->where('gateway_id', $g->api_id)->first();
                if (!$city) {
                    City::create([
                        'name' => $o->city_name,
                        'city_id' => $o->city_id,
                        'gateway_id' => $g->api_id,
                        'shipping_type' => 3
                    ]);
                }
            }
        }
    }
}
