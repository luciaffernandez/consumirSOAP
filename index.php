<?php
$wsdl = "http://ovc.catastro.meh.es/ovcservweb/OVCSWLocalizacionRC/OVCCallejero.asmx?wsdl";

$cliente = new SoapClient($wsdl);


$cliente->__getFunctions();
$cliente->__getTypes();

$provincias = $cliente->ObtenerProvincias();
$provincias = simplexml_load_string($provincias->any);
$provincias = $provincias->provinciero->prov;

foreach ($provincias as $provincia) {
    $options1 .= "<option> $provincia->np </option>";
}

$provincia = $_POST['provincia'];
echo "<hr/> ";
$municipios = $cliente->ObtenerMunicipios($provincia);
$municipios = simplexml_load_string($municipios->any);
$municipios = $municipios->municipiero->muni;

foreach ($municipios as $municipio) {
     $options2 .= "<option>$municipio->nm" . " " . $municipio->locat->cd . " " . $municipio->locat->cmc . " " . $municipio->loine->cp . " " . $municipio->loine->cm . "</option>";
}

if(isset($_POST['enviarFinal'])){
    $municipio=$_POST['municipio'];
    $resultado = "<h3>Has seleccionado el municipio $municipio</h3>";
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>EjercicioSOAP</title>
    </head>
    <body>
        <h2>PROVINCIAS DE ESPAÑA </h2>
        <form action="index.php" method="POST">
        <select name="provincia"><?php echo $options1 ?></select>
        <input type="submit" value="Enviar" name="enviar">
        </form>
        <h2>MUNICIPIOS DE <?php echo $provincia ?></h2>
        <form action="index.php" method="POST">
        <select name="municipio"><?php echo $options2 ?></select>
        <input type="submit" value="Enviar" name="enviarFinal">
        </form>
        <?php echo $resultado?>
    </body>
</html>