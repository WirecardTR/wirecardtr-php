<?php
/**
 * Pazaryeri ödeme onayı için gerekli olan alanların tanımlandığı sınıftır.
 * Bu sınıf içerisinde execute metodu ile servis çağrısı başlatılır.
 * Execute metodu içerisinde tanımlanan "toXmlString" metodu gerekli xml metninin oluşturulmasını sağlar.
 * Execute metodu içerisinde tanımlanan url adresine oluşturulan xml post edilir.
 */
class MarketPlaceSaleReleasePaymentRequest
{
    public  $ServiceType; 
    public  $OperationType; 
    public  $CreditCardInfo; 
    public  $Token; 
    public  $MPAY; 
    public  $SubPartnerId; 
    public  $CommissionRate; 
    public  $OrderId; 
    public  $Description;
    public  $BaseUrl;

    public static function Execute(MarketPlaceSaleReleasePaymentRequest $request)
    {
        return  restHttpCaller::post($request->BaseUrl, $request->toXmlString());
    }    
    
    //Post edilmesi istenen xml metni oluşturulup bu xml metni belirtilen adrese post edilir.
    public function toXmlString()
    {
        $xml_data = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
        "<WIRECARD>\n" .
        "    <ServiceType>" . $this->ServiceType . "</ServiceType>\n" .
        "    <OperationType>" . $this->OperationType . "</OperationType>\n" .
        "    <Token>\n" .
        "    <UserCode>" . $this->Token->UserCode . "</UserCode>\n" .
        "    <Pin>" . $this->Token->Pin . "</Pin>\n" .
        "    </Token>\n" .
        "    <SubPartnerId>" . $this->SubPartnerId . "</SubPartnerId>\n" .
        "    <CommissionRate>" . $this->CommissionRate . "</CommissionRate>\n" .
        "    <MPAY>" . $this->MPAY . "</MPAY>\n" .
        "    <OrderId>" . $this->OrderId . "</OrderId>\n" .
        "    <Description>" . $this->Description . "</Description>\n" .
        "</WIRECARD>";
        $xml_data = iconv("UTF-8","ISO-8859-9", $xml_data);
         return $xml_data;
    }
}