<?php

namespace H4MSK1\Curl\Traits;

trait WeatherApiTrait
{
    public function getWeatherData($lat, $lng, $type)
    {
        if ($type === 'forecast') {
            return $this->normalizeForecast($this->fetchWeather($lat, $lng));
        } else {
            return $this->normalizeForecast($this->fetchWeatherHistory($lat, $lng));
        }
    }
    public function fetchWeather($lat, $lng)
    {
        $service = $this->getServiceByName('darksky');
        $endpoint = "{$service['endpoint']}{$service['key']}/{$lat},{$lng}?lang=sv&units=si";

        return $this->fetchCurl($endpoint);
    }

    public function fetchWeatherHistory($lat, $lng, $pastDays = 30)
    {
        $service = $this->getServiceByName('darksky');
        $endpoint = "{$service['endpoint']}{$service['key']}/{$lat},{$lng},{{day}}?lang=sv&units=si";

        $curlHandlers = [];
        $curlCollection = curl_multi_init();

        for ($i = $pastDays; $i > 0; $i--) {
            $days[$i] = strtotime("-$i days");
        }

        for ($i = 0; $i < $pastDays; $i++) {
            $curlHandlers[$i] = curl_init();

            curl_setopt($curlHandlers[$i], CURLOPT_URL, str_replace('{{day}}', $days[($i + 1)], $endpoint));
            curl_setopt($curlHandlers[$i], CURLOPT_HEADER, 0);
            curl_setopt($curlHandlers[$i], CURLOPT_RETURNTRANSFER, 1);

            curl_multi_add_handle($curlCollection, $curlHandlers[$i]);
        }

        $running = null;

        do {
            curl_multi_exec($curlCollection, $running);
        } while ($running > 0);

        $result = [];

        foreach ($curlHandlers as $index => $handler) {
            $result[$index] = curl_multi_getcontent($handler);
            $result[$index] = json_decode($result[$index], true);
            curl_multi_remove_handle($curlCollection, $handler);
        }

        curl_multi_close($curlCollection);

        return $result;
    }

    public function normalizeForecast($data)
    {
        $newData = [];

        if (array_key_exists('daily', $data)) {
            foreach ($data['daily']['data'] as $day) {
                $newData[] = [
                    'summary' => $day['summary'],
                    'temperatureMin' => $day['temperatureMin'],
                    'temperatureMax' => $day['temperatureMax'],
                    'sunriseTime' => gmdate('H:i', $day['sunriseTime']),
                    'sunsetTime' => gmdate('H:i', $day['sunsetTime']),
                    'date' => gmdate('Y-m-d', $day['time']),
                ];
            }
        } else {
            foreach ($data as $day) {
                $day = $day['daily']['data'][0];
                $newData[] = [
                    'summary' => $day['summary'],
                    'temperatureMin' => $day['temperatureMin'],
                    'temperatureMax' => $day['temperatureMax'],
                    'sunriseTime' => gmdate('H:i', $day['sunriseTime']),
                    'sunsetTime' => gmdate('H:i', $day['sunsetTime']),
                    'date' => gmdate('Y-m-d', $day['time']),
                ];
            }
        }

        return $newData;
    }
}
