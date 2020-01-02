<?php

/*
Tüm çağrılarda kullanılacak olan ayarların tutulduğu kısımdır.
*/
class Settings
{

    /**
     * Wirecard tarafından sizlere verilen Test User Code bilgisi
     */
    public $UserCode;

    /**
     * Wirecard tarafından sizlere verilen Test Pin bilgisi
     */
    public $Pin;

    /**
     * Wirecard web servisleri Test API ucu
     */
    public $BaseUrl;

    /**
     *Wirecard tarafından sizlere verilen Private HashKey bilgisi
     */
    public $HashKey;

    public function __construct()
    {
        $this->environmentSettings();
    }

    public function environmentSettings()
    {
        $this->UserCode = "";
        $this->Pin = "";
        $this->BaseUrl="https://www.wirecard.com.tr/SGate/Gate";
        $this->HashKey="";
    }

}