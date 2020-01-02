<?php

class SettingsTest extends Settings
{

    public function initEnvironmentSettings()
    {
        $this->UserCode = "";
        $this->Pin = "";
        $this->BaseUrl="https://test.3pay.com/sgate/Gate";
        $this->HashKey="";
    }

}