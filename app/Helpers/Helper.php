<?php

if (! function_exists('getGender')) {
    function getGender($value)
    {
        return $value === 'male' ? 'Laki-laki' : 'Perempuan';
    }
}
if (! function_exists('formatDate')) {
    function formatDate($date, $format = 'd F Y')
    {
        return \Carbon\Carbon::parse($date)->translatedFormat($format);
    }
}
if (! function_exists('sendWhatsAppMessage')) {
    function sendWhatsAppMessage($to, $message)
    {
        $url = "https://api.ultramsg.com/" . env('ULTRAMSG_INSTANCE_ID') . "/messages/chat";

        $data = [
            'token' => env('ULTRAMSG_TOKEN'),
            'to' => $to,
            'body' => $message,
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
if (! function_exists('sendWhatsAppImage')) {
    function sendWhatsAppImage($to, $imageUrl, $caption = null)
    {
        $url = "https://api.ultramsg.com/" . env('ULTRAMSG_INSTANCE_ID') . "/messages/image";

        $data = [
            'token' => env('ULTRAMSG_TOKEN'),
            'to' => $to,
            'image' => $imageUrl,
            'caption' => $caption,
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
