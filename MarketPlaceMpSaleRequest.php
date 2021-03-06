<?php


/**
 * Pazaryeri 3dSecure ve 3D secure olmadan ödeme için gerekli olan alanların tanımlandığı sınıftır.
 * Bu sınıf içerisinde execute metodu ile servis çağrısı başlatılır.
 * Execute metodu içerisinde tanımlanan "toXmlString" metodu gerekli xml metninin oluşturulmasını sağlar.
 * Execute metodu içerisinde tanımlanan url adresine oluşturulan xml post edilir.
 */
class MarketPlaceMpSaleRequest
{
    public  $ServiceType; 
    public  $OperationType; 
    public  $CreditCardInfo; 
    public  $MPAY;
    public  $CurrencyCode;
    public  $Token;
    public  $Price;
    public  $ExtraParam; 
    public  $Description;
    public  $IPAddress; 
    public  $Port; 
    public  $ErrorURL; 
    public  $SuccessURL; 
    public  $InstallmentCount; 
    public  $CommissionRate; 
    public  $SubPartnerId; 
    public  $PaymentContent; 
    public  $CardTokenization; 
    public  $BaseUrl;

    public static function Execute(MarketPlaceMpSaleRequest $request)
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
        "    <Pin>" .$this->Token->Pin . "</Pin>\n" .
        "    </Token>\n" .
        "    <CreditCardInfo>\n" .
        "        <CreditCardNo>" . $this->CreditCardInfo->CreditCardNo . "</CreditCardNo>\n" .
        "        <OwnerName>" . $this->CreditCardInfo->OwnerName . "</OwnerName>\n" .
        "        <ExpireYear>" . $this->CreditCardInfo->ExpireYear . "</ExpireYear>\n" .
        "        <ExpireMonth>" . $this->CreditCardInfo->ExpireMonth . "</ExpireMonth>\n" .
        "        <Cvv>" . $this->CreditCardInfo->Cvv . "</Cvv>\n" .
        "    </CreditCardInfo>\n" .
        "    <CardTokenization>\n" .
        "        <RequestType>" . $this->CardTokenization->RequestType . "</RequestType>\n" .
        "        <CustomerId>" . $this->CardTokenization->CustomerId . "</CustomerId>\n" .
        "        <ValidityPeriod>" . $this->CardTokenization->ValidityPeriod . "</ValidityPeriod>\n" .
        "        <CCTokenId>" . $this->CardTokenization->CCTokenId . "</CCTokenId>\n" .
        "    </CardTokenization>\n" .
        "    <MPAY>" . $this->MPAY . "</MPAY>\n" .
        "    <CurrencyCode>" . $this->CurrencyCode . "</CurrencyCode>\n" .
        "    <Price>" . $this->Price . "</Price>\n" .
        "    <ExtraParam>" . $this->ExtraParam . "</ExtraParam>\n" .
        "    <Description>" . $this->Description . "</Description>\n" .
        "    <IPAddress>" . $this->IPAddress . "</IPAddress>\n" . 
        "    <Port>" . $this->Port . "</Port>\n" . 
        "    <ErrorURL>" . $this->ErrorURL . "</ErrorURL>\n" . 
        "    <SuccessURL>" . $this->SuccessURL . "</SuccessURL>\n" . 
        "    <InstallmentCount>" . $this->InstallmentCount . "</InstallmentCount>\n" .
        "    <CommissionRate>" . $this->CommissionRate . "</CommissionRate>\n" .
        "    <SubPartnerId>" . $this->SubPartnerId . "</SubPartnerId>\n" .
        "    <PaymentContent>" . $this->PaymentContent . "</PaymentContent>\n" .
        "</WIRECARD>";
        $xml_data = iconv("UTF-8","ISO-8859-9", $xml_data);
         return $xml_data;
       
    }
}