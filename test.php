

<?php

include "script.php";

$problem_data=$problem->get_problem_info(1);
$input=$problem_data['input_description'];

require_once 'style/lib/pdf_convertor/dompdf/autoload.inc.php';

$input.="";

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($input);
$dompdf->set_option( 'isJavascriptEnabled' , true );
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("filename.pdf", array("Attachment" => false));
?>

