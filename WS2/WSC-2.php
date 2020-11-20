  <!-- ******* WS2_Client ******* -->
<?php
require_once('lib/nusoap.php');
$wsdl = "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL";
$client = new nusoap_client($wsdl, 'wsdl');
$err = $client->getError();
if ($err) {
   echo '<h2>L\'erreur est :</h2>' . $err;
   exit();
}

$result=$client->call('CountryCurrency', array('sCountryISOCode'=>"TN"));




$res = ($result['CountryCurrencyResult']['sName']);

  if( $res =='Country not found in the database' ){
    echo '<h4 style="color:red;text-align:center;">Pays non trouve dans la base de donnees !!! Veuillez entrez un nom de pays valide </h4></br>';
  }
  else {
	echo "<h2>Resultat<h2/>";
	echo " La devise de la Tunisie : ".($result['CountryCurrencyResult']['sISOCode'])."(".($result['CountryCurrencyResult']['sName']).")"."</br>"; 
  }



// Display the request and response (SOAP messages)
echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
// Display the debug messages
echo '<h2>Debug</h2>';
echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
?>
