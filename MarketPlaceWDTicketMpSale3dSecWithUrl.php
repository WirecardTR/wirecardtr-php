<?php include('menu.php');?>
<h2>Wirecard Ortak Ödeme Sayfası</h2>
<br/>
<fieldset>
    <legend><label style="font-weight:bold;width:250px;">MarketPlace Bilgileri</label></legend>
    <label style="font-weight:bold;">Servis Adı &nbsp; :   &nbsp; </label> WDTicket<br>
    <label style="font-weight:bold;">Operasyon Adı &nbsp; :&nbsp; </label> MPSale3DSECWithUrl <br>
    <label style="font-weight:bold;">UserCode  &nbsp;:  &nbsp;</label> Wirecard tarafından verilen değer <br>
    <label style="font-weight:bold;">Pin &nbsp;:  &nbsp;</label> Wirecard tarafından verilen değer <br>
    <label style="font-weight:bold;">Fiyat &nbsp;:  &nbsp;</label> 0,01 TL <br>
    <label style="font-weight:bold;">MPAY &nbsp;:  &nbsp;</label> Benzersiz işlem numarası. Bu parametre işlem sonucunda aynen bize geri gönderilir. <br>
    <label style="font-weight:bold;">İşlem İçeriği &nbsp;:  &nbsp;</label>Bilgisayar Ödemesi <br>
    <label style="font-weight:bold;">Commission Rate &nbsp;:  &nbsp;</label>1 <br>
    <label style="font-weight:bold;">Installment Options &nbsp;:  &nbsp;</label>3 <br>
    <label style="font-weight:bold;">Commission Rate List &nbsp;:  &nbsp;</label>Komisyon oranları listesi<br>
    <label style="font-weight:bold;">Açıklama &nbsp;:  &nbsp;</label>Ödeme işleminin tanımı <br>
    <label style="font-weight:bold;">Ekstra Parametre &nbsp;:  &nbsp;</label>Bu alanın boş olarak gönderilmesi gerekmektedir. <br>
</fieldset>

<br />
<br />
<form action="" method="post" class="form-horizontal">
    <fieldset>
        <!-- Form Name -->
       
        <div class="form-group">
            <label class="col-md-4 control-label" for="">  SubPartnerId: </label>
            <div class="col-md-4">
                <input value="" name="subPartnerId" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="">  Para Birimi: </label>
            <div class="col-md-4">
                <select name="currencyCode">
                    <option value="TRY">TRY</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                </select>
            </div>
        </div>
    </fieldset>
    <!-- Button -->
    <div class="form-group">
        <label class="col-md-4 control-label" for=""></label>
        <div class="col-md-4">
            <button type="submit" id="" name="" class="btn btn-danger"> Ortak Ödeme Sayfası ile Ödeme Yap</button>
        </div>
    </div>
</form>
<?php if (!empty($_POST)): ?>
<?php

     /**
     * Setting ayarlarını settings sınıfı içerisinden alıyoruz.
     * Token bilgilerini ve Üye işyeri 3d secure ile ödeme için  gerekli olan MarketPlaceSale3DOrMpSaleRequest sınıfını formdan gelen bilgilerle doldurup, xml servis çağrısını başlatıyoruz.
     * Xml Servis çağrısı sonucunda oluşan servis çıktısını ekrana xml formatında yazdırıyoruz.
     */

    $settings=new Settings();
    $request = new MarketPlaceMPSale3DSECRequest();
	$request->ServiceType = "WDTicket";
    $request->OperationType = "MPSale3DSECWithUrl";

    $request->Token= new Token();
    $request->Token->UserCode=$settings->UserCode;
    $request->Token->Pin=$settings->Pin;
    $request->BaseUrl = $settings->BaseUrl;

    $request->MPAY = "";
    $request->CurrencyCode =$_POST["currencyCode"];
    $request->PaymentContent = "Bilgisayar";
    $request->Description = "BLGSYR01";
    $request->ExtraParam = "";
    $request->ErrorURL = "http://localhost:5000/fail.php";
    $request->SuccessURL = "http://localhost:5000/success.php";
    $request->CommissionRate = 100;//%1
    
    $request->InstallmentOptions = 0;
    $request->CommissionRateList = new CommissionRateList();
    $request->CommissionRateList->Inst0 = 110;
    $request->CommissionRateList->Inst3 = 130;
    $request->CommissionRateList->Inst6 = 160;
    $request->CommissionRateList->Inst9 = 190;

    $request->Price=1;////0,01 TL
    $request->SubPartnerId = $_POST["subPartnerId"];
    $response = MarketPlaceMPSale3DSECRequest::execute($request); // PazarYeri Ortak Ödeme sayfası servisinin başlatılması için gerekli servis çağırısını temsil eder.
    print "<h3>Sonuç:</h3>";
	echo "<pre>";
    echo htmlspecialchars ($response);  
    echo "</pre>";
	?>

<?php endif; ?>	 
<?php include('footer.php');?>