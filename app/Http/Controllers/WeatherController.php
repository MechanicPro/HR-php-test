<?php
/**
 * Created by PhpStorm.
 * User: stude
 * Date: 21.05.2018
 * Time: 10:12
 */

namespace App\Http\Controllers;


class WeatherController
{
    public function show()
    {
        $city_id = 191; //id Брянска
        $data = self::calcWeather($city_id);
        return view('weather', $data);
    }

    protected function calcWeather($city_id)
    {
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' =>
                    "X-Yandex-API-Key: ecb64707-379a-431c-9086-52b6d8be5e03"
            )
        );
        $context = stream_context_create($opts);
        $file = file_get_contents('https://api.weather.yandex.ru/v1/forecast?geoid=' . $city_id . '&extra=true', false, $context);
        $data = json_decode($file, true);
        return $data;
    }
}