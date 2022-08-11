<?php

namespace Aoss;

class Aoss
{
    public $send_url = "";

    public function send($real_path, $mime_type, $file_name)
    {
        return self::send_file_ret($this->send_url, $real_path, $mime_type, $file_name);
    }


    public static function send_file_url($send_url, $real_path, $mime_type, $file_name): AossSimpleRet
    {
        $postData = [
            'file' => new \CURLFile(realpath($real_path), $mime_type, $file_name)
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $send_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $response = curl_exec($ch);
        curl_close($ch);
        return new AossSimpleRet($response);
    }

    public static function send_file_ret($send_url, $real_path, $mime_type, $file_name): AossCompleteRet
    {
        $postData = [
            'file' => new \CURLFile(realpath($real_path), $mime_type, $file_name)
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $send_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $response = curl_exec($ch);
        curl_close($ch);
        return new AossCompleteRet($response);
    }
}

class AossSimpleRet
{
    public $error = null;
    public $data = [];

    public function __construct($response)
    {
        $json = json_decode($response, true);
        if (empty($json) || !isset($json["code"])) {
            return false;
        }
        if ($json["code"] == "0") {
            $this->data = $json["data"];
        } else {
            return $this->error = $json["data"];
        }
    }
}

class AossCompleteRet
{
    public $error = null;
    public $data = [];
    public $name = "";
    public $path = "";
    public $mime = "";
    public $size = 0;
    public $ext = "";
    public $md5 = "";
    public $src = "";
    public $url = "";
    public $surl = "";
    public $duration = 0;
    public $duration_str = "";
    public $bitrate = 0;

    public function __construct($response)
    {
        $json = json_decode($response, true);
        if (empty($json) || !isset($json["code"])) {
            return false;
        }
        if ($json["code"] == "0") {
            $this->data = $json["data"];
            $this->name = $this->data["name"];
            $this->path = $this->data["path"];
            $this->mime = $this->data["mime"];
            $this->size = $this->data["size"];
            $this->ext = $this->data["ext"];
            $this->md5 = $this->data["md5"];
            $this->src = $this->data["src"];
            $this->url = $this->data["url"];
            $this->surl = $this->data["surl"];
            $this->duration_str = $this->data["duration_str"];
            $this->bitrate = $this->data["bitrate"];
        } else {
            return $this->error = $json["data"];
        }
    }
}