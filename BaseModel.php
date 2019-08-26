
<?php

class Token
{
    public  $UserCode; 
    public  $Pin;
}
class CommissionRateList
{
    public  $Inst0;
    public  $Inst3;
    public  $Inst6;
    public  $Inst9;
}

class Product
{
    public $ProductId; 
    public $ProductCategory; 
    public $ProductDescription; 
    public $Price; 
    public $Unit;    
}

class Input
{
    public $Content; 
    public $Gsm;
    public $RequestGsmOperator; 
    public $RequestGsmType; 
    public $MPAY; 
    public $SendOrderResult; 
    public $PaymentTypeId; 
    public $ReceivedSMSObjectId; 
    public $ProductList;
    public $SendNotificationSMS; 
    public $OnSuccessfulSMS;
    public $OnErrorSMS; 
    public $Url; 
    public $SuccessfulPageUrl; 
    public $ErrorPageUrl; 
    public $Country; 
    public $Currency; 
    public $Extra;
    public $TurkcellServiceId;
    public $CustomerIpAddress;
    public $BeginDate;
    public $EndDate;
    public $ProductId;
    public $OrderChannelId;
    public $Active;
    public $SubscriberType;
    public $StartDateMin;
    public $StartDateMax;
    public $LastSuccessfulPaymentDateMin;
    public $LastSuccessfulPaymentDateMax;
    public $SubscriberId;
}

class CreditCardInfo
{
    public $CreditCardNo;
    public $OwnerName;
    public $ExpireYear;
    public $ExpireMonth;
    public $Cvv;
    public $Price;
}

class FinancialInfo
{
    public $IdentityNumber; 
    public $TaxOffice;
    public $TaxNumber;
    public $BankName;
    public $IBAN;
    public $AccountName;
	public $TradeRegisterNumber;
    public $TradeChamber;
}

class ContactInfo
{
    public $Country;
    public $City;
    public $Address;
    public $BankName;
    public $BusinessPhone;
    public $MobilePhone;
}

class CardTokenization
{
    public $RequestType;
    public $CustomerId;
    public $ValidityPeriod;
    public $CCTokenId;
}

class CustomerInfo
{
    public $CustomerName;
    public $CustomerSurname;
    public $CustomerEmail;
}