<?php
$wsdl= "http://ovc.catastro.meh.es/ovcservweb/OVCSWLocalizacionRC/OVCCallejero.asmx?wsdl";

$cliente = new SoapClient($wsdl);


$cliente->__getFunctions();
$cliente->__getTypes();

$provincias = $cliente->ObtenerProvincias();
$provincias = simplexml_load_string($provincias->any);
$provincias = $provincias->provinciero->prov;
echo "<h2>PROVINCIAS DE ESPAÑA </h2>";
foreach($provincias as $provincia){
    echo "$provincia->cpine - $provincia->np <br/>";
    
}

$provincia = "A CORUÑA";
echo "<hr/> <h2>MUNICIPIOS DE $provincia </h2>";
$municipios = $cliente->ObtenerMunicipios($provincia);
$municipios = simplexml_load_string($municipios->any);
$municipios = $municipios->municipiero->muni;

foreach($municipios as $municipio){
    echo "$municipio->nm" . " " . $municipio->locat->cd . " " . $municipio->locat->cmc . " " .$municipio->loine->cp. " " .$municipio->loine->cm."</br>";
}

?>
