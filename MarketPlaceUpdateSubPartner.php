<?php include('menu.php');?>

<h2>Pazaryeri Oluşturma</h2>
<fieldset>
    <legend><label style="font-weight:bold;width:250px;">MarketPlace Bilgileri</label></legend>
    <label style="font-weight:bold;">Servis Adı &nbsp; :   &nbsp; </label> CCMarketPlace<br>
    <label style="font-weight:bold;">Operasyon Adı &nbsp; :&nbsp; </label> UpdateSubPartner <br>
    <label style="font-weight:bold;">UserCode  &nbsp;:  &nbsp;</label> Wirecard tarafından verilen değer <br>
    <label style="font-weight:bold;">Pin &nbsp;:  &nbsp;</label> Wirecard tarafından verilen değer <br>
    <label style="font-weight:bold;">UniqueId &nbsp;:&nbsp;  </label> benzersiz id değeri <br>
    <label style="font-weight:bold;">İş Telefonu &nbsp;: &nbsp; </label>2121111111 <br>
    <label style="font-weight:bold;">Vergi Dairesi &nbsp;: &nbsp; </label>İstanbul <br>
    <label style="font-weight:bold;">Vergi Numarası &nbsp;: &nbsp; </label>11111111111 <br>
    <label style="font-weight:bold;">Banka Adı &nbsp;: &nbsp; </label>Ziraat Bankası <br>
    <label style="font-weight:bold;">IBAN &nbsp;: &nbsp; </label>TR330006100519786457841326 <br>
    <label style="font-weight:bold;">Banka Hesap Adı &nbsp;: &nbsp; </label>Ahmet Yılmaz <br>
    <label style="font-weight:bold;">Mağaza Ülkesi: &nbsp; : &nbsp;</label>TR<br>
    <label style="font-weight:bold;">Mağaza Şehri: &nbsp;</label>&nbsp; 34<br>
    <label style="font-weight:bold;">Mağaza Açık Adresi &nbsp;: &nbsp;</label>Gayrettepe Mh. Yıldız Posta Cd. D Plaza No:52 K:6 34349 Beşiktaş / İstanbul<br>
	<label style="font-weight:bold;">İmza Yetkilisi Adı &nbsp;: &nbsp; </label>Ahmet<br>
    <label style="font-weight:bold;">İmza Yetkilisi Soyadı &nbsp;: &nbsp;</label>Yılmaz<br>
    <label style="font-weight:bold;">İmza Yetkilisi Doğum Tarihi &nbsp;: &nbsp;</label>1970/10/29<br>
</fieldset>

<br />
<form action="" method="post" class="form-horizontal">
    <fieldset>
        <!-- Form Name -->
        <legend><label style="font-weight:bold;width:250px;">Market Place Detayları</label></legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="">Mağaza Tipi:</label>
            <div class="col-md-4">
                <select name="subPartnerType">
                    <option value="Individual">Individual - Şahıs firması</option>
                    <option value="PrivateCompany">PrivateCompany - Özel şirket</option>
                    <option value="Corporation">Corporation - Kurumsal</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="">Mağaza Adı</label>
            <div class="col-md-4">
                <input name="name" class="form-control input-md">
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-4 control-label" for="">Mağazaya veya mağaza yetkilisine ait mobil telefon</label>
            <div class="col-md-4">
                <input name="mobilePhoneNumber" class="form-control input-md" required="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="">Mağazaya veya mağaza yetkilisine ait EPosta adresi</label>
            <div class="col-md-4">
                <input name="emailAddress" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="">Faturanın gönderileceği EPosta Adresi</label>
            <div class="col-md-4">
                <input name="invoiceEMailAddress" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="">Mağaza sahibine veya yetkilisine ait TC kimlik numarası</label>
            <div class="col-md-4">
                <input name="identityNumber" class="form-control input-md" required="">
            </div>
        </div>
         <div class="form-group">
            <label class="col-md-4 control-label" for="">SubPartner Id</label>
            <div class="col-md-4">
                <input name="subPartnerId" class="form-control input-md" required="">
            </div>
        </div>

    </fieldset>


    <!-- Button -->
    <div class="form-group">
        <label class="col-md-4 control-label" for=""></label>
        <div class="col-md-4">
            <button type="submit" id="" name="" class="btn btn-success">Mağaza Güncelle</button>
        </div>
    </div>
</form>

<?php if (!empty($_POST)): ?>
<?php
     /**
     * Setting ayarlarını settings sınıfı içerisinden alıyoruz.
     * Token bilgilerini ve Üye işyeri gğncelleme için  gerekli olan MarketPlaceAddOrUpdateRequest sınıfını formdan gelen bilgilerle doldurup, xml servis çağrısını başlatıyoruz.
     * Xml Servis çağrısı sonucunda oluşan servis çıktısını ekrana xml formatında yazdırıyoruz.
     */
    $settings=new Settings();
    $request = new MarketPlaceAddOrUpdateRequest();
	$request->ServiceType = "CCMarketPlace";
    $request->OperationType = "UpdateSubPartner";
    $request->UniqueId = Helper::Guid ();
    $request->SubPartnerType = $_POST["subPartnerType"]; 
    $request->Name = $_POST["name"];  
    $request->BranchName= $_POST["name"]; 
    $request->SubPartnerId = $_POST["subPartnerId"];  

    $request->Token= new Token();
    $request->Token->UserCode=$settings->UserCode;
    $request->Token->Pin=$settings->Pin;
    $request->BaseUrl = $settings->BaseUrl;
    
    $request->ContactInfo= new ContactInfo();
    $request->ContactInfo->Country="TR";
    $request->ContactInfo->City="34";
    $request->ContactInfo->Address= "Gayrettepe Mh. Yıldız Posta Cd. D Plaza No:52 K:6 34349 Beşiktaş / İstanbul";
    $request->ContactInfo->BusinessPhone="2121111111";
    $request->ContactInfo->MobilePhone=$_POST["mobilePhoneNumber"];
    $request->ContactInfo->Email=$_POST["emailAddress"];
    $request->ContactInfo->InvoiceEmail=$_POST["invoiceEMailAddress"];

    $request->FinancialInfo= new FinancialInfo();
    $request->FinancialInfo->IdentityNumber=$_POST["identityNumber"];
    $request->FinancialInfo->TaxOffice= "İstanbul";
    $request->FinancialInfo->TaxNumber= "11111111111";
    $request->FinancialInfo->BankName= "0012";
    $request->FinancialInfo->IBAN= "TR330006100519786457841326";

	$request->AuthSignatoryName="Ahmet";
	$request->AuthSignatorySurname="Yılmaz";
	$request->AuthSignatoryBirthDate=date("Y/m/d");
	
	
    $response = MarketPlaceAddOrUpdateRequest::execute($request); // Market Place update servisi başlatılması için gerekli servis çağırısını temsil eder.
    print "<h3>Sonuç:</h3>";
	echo "<pre>";
    echo htmlspecialchars ($response);  
    echo "</pre>";
	?>

<?php endif; ?>	 

<?php include('footer.php');?>
