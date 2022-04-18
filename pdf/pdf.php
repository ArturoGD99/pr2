<?php
	include_once("dompdf/dompdf_config.inc.php");
    include_once('../registro.php');
    $query = new Registro();
    set_time_limit(0);
	ini_set("memory_limit", "-1");
	if($_SERVER['HTTP_HOST']=="localhost"){$host = "127.0.0.1";}else{$host = $_SERVER['HTTP_HOST'];}
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$url = "http://".$host.$uri."/";
    $url.="ficha_pdf.php?id=".$_POST['id'];

$dompdf = new DOMPDF();
$dompdf->load_html_file($url);
//$dompdf->load_html(utf8_decode($html));
$dompdf->set_paper("letter", "portrait");
$dompdf->render();
echo base64_encode($dompdf->output());
?>