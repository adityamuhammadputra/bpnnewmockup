<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class smsmasking extends Controller{
    protected $to;
    protected $text;
    public $username;
    public $password;
    public $idreport;
    public $apikey;

    public function setTo($to)
    {
        $this->to = $to;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function smssend()
    {
        if (!$this->to) {
            trigger_error('Error: Phone to required!');
            exit();
        }

        if (!$this->text) {
            trigger_error('Error: Text Message required!');
            exit();
        }
        $curlHandle = curl_init();
        $url = "http://sms255.xyz/sms/smsmasking.php?username=" . urlencode($this->username) . "&password=" . urlencode($this->password) . "&key=" . $this->apikey . "&number=" . $this->to . "&message=" . urlencode($this->text);
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 120);
        $hasil = curl_exec($curlHandle);
        curl_close($curlHandle);
        return $hasil;
    }
    public function smssaldo()
    {
        $curlHandle = curl_init();
        $url = "http://sms255.xyz/sms/smssaldo.php?username=" . urlencode($this->username) . "&password=" . urlencode($this->password) . "&key=" . $this->apikey;
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 120);
        $hasil = curl_exec($curlHandle);
        curl_close($curlHandle);
        return $hasil;
    }
}