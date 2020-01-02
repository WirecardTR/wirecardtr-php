<?php

class SettingsTest extends Settings
{

    public function environmentSettings()
    {
        $this->UserCode = "";
        $this->Pin = "";
        $this->BaseUrl="https://test.3pay.com/sgate/Gate";
        $this->HashKey="";
    }

}