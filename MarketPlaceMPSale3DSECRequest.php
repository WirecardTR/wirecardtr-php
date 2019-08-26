<?php


/**
 * Pazaryeri 3dSecure ve 3D secure olmadan ödeme için gerekli olan alanların tanımlandığı sınıftır.
 * Bu sınıf içerisinde execute metodu ile servis çağrısı başlatılır.
 * Execute metodu içerisinde tanımlanan "toXmlString" metodu gerekli xml metninin oluşturulmasını sağlar.
 * Execute metodu içerisinde tanımlanan url adresine oluşturulan xml post edilir.
 */
class MarketPlaceMPSale3DSECRequest
{
    public  $ServiceType; 
    public  $OperationType; 
    public  $MPAY;
    public  $CurrencyCode;
    public  $Token;
    public  $ExtraParam; 
    public  $Description;
    public  $ErrorURL; 
    public  $SuccessURL; 
    public  $CommissionRate; 
    public  $Price;
    public  $SubPartnerId; 
    public  $PaymentContent; 
    public  $BaseUrl;
    public  $InstallmentOptions;
    public  $CommissionRateList;


    public static function Execute(MarketPlaceMPSale3DSECRequest $request)
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
        "    <UserCode>" .$this->Token->UserCode . "</UserCode>\n" .
        "    <Pin>" . $this->Token->Pin . "</Pin>\n" .
        "    </Token>\n" .
        "    <MPAY>" . $this->MPAY . "</MPAY>\n" .
        "    <CurrencyCode>" . $this->CurrencyCode . "</CurrencyCode>\n" .
        "    <ExtraParam>" . $this->ExtraParam . "</ExtraParam>\n" .
        "    <Description>" . $this->Description . "</Description>\n" .
        "    <ErrorURL>" . $this->ErrorURL . "</ErrorURL>\n" . 
        "    <SuccessURL>" . $this->SuccessURL . "</SuccessURL>\n" . 
        "    <Price>" . $this->Price . "</Price>\n" .
        "    <CommissionRate>" . $this->CommissionRate . "</CommissionRate>\n" .
        "    <SubPartnerId>" . $this->SubPartnerId . "</SubPartnerId>\n" .
        "    <PaymentContent>" . $this->PaymentContent . "</PaymentContent>\n" .
        "    <InstallmentOptions>" . $this->InstallmentOptions . "</InstallmentOptions>\n" .
        "    <CommissionRateList>\n" .
        "    <Inst0>" . $this->CommissionRateList->Inst0 . "</Inst0>\n" .
        "    <Inst3>" . $this->CommissionRateList->Inst3 . "</Inst3>\n" .
        "    <Inst6>" . $this->CommissionRateList->Inst6 . "</Inst6>\n" .
        "    <Inst9>" . $this->CommissionRateList->Inst9 . "</Inst9>\n" .
        "    </CommissionRateList>\n" .
        "</WIRECARD>";
        $xml_data = iconv("UTF-8","ISO-8859-9", $xml_data);
         return $xml_data;
    }
}