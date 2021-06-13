<?php


namespace App\Libraries\Sucurungun;


class ApiAgent
{
    public const API_ENDPOINT = "https://sucurungun.com";
    private const API_KEY = "";

    /**
     * @param string $query
     * @return string
     */
    public static function query(string $query): string
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => ApiAgent::API_ENDPOINT,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "prompt": "' . $query . '",
    "temperature": 0.7,
    "max_tokens": 64,
    "top_p": 1,
    "frequency_penalty": 0,
    "presence_penalty": 0
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . ApiAgent::API_KEY
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($response);
        if ($res->choices && $res->choices[0]->text) {
            return $res->choices[0]->text;
        }
        return "";
    }
}
