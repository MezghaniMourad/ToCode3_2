<?php 
require_once("lib/nusoap.php");
//First Endpoint
function hello($username) {return 'Hello, '.$username.'!'; } 
function MonthNumberToMonth($month) {
    if ($month == 1) return 'JANVIER';
    if ($month == 2) return 'FEVERIER';
    if ($month == 3) return 'MARS';
    if ($month == 4) return 'AVRIL';
    if ($month == 5) return 'MAI';
    if ($month == 6) return 'JUIN';
    if ($month == 7) return 'JUILLET';
    if ($month == 8) return 'AOUT';
    if ($month == 9) return 'SEPTEMBRE';
    if ($month == 10) return 'OCTOBRE';
    if ($month == 11) return 'NOVEMBRE';
    if ($month == 12) return 'DECEMBRE';

    return 'Month Not Found :( ';
}    

//Second Endpoint

function countryDetails($country){ 
return array('CountryCode'=>'TN', 'CountryName'=>'TUNISIA', 'CountryPopulation'=>'11,57M'); }

$server = new nusoap_server();
 $server->configureWSDL('WS1', 'urn:localhost');
 $server->wsdl->schemaTargetNamespace = 'urn:localhost';

 //SOAP complex type return type (an array/struct)
$server->wsdl->addComplexType(
    'Country', //complex type name
    'complexType', // type simple/complex
    'struct','all', // All-sequence
    '',
    array(
        'CountryCode' => array('name' => 'CountryCode', 'type' => 'xsd:string'),
        'CountryName' => array('name' => 'CountryName', 'type' => 'xsd:string'),
        'CountryCurrency' => array('name' => 'CountryCurrency', 'type' => 'xsd:string'),
        'CountryCurrencyCode' => array('name' => 'CountryCurrencyCode', 'type' => 'xsd:string'),
        'CountryPopulation' => array('name' => 'CountryPopulation', 'type' => 'xsd:string'),
		) 
);
//this is the second webservice entry point/function 
$server->register('countryDetails',
array('CountryCode' => 'xsd:string'),  //input
			array('return' => 'tns:Country'),  //output
			'urn:localhost',   //namespace
			'urn:localhost#CountryDetailsServer',  //soapaction
); 
$server->register('MonthNumberToMonth',
			array('month' => 'xsd:integer'),  //input
			array('return' => 'xsd:string'),  //output
			'urn:localhost',   //namespace
			'urn:localhost#MonthServer'  //soapaction
		); 
// Use the request to (try to) invoke the service
$server->service(file_get_contents("php://input"));
?>
