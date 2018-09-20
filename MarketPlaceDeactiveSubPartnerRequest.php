<?php
/**
 * Pazaryeri Silme için gerekli olan alanların tanımlandığı sınıftır.
 * Bu sınıf içerisinde execute metodu ile servis çağrısı başlatılır.
 * Execute metodu içerisinde tanımlanan "toXmlString" metodu gerekli xml metninin oluşturulmasını sağlar.
 * Execute metodu içerisinde tanımlanan url adresine oluşturulan xml post edilir.
 */
class MarketPlaceDeactiveRequest
{
    public  $ServiceType; 
    public  $OperationType; 
    public  $Token; 
    public  $UniqueId; 
    public  $BaseUrl;

    public static function Execute(MarketPlaceDeactiveRequest $request)
    {
        return  restHttpCaller::post($request->BaseUrl , $request->toXmlString());
    }    
    
    //Post edilmesi istenen xml metni oluşturulup bu xml metni belirtilen adrese post edilir.
    public function toXmlString()
    {
        $xml_data = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
        "<WIRECARD>\n" .
        "    <ServiceType>" . $this->ServiceType . "</ServiceType>\n" .
        "    <OperationType>" . $this->OperationType . "</OperationType>\n" .
        "    <Token>\n" .
        "    <UserCode>" .$this->Token->UserCode . "</UserCode>\n" .
        "    <Pin>" .$this->Token->Pin . "</Pin>\n" .
        "    </Token>\n" .
        "    <UniqueId>" . $this->UniqueId . "</UniqueId>\n" .
        "</WIRECARD>";
        $xml_data = iconv("UTF-8","ISO-8859-9", $xml_data);
         return $xml_data;
    }
}