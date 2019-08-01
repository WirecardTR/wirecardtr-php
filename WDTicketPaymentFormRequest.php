<?php


/**
 * Ortak Ödeme formu 3D secure ve 3D secure olmadan ödeme için gerekli olan alanların tanımlandığı sınıftır.
 * Bu sınıf içerisinde execute metodu ile servis çağrısı başlatılır.
 * Execute metodu içerisinde tanımlanan "toXmlString" metodu gerekli xml metninin oluşturulmasını sağlar.
 * Execute metodu içerisinde tanımlanan url adresine oluşturulan xml post edilir.
 */
class WDTicketPaymentFormRequest
{
    public  $ServiceType; 
    public  $OperationType; 
    public  $Price; 
    public  $Token; 
    public  $MPAY; 
    public  $CurrencyCode; 
    public  $Description; 
    public  $ErrorURL; 
    public  $SuccessURL; 
    public  $ExtraParam; 
    public  $PaymentContent; 
    public  $InstallmentOptions; 
    public  $PaymentTypeId; 
    public  $BaseUrl;
	    public  $CustomerInfo; 
    public  $Language; 
    public static function Execute(WDTicketPaymentFormRequest $request)
    {
        return  restHttpCaller::post($request->BaseUrl, $request->toXmlString());
    }    
    
    //İstek sonucunda oluşan çıktının xml olarak gösterilmesini sağlar.
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
						        "    <CustomerInfo>\n" .
        "        <CustomerName>" . $this->CustomerInfo->CustomerName . "</CustomerName>\n" .
        "        <CustomerSurname>" . $this->CustomerInfo->CustomerSurname . "</CustomerSurname>\n" .
        "        <CustomerEmail>" . $this->CustomerInfo->CustomerEmail . "</CustomerEmail>\n" .
        "    </CustomerInfo>\n" .
        "    <Language>" . $this->Language . "</Language>\n" .
        "    <Price>" . $this->Price . "</Price>\n" .
        "    <MPAY>" . $this->MPAY . "</MPAY>\n" .
        "    <CurrencyCode>" . $this->CurrencyCode . "</CurrencyCode>\n" .
        "    <Description>" . $this->Description . "</Description>\n" .
        "    <ErrorURL>" . $this->ErrorURL . "</ErrorURL>\n" .
        "    <SuccessURL>" . $this->SuccessURL . "</SuccessURL>\n" .
        "    <ExtraParam>" . $this->ExtraParam . "</ExtraParam>\n" .
        "    <PaymentContent>" . $this->PaymentContent . "</PaymentContent>\n" .
        "    <PaymentTypeId>" . $this->PaymentTypeId . "</PaymentTypeId>\n" .
        "    <InstallmentOptions>" . $this->InstallmentOptions . "</InstallmentOptions>\n" .
        "</WIRECARD>";
        $xml_data = iconv("UTF-8","ISO-8859-9", $xml_data);
         return $xml_data;
    }
}