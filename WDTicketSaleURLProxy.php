<?php 


include('menu.php');

?>


<form action="" method="post" class="form-horizontal">
<h2>SaleURLProxy</h2>
<fieldset>
    <table class="table">
        <thead>
            <tr>
                <th>
                    Ürün Adı
                </th>
                <th>
                    İşlem İçeriği
                </th>
               
                <th>
                    İşlem Tutarı
                </th>
                <th>
                   Para Birimi
                </th>
                <th>
                    İşlem Tipi
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    Bilgisayar
                </td>
                <td>
                    BLGSYR01
                </td>
                <td>
                   0,01 TL
                </td>
                <td>
                TRY/USD/EUR --> TRY
                </td>
                <td>
                  1 //Tek Çekim
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>

	<fieldset>
		<!-- Button -->
		<div class="form-group">
			<label class="col-md-4 control-label" for=""></label>
			<div class="col-md-4">
				<button type="submit" name="submit" id=""  class="btn btn-success">Ödeme Yap</button>
			</div>
		</div>
	</fieldset>
</form>



<?php if (!empty($_POST)): ?>
<?php
    /**
     * Setting ayarlarını settings sınıfı içerisinden alıyoruz.
     * Token bilgilerini ve Ortak Ödeme Formu 3D secure olmadan ödeme yapmak için  gerekli olan WDTicketPaymentFormRequest sınıfını formdan gelen bilgilerle doldurup, xml servis çağrısını başlatıyoruz.
     * Xml Servis çağrısı sonucunda oluşan servis çıktısını ekrana xml formatında yazdırıyoruz.
     */
    $settings=new Settings();
	$request = new WDTicketPaymentFormRequest();
	$request->ServiceType = "WDTicket";
    $request->OperationType = "SaleURLProxy";

    $request->Token= new Token();
    $request->Token->UserCode=$settings->UserCode;
    $request->Token->Pin=$settings->Pin;
    $request->BaseUrl = $settings->BaseUrl;
    
    $request->Price = 1; //0.01 TL
    $request->MPAY = "";
    $request->CurrencyCode ="TRY";
    $request->ErrorURL = "http://localhost:5000/fail.php";
    $request->SuccessURL = "http://localhost:5000/success.php";
    $request->ExtraParam = "";
    $request->PaymentContent = "Bilgisayar";
    $request->Description = "BLGSYR01";
    $request->PaymentTypeId = 1;
    $request->InstallmentOptions = 0;
	$request->CustomerInfo= new CustomerInfo();
    $request->CustomerInfo->CustomerName="ahmet";
    $request->CustomerInfo->CustomerSurname="yılmaz";
    $request->CustomerInfo->CustomerEmail="ahmet.yilmaz@gmail.com";
    $request->Language="TR";
    $response = WDTicketPaymentFormRequest::execute($request); // WDTicketSaleURLProxy servisi başlatılması için gerekli servis çağırısını temsil eder.
   
    /**
     * İstek sonucunda oluşan redirect url değerini xml içerisinden ayıklayarak butona ekliyoruz. Eklenen bu değeri tıklayarak response sonucu oluşan url adresine 
     * yönlendirmiş oluyoruz.
     */
    $sxml = new SimpleXMLElement($response);
    $responseUrl=$sxml->Item[3]['Value']; //RedirectUrl adresini bulduğumuz kısım
	print "<h3>Sonuç:</h3>";
	echo "<pre>";
    echo htmlspecialchars ($response);
    echo "</br>";
    echo "</br>";
    echo "<a href='$responseUrl' class='btn btn-danger' >Ödemeyi tamamla</a>"; //Ödemenin tamamlandığı kısım.
    echo "</pre>";
	?>
    <?php endif; ?>

   
<?php include('footer.php');?>